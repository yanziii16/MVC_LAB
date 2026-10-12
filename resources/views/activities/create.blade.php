@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
 <h1 class="text-xl font-bold mb-4">Create Course Activity</h1>
 @if ($errors->any())
 <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm">
 <ul>
 @foreach ($errors->all() as $error)
 <li>• {{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form action="{{ route('activities.store') }}" method="POST">
 @csrf
 <div class="mb-4">
 <label class="block text-sm font-medium mb-1">Target Course</label>
 <select name="course_id" required class="w-full border rounded p-2 text-sm focus:ring
focus:ring-blue-200">
 <option value="">-- Select Course --</option>
 @foreach($courses as $course)
 <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->title }}</option> @endforeach
 </select>
 </div>
 <div class="mb-4">
 <label class="block text-sm font-medium mb-1">Activity Title</label>
 <input type="text" name="title" value="{{ old('title') }}" required class="w-full border
rounded p-2 text-sm focus:ring focus:ring-blue-200">
 </div>
 <div class="mb-4">
 <label class="block text-sm font-medium mb-1">Instructions / Description</label> <textarea name="description" rows="4" required class="w-full border rounded p-2 textsm focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
 </div>
 <div class="grid grid-cols-2 gap-4 mb-6">
 <div>
 <label class="block text-sm font-medium mb-1">Max Points</label>
 <input type="number" name="max_points" value="{{ old('max_points', 100) }}"
required class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200">
 </div>
 <div>
 <label class="block text-sm font-medium mb-1">Due Date & Time</label>
 <input type="datetime-local" name="due_date" value="{{ old('due_date') }}" required
class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200">
 </div>
 </div>
 <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded
hover:bg-blue-700 text-sm">Post Activity</button>
 </form>
</div>
@endsection