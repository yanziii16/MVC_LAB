HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased">
    <nav class="bg-slate-900 text-white p-4 shadow">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ route('students.index') }}" class="font-bold text-lg"> Academic SMS</a>
            <div class="flex gap-4 text-sm font-semibold">
                <a href="{{ route('students.index') }}" class="hover:text-blue-400">Students</a>
                <a href="{{ route('activities.index') }}" class="hover:text-blue-400">Activities</a>
                <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded">+ Register Student</a>
            </div>
        </div>

</nav>

<main class="max-w-6xl mx-auto p-6">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700
    rounded">
            {{ session('success') }}
            </div>
        @endif
    
        @yield('content')
    </main>
</body>
</html>