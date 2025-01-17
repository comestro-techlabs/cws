<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="bg-white text-gray-800">
  <h1 class="text-black text-2xl font-bold text-center mt-8">Learn Syntax PVT .LIMITED</h1>

 
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
   
    <div class="bg-gray-100 text-gray-800 rounded-lg p-6 shadow-md mb-8">

    
      <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        <button class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 transition">
         <i class="bi bi-check-lg"></i> Done: View
        </button>
        <button class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-indigo-500 transition">
          To Do: Receive a Grade
        </button>
      </div>

      <hr class="border-gray-300 my-4">
   <div>
        <p class="text-lg font-semibold text-black">Opened: <span class="text-gray-500">Saturday, 7 December 2024, 9:00 AM</span></p>
        <p class="text-lg font-semibold text-black">Closed: <span class="text-gray-500">Saturday, 7 December 2024, 1:00 PM</span></p>
      </div>

      <hr class="border-gray-300 mt-4">
    

   
    <div>
      <h1 class="text-black text-2xl font-bold mt-4">INSTRUCTION:</h1>
      <div class=" text-black  mt-2 p-6">
        <ol class="list-decimal pl-6 space-y-4">
          <li class="text-lg">Ensure that you have a stable internet connection during the entire duration of the exam.</li>
          <li class="text-lg">You are not allowed to navigate away from the exam screen or open additional tabs.</li>
          <li class="text-lg">Use of any unauthorized resources or communication with others is strictly prohibited.</li>
          <li class="text-lg">Ensure that your camera and microphone are enabled for proctoring purposes.</li>
          <li class="text-lg">Read each question carefully and submit your answers within the allocated time.</li>
          <li class="text-lg">In case of technical issues, contact the invigilator immediately through the provided support link.</li>
        </ol>
      </div>
    </div>

   
    <div class="">
      <p class="text-xl font-semibold text-green-600">All THE BEST!!</p>
      <p class="text-md text-black mt-4">
        <strong>Note:</strong> Ensure you have completed all the instructions before starting the exam.
      </p>
    </div>

   
    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
      {{-- <a href="{{route('quiz.show')}}"><button class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow-md hover:bg-gray-400 w-full sm:w-auto">
        Go Back
      </button></a> --}}
      {{-- <button class="bg-blue-600 text-white px-4 py-2 rounded shadow-md hover:bg-blue-700 w-full sm:w-auto">
        Attempt Exam Now
      </button> --}}
      <a href="{{route('student.course.quiz')}}"><button class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow-md hover:bg-gray-400 w-full sm:w-auto">
        Go Back
      </button></a>
      
      <a href="{{ route('student.showquiz', $exam->id) }}" ><button class="bg-blue-600 text-white px-4 py-2 rounded shadow-md hover:bg-blue-700 w-full sm:w-auto">
        Attempt Exam Now
      </button></a>
    
    </div>
  </div>
  </div>
</body>

</html>
