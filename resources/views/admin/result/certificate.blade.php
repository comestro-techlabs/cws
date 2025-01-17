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
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white border-8 border-gray-300 rounded-xl shadow-lg p-8 w-11/12 md:w-2/3 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-green-500 mb-4">Certificate of Achievement</h1>
        <p class="text-lg md:text-xl text-gray-600 mb-2">This is to certify that</p>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $user->name }}</h2>
        <p class="text-lg md:text-xl text-gray-600 mb-2">has successfully completed the exam</p>
        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $exam->exam_name }}</h3>
        <p class="text-lg md:text-xl text-gray-600 mb-4">
            with a total score of <strong class="text-black">{{ $attempt->total_marks }}</strong>.
        </p>
        <p class="text-lg md:text-xl text-gray-600">Date: {{ $date }}</p>
    </div>
    <!-- Print Button -->
    <button 
        onclick="window.print()" 
        class="print-button mt-6 px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300"
    >
        Print Certificate
    </button>
</body>
</html>
