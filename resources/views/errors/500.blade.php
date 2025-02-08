<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Error | Learn Syntax</title>
    @yield('meta')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    @livewireStyles
</head>

<body>

    <div class="flex md:flex-row flex-col p-10  items-center justify-center min-h-screen md:px-[10%]">
        <div class="flex-[1.5] flex flex-col gap-3">
            <img src="{{asset('assets/learnSyntax.png')}}" alt="" class="w-[80%] md:w-[40%]">
             <h1 class="text-xl text-slate-500"><strong class="text-black">500</strong>. That's an error</h1>
            <p class=" text-2xl">The server encountered an error and could not complete your Request.</p>
            <p class="text-md md:text-2xl">If the problem persists. please contact care@learnsyntax.com. and report your problem and don't forget to mention this error message & query that caused it. <span class="text-slate-500">Thats all you know</span></p>
        </div>
        <div class="flex-1">
            <img src="{{asset('assets/404.jpg')}}" alt="" class="">
        </div>
    </div>



</body>

</html>
