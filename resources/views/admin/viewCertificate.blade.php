<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
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
    <div class="relative w-[800px] h-[600px] bg-no-repeat bg-cover shadow-xl" 
         style="background-image: url('https://i.pinimg.com/736x/37/f4/75/37f47590bda5c8053b969248af5e79a7.jpg')">

      
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-8">
      
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-black mb-4">{{ $user->name }}</h2>

         
            <p class="text-lg md:text-xl text-black mb-4">has successfully completed the exam</p>

            <h3 class="text-2xl md:text-3xl font-serif font-semibold text-black mb-2">{{ $examName }}</h3>

            <p class="text-lg md:text-xl text-black mb-4">
                with a total score of <strong class="text-black text-2xl">{{ number_format($percentage, 2) }}%</strong>.
            </p>

           
            <p class="text-lg md:text-xl text-black mb-4">Date: {{ $date }}</p>
        </div>

      
        <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2">
            <img src="http://127.0.0.1:8000/assets/LearnSyntax.png" alt="Logo" class="h-8 w-auto object-contain">
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
