<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') Admin Panel | {{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="">


    <x-admin-header/>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-12 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full pb-4 overflow-y-auto bg-white ">
            <x-side-nav />
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <br>
        <br>
        <br>
        @section('content')

        @show()
    </div>






    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
