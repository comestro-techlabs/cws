<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <head>
        <head>
            <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        </head>
        
    </head>
    
    <script src="https://cdn.tailwindcss.com"></script>
   
    <style>
        @media print {
            .print-button {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
        

        body {
            margin: 0;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="text-center">
      
        <div class="relative w-[995px] h-[695px] bg-no-repeat bg-cover shadow-xl" 
             style="background-image: url('{{ asset('certificate.jpeg') }}')">

          

           
             {{-- <div class="absolute top-[350px] left-1/2 transform -translate-x-1/2">
                <h2 class="text-2xl md:text-3xl font-serif font-bold text-black">{{ $user->name }}</h2>
            </div>  --}}
            <div class="absolute top-[350px] left-1/2 transform -translate-x-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Great Vibes', cursive;">
                    {{ $user->name }}
                </h2>
            </div>
            
            
            

      
            <div class="absolute top-[420px] left-[100px] right-[90px] px-8">
                <p class="text-lg text-gray-800 ">
                    This certificate is awarded to  <strong class="text-black">{{ $user->name }}</strong> for achieving a score of 
                    <strong class="text-black">{{ number_format($percentage, 2) }}%</strong> 
                    in recognition of their performance in the final examination, viva voce, and project evaluation for the course titled 
                    <strong class="text-black">course_title</strong>, conducted by <strong>Comestro Techlabs Pvt Ltd.</strong>
                </p>
            </div>


          
            <div class="absolute top-[330px]  right-[-75px]  transform rotate-90 text-gray-800 font-semibold text-lg tracking-wider">
                Certificate No: LS/course_code/{{ $year }}/certificate_no
            </div> 

            <div class="absolute bottom-[25px] left-[510px]">
                <p class="text-lg text-gray-800 text-center"> {{ $date }}</p>
            </div>
        </div>

      
        <button 
            onclick="window.print()" 
            class="print-button mt-8 px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-700 text-white rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition duration-300 transform hover:scale-105"
        >
            Print Certificate
        </button>
    </div>

</body>
</html>
