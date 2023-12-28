<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();

            $student = new Student();
            $student->name = $request->name;
            $student->save();
            DB::commit();
            return redirect()->route('students.index')->with('success', 'Successfully recorded.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('students.index')->with('error', 'There was a problem saving the student.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Successfully updated.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Successfully deleted.');
    }


}
