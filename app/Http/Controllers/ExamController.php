<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ResourceGroupItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = DB::table('exams')
            ->select(
                'students.id as student_id',
                'students.name as student_name',
                'resource_groups.id as group_id',
                'resource_groups.name as group_name',
                DB::raw('MAX(exams.id) as exam_id')
            )
            ->join('students', 'students.id', '=', 'exams.student_id')
            ->join('resource_groups', 'resource_groups.id', '=', 'exams.group_id')
            ->groupBy('students.id', 'resource_groups.id')
            ->orderBy('students.name', 'asc')
            ->orderBy('resource_groups.name', 'asc')
            ->get();

        $totalUniqueStudents = Exam::distinct('student_id')->count('student_id');

        return view('exams.index', compact('exams', 'totalUniqueStudents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        Exam::where([
            'student_id' => $exam->student_id,
            'group_id' => $exam->group_id
        ])
            ->delete();
        return redirect()->route('exams.index')
            ->with('success', __('trans.Successfully deleted'));
    }

}
