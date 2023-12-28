<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Experience;
use App\Models\ResourceGroup;
use App\Models\Setting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentId = $request->query('student_id');
        $student = Student::findOrFail($studentId);
        $tutorialGroups = ResourceGroup::with('exams')->orderBy('id', 'desc')->get();

        return view('experiences.index', compact('student', 'tutorialGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($studentId, $groupId = null)
    {
        if ($groupId !== null) {
            $group = ResourceGroup::findOrFail($groupId);
        } else {
            $group = ResourceGroup::first();
        }

        $students = Student::orderBy('name', 'asc')->get();
        $student = Student::with('experiences')->findOrFail($studentId);
        $groups = ResourceGroup::orderBy('name', 'asc')->get();

        return view('experiences.show',
            compact('student', 'students', 'group', 'groups'));
    }

    public function getReports(Request $request)
    {
        $students = Student::orderBy('name', 'asc')->get();
        $student = Student::with(['experiences' => function ($query) use ($request) {
            $query->where('group_id', $request->groupId);
        }])
            ->where('id', $request->studentId)
            ->first();

        $groups = ResourceGroup::orderBy('name', 'asc')->get();
        $group = ResourceGroup::findOrFail($request->groupId);
        return view('experiences.show',
            compact('student', 'students', 'group', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('home');
        }
        return view('experiences.create', compact('student'));
    }

    public function doExperience($studentId, $tutorialGroupId, $itemId = null)
    {
        if ($studentId !== null && $tutorialGroupId !== null && $itemId === null) {
            $this->insertToExamTable($studentId, $tutorialGroupId);
        }

        $student = Student::findOrFail($studentId);


        $tutorialGroup = ResourceGroup::withcount('resourceGroupItems')
            ->with('resourceGroupItems')->findOrFail($tutorialGroupId);

        $existingExamsCount = Exam::where(['student_id' => $studentId, 'group_id' => $tutorialGroupId])->count();

        if ($existingExamsCount === 0 && $itemId !== null) {
            return view('exams.finish', compact('student', 'tutorialGroup'));
        }
        $remainingQuestionsCount = $existingExamsCount;

        $examItem = Exam::with('resourceGroupItem.resource')
            ->where(['student_id' => $studentId, 'group_id' => $tutorialGroupId])
            ->orderBy('created_at')
            ->first();

        $questionContent = $this->getQuestionContentWithSetting($examItem);
        $settings = Setting::where('status', true)->first();
        return view('experiences.create', compact(
            'student',
            'tutorialGroup',
            'examItem',
            'remainingQuestionsCount',
            'questionContent',
            'settings'
        ));
    }

    private function getQuestionContentWithSetting($examItem)
    {
        if (!$examItem || !$examItem->resourceGroupItem || !$examItem->resourceGroupItem->resource) {
            return '';
        }
        $setting = Setting::where('status', true)->first();
        if (!$setting) {
            return '';
        }
        $name = $examItem->resourceGroupItem->resource->name;
        switch ($setting->id) {
            case 1:
                return Str::upper($name);
            case 2:
                return Str::lower($name);
            case 3:
                return Str::ucfirst($name);
            case 4:
                return $this->randomizeCase($name);
            default:
                return '';
        }
    }

    private function randomizeCase($text)
    {
        $result = '';
        for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');
            if (mt_rand(0, 1)) {
                $result .= $this->turkishStrToUpper($char);
            } else {
                $result .= $this->turkishStrToLower($char);
            }
        }
        return $result;
    }

    private function turkishStrToUpper($char): string
    {
        $turkishUpper = ['i' => 'İ', 'ı' => 'I', 'ğ' => 'Ğ', 'ü' => 'Ü', 'ş' => 'Ş', 'ö' => 'Ö', 'ç' => 'Ç'];
        return $turkishUpper[$char] ?? strtoupper($char);
    }

    private function turkishStrToLower($char): string
    {
        $turkishLower = ['İ' => 'i', 'I' => 'ı', 'Ğ' => 'ğ', 'Ü' => 'ü', 'Ş' => 'ş', 'Ö' => 'ö', 'Ç' => 'ç'];
        return $turkishLower[$char] ?? strtolower($char);
    }

    private function insertToExamTable($studentId, $tutorialGroupId)
    {
        $isContinue = Exam::where([
            'student_id' => $studentId,
            'group_id' => $tutorialGroupId,
        ])->count();

        if ($isContinue === 0) {
            $tutorialGroup = ResourceGroup::withcount('resourceGroupItems')
                ->with('resourceGroupItems')->findOrFail($tutorialGroupId);

            foreach ($tutorialGroup->resourceGroupItems ?? [] as $item) {
                $existingExam = Exam::where([
                    'student_id' => $studentId,
                    'group_id' => $item->group_id,
                    'group_item_id' => $item->id
                ])->first();

                if ($existingExam === null) {
                    $exam = new Exam;
                    $exam->student_id = $studentId;
                    $exam->group_id = $item->group_id;
                    $exam->group_item_id = $item->id;
                    $exam->save();
                }
            }
        }
    }

    public function saveCanvasImage(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $base64Image = $request->input('image'); // Frontend'den gelen base64 image stringi
            $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData = base64_decode($base64Image);

            $fileName = 'image_' . time() . '.png';
            Storage::disk('public')->put('experiences/' . $fileName, $imageData);

            $experience = new Experience;
            $experience->student_id = $request->studentId;
            $experience->group_id = $request->groupId;
            $experience->group_item_id = $request->groupItemId;
            $experience->image_url = $fileName;;
            $experience->save();

            $exam = Exam::where([
                'student_id' => $request->studentId,
                'group_id' => $request->groupId,
                'group_item_id' => $request->groupItemId
            ])->first();
            $exam->delete();
            return response()->json([
                'success' => true,
                'message' => __('trans.Resim başarıyla kaydedildi')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


}
