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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @livewireStyles
</head>

<body x-data="{ sidebarOpen: true }">
<div :class="sidebarOpen ? 'block' : 'hidden' "
class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white p-4 border-r">
        <x-side-nav />
    </div>
    
<main :class="{'sm:ml-64': sidebarOpen, 'ml-0': !sidebarOpen}" class="flex-1  p-4 transition-all duration-300 p-4 sm:ml-64">

<x-admin-header />

@section('content')
@show
</main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('success', (data) => {
                    // Accessing the first element of the array to get the message
                    const message = data[0].message;
                    toastr.success(message, 'Success');
                });
            });
        </script>
    @stack('scripts')

    @livewireScripts
</body>

</html>
