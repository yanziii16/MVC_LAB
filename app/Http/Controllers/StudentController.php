<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    // Show the registration form
    public function create()
    {
        return view('students.create');
    }

    // Save a new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|string|unique:students,student_number',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student registered successfully.');
    }

    // Display student details and available courses
    public function show(Student $student)
    {
        $student->load('courses');

        $availableCourses = Course::whereNotIn(
            'id',
            $student->courses->pluck('id')
        )->get();

        return view('students.show', compact(
            'student',
            'availableCourses'
        ));
    }

    // Enroll a student in a course
    public function enroll(Request $request, Student $student)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Prevent duplicate enrollment
        $student->courses()->syncWithoutDetaching([
            $validated['course_id'] => [
                'enrolled_at' => now(),
            ],
        ]);

        return redirect()->route('students.show', $student->id)
            ->with('success', 'Course enrolled successfully.');
    }

    public function edit(Student $student)
{
    return view('students.edit', compact('student'));
}

public function update(Request $request, Student $student)
{
    $validated = $request->validate([
        'student_number' => 'required|string|unique:students,student_number,' . $student->id,
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|unique:students,email,' . $student->id,
        'date_of_birth' => 'required|date',
    ]);

    $student->update($validated);

    return redirect()->route('students.index')
        ->with('success', 'Student updated successfully.');
}

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student record deleted.');
    }
}