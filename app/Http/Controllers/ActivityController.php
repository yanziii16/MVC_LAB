<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('course')->withCount('submissions')->latest()->paginate(10);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('activities.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_points' => 'required|integer|min:1',
            'due_date' => 'required|date',
        ]);

        Activity::create($validated);
        
        return redirect()->route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity)
    {
        $activity->load(['course', 'submissions.student']);
        $enrolledStudentIds = $activity->course->students->pluck('id');
        $submittedStudentIds = $activity->submissions->pluck('student_id');
        $pendingStudents = Student::whereIn('id', $enrolledStudentIds)
            ->whereNotIn('id', $submittedStudentIds)
            ->get();

            return view('activities.show', compact('activity', 'pendingStudents'));
    }
    
    public function submit(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'submission_text' => 'required|string',
        ]);

        Submission::create([
            'activity_id' => $activity->id,
            'student_id' => $validated['student_id'],
            'submission_text' => $validated['submission_text'],
            'submitted_at' => now(),
        ]);

        return redirect()->route('activities.show', $activity->id)
            ->with('success', 'Activity submitted successfully.');
    }
}