@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Student Activities &amp; Assignments</h1>
    <a href="{{ route('activities.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-3 py-2 rounded">+ Create Activity</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-200 text-slate-700 text-xs uppercase">
            <tr>
                <th class="p-4">Activity Title</th>
                <th class="p-4">Course</th>
                <th class="p-4">Max Points</th>
                <th class="p-4">Due Date</th>
                <th class="p-4">Submissions</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y text-sm">
            @forelse($activities as $activity)
            <tr class="hover:bg-slate-50">
                <td class="p-4 font-semibold text-slate-900">{{ $activity->title }}</td>
                <td class="p-4 text-slate-600 font-mono text-xs">{{ $activity->course->code }} - {{ $activity->course->title }}</td>
                <td class="p-4 font-bold text-slate-700">{{ $activity->max_points }} pts</td>
                <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($activity->due_date)->format('M d, Y h:i A') }}</td>
                <td class="p-4">
                    <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-bold">
                        {{ $activity->submissions_count }} Submitted
                    </span>
                </td>
                <td class="p-4">
                    <a href="{{ route('activities.show', $activity->id) }}" class="text-xs bg-slate-200 px-3 py-1.5 rounded hover:bg-slate-300 font-bold">View / Submit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-slate-500">No activities created yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $activities->links() }}
</div>
@endsection