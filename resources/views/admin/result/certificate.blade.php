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
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen py-8">
    <div class="text-center w-full">
        
        <div class="bg-white border-8 border-gray-300 rounded-xl shadow-xl p-6 w-full max-w-3xl mx-auto transform transition-all duration-500 hover:scale-105">
           
             <h1 class="text-4xl md:text-5xl font-serif text-blue-800 font-extrabold mb-4 uppercase tracking-wide leading-tight">
                Certificate of Achievement
            </h1>
             
            
            <p class="text-lg md:text-xl text-gray-600 mb-2 italic">This is to certify that</p>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-800 mb-4">{{ $user->name }}</h2>
            <p class="text-lg md:text-xl text-gray-600 mb-2 italic">has successfully completed the exam</p>
            <h3 class="text-2xl md:text-3xl font-serif font-semibold text-gray-800 mb-4">{{ $exam->exam_name }}</h3>
            <p class="text-lg md:text-xl text-gray-600 mb-4">
                with a total score of <strong class="text-black text-2xl">{{ $attempt->total_marks }}</strong>.
            </p>
            <p class="text-lg md:text-xl text-gray-600 mb-4">Date: {{ $date }}</p>
            
         
            <div class="flex justify-center mb-4">
                <img src="http://127.0.0.1:8000/assets/comestro.png" alt="Logo" class="h-20 w-20 md:h-24 md:w-24 object-contain">
            </div>
        </div>
      
        <button 
            onclick="window.print()" 
            class="print-button mt-6 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition duration-300 transform hover:scale-105"
        >
            Print Certificate
        </button>
    </div>
</body>
</html>
