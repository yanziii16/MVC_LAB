
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold mb-4">Register New Student</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Student Number
            </label>
            <input
                type="text"
                name="student_number"
                value="{{ old('student_number') }}"
                required
                class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"
            >
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">
                    First Name
                </label>
                <input
                    type="text"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    required
                    class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">
                    Last Name
                </label>
                <input
                    type="text"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    required
                    class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Email Address
            </label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"
            >
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">
                Date of Birth
            </label>
            <input
                type="date"
                name="date_of_birth"
                value="{{ old('date_of_birth') }}"
                required
                class="w-full border rounded p-2 text-sm focus:ring focus:ring-blue-200"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 text-sm"
        >
            Register Student
        </button>
    </form>
</div>
@endsection
