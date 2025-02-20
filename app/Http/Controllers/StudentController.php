<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course_ids' => 'required|array|min:1', // Ensure at least one course is selected
            'course_ids.*' => 'exists:courses,id', // Validate that each selected course exists
        ]);

        $student = Student::create($request->only('name', 'email'));

        $student->courses()->attach($request->course_ids);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }


    public function update(Request $request, Student $student)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id, // Exclude current student's email
            'course_ids' => 'required|array|min:1', // Ensure at least one course is selected
            'course_ids.*' => 'exists:courses,id', // Validate that each selected course exists
        ]);

        $student->update($request->only('name', 'email'));

        $student->courses()->sync($request->course_ids);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted!');
    }
}
