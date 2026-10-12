@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-slate-900">{{ $student->full_name }}</h1>
            <p class="text-xs text-slate-500 font-mono mt-1">ID: {{ $student->student_number }} | Email: {{ $student->email }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-bold mb-4">Enrolled Courses ({{ $student->courses->count() }})</h2>
            <div class="space-y-3">
                @forelse($student->courses as $course)
                <div class="flex justify-between items-center p-3 bg-slate-50 border rounded">
                    <div>
                        <span class="font-bold text-sm">{{ $course->code }}</span>
                        <p class="text-xs text-slate-600">{{ $course->title }} ({{ $course->credits }} Credits)</p>
                    </div>
                    <span class="text-xs bg-blue-100 text-blue-800 font-bold px-2.5 py-1 rounded">Enrolled</span>
                </div>
                @empty
                <p class="text-sm text-slate-500">Student is not currently enrolled in any course.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow h-fit">
        <h2 class="text-lg font-bold mb-4">Enroll in Course</h2>
        @if($availableCourses->count() > 0)
        <form action="{{ route('students.enroll', $student->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Select Course</label>
                <select name="course_id" required class="w-full border rounded p-2 text-sm">
                    <option value="">-- Choose Course --</option>
                    @foreach($availableCourses as $c)
                    <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 text-sm">Enroll Student</button>
        </form>
        @else
        <p class="text-sm text-slate-500">No additional courses available for enrollment.</p>
        @endif
    </div>
</div>
@endsection