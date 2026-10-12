@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <span class="text-xs font-mono bg-blue-100 text-blue-800 px-2 py-1 rounded font-bold">{{ $activity->course->code }}</span>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $activity->title }}</h1>
            <p class="text-xs text-slate-500 mt-1">Due: {{ \Carbon\Carbon::parse($activity->due_date)->format('F d, Y h:i A') }} | Max Points: {{ $activity->max_points }}</p>
            <hr class="my-4">
            <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                {{ $activity->description }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold mb-4">Submitted Works ({{ $activity->submissions->count() }})</h2>
            <div class="space-y-4">
                @forelse($activity->submissions as $sub)
                <div class="border p-4 rounded-lg bg-slate-50">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-sm text-slate-800">{{ $sub->student->full_name }}</span>
                        <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($sub->submitted_at)->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-slate-600 bg-white p-3 rounded border font-mono">{{ $sub->submission_text }}</p>
                </div>
                @empty
                <p class="text-sm text-slate-500">No student submissions recorded yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow h-fit">
        <h2 class="text-lg font-bold mb-4">Turn In Activity</h2>
        @if($pendingStudents->count() > 0)
        <form action="{{ route('activities.submit', $activity->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Select Student</label>
                <select name="student_id" required class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200">
                    <option value="">-- Enrolled Students --</option>
                    @foreach($pendingStudents as $student)
                    <option value="{{ $student->id }}">{{ $student->student_number }} - {{ $student->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Submission Text / Answer Link</label>
                <textarea name="submission_text" rows="4" placeholder="Type answer or paste link here..." required class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 rounded hover:bg-green-700 text-sm">Submit Work</button>
        </form>
        @else
        <p class="text-sm text-slate-500">All enrolled students have submitted or no enrolled students found for this course.</p>
        @endif
    </div>
</div>
@endsection