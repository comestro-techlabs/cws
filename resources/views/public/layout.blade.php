<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link
  rel="stylesheet"
  href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
/>
<script async src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>

@vite("resources/css/app.css")
    
  <link
  href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet"
/>


</head>
<body>
   @include('public.publicheader')


   @section('content')
       
   @show

   <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>



</body>
</html>