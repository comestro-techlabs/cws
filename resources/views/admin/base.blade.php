<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') Admin Panel | {{env('APP_NAME')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    @vite('resources/css/app.css')

</head>
<body class="dark:bg-slate-700">


   <div class="flex">
    <div class="hidden shadow-lg h-full md:flex lg:fixed top-0 left-0 z-40 overflow-y-auto bg-white w-64 dark:bg-gray-800 flex-1 flex-col p-3">
        <x-side-nav/>
    </div>
    <div class="md:flex-1 md:ml-64 ml-0">
        <x-admin-header/>

        @section('content')
        @show()
    </div>
    @include('admin.drawer')   
</div>

    

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>