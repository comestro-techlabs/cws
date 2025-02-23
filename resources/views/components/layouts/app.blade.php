{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ $title ?? 'public' }}</title>
        @livewireStyles
    </head>
    <body>
        <h1>public</h1>
        {{ $slot }}
        @livewireScripts
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ $title ?? 'Student' }}</title>
        @livewireStyles
    </head>
    <body class="flex bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-white shadow-lg fixed">
            <div class="p-4 text-xl font-semibold border-b">Student Panel</div>
            <ul class="mt-4">
                <li class="px-4 py-2 hover:bg-gray-200"> 
                    <a href="" class="block">Dashboard</a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-200">
                    <a href="{{ route('student.exploreCourses') }}" class="block">Explore Courses</a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-200">
                    <a href="{{route('student.myCourses')}}" class="block">My Courses</a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-200">
                    <a href="" class="block">Profile</a>
                </li>
                <li class="px-4 py-2 hover:bg-red-500 text-white">
                    <a href="" class="block">Logout</a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="ml-64 w-full">
            <x-student-header />
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
    </body>
</html>

