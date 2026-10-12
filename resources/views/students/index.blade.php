
@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Student Roster</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-200 text-slate-700 text-xs uppercase">
            <tr>
                <th class="p-4">Student Number</th>
                <th class="p-4">Full Name</th>
                <th class="p-4">Email</th>
                <th class="p-4">Enrolled Courses</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y text-sm">
            @forelse ($students as $student)
                <tr class="hover:bg-slate-50">
                    <td class="p-4 font-mono text-xs font-bold text-slate-600">
                        {{ $student->student_number }}
                    </td>

                    <td class="p-4 font-semibold">
                        {{ $student->full_name }}
                    </td>

                    <td class="p-4 text-slate-600">
                        {{ $student->email }}
                    </td>

                    <td class="p-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-1 rounded-full font-bold">
                            {{ $student->enrolled_courses?->count() ?? 0 }}
                        </span>
                    </td>

                    <td class="p-4">
                        <a href="{{ route('students.edit', $student) }}"
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>

                        <form action="{{ route('students.destroy', $student) }}"
                              method="POST"
                              class="inline-block ml-2">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to delete this student?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-500">
                        No students found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $students->links() }}
</div>
@endsection