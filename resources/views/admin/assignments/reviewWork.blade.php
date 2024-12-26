<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Design</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <div class="flex items-center justify-between px-6 py-3 bg-white shadow-md">
    <!-- Left Section -->
    <div class="flex items-center space-x-3">
      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-orange-500 text-white">
        S
      </div>
      <div>
        <p class="text-sm font-medium text-gray-700">Sarita Kumari</p>
        <p class="text-xs text-green-500">Turned in</p>
      </div>
    </div>

    <!-- Center Section -->
    <div class="text-gray-500">
      <p>asdfghj</p>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-4">
      <!-- Icon 1 -->
      <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
          <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v12a1 1 0 01-1 1H5a1 1 0 01-1-1V3z" />
        </svg>
      </button>

      <!-- Icon 2 -->
      <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zM6 8a8 8 0 1016 0 8 8 0 00-16 0z" clip-rule="evenodd" />
        </svg>
      </button>

      <!-- Profile Icon -->
      <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
        S
      </div>
    </div>
  </div>



  <div class="flex w-full">
    <div class="w-9/12 bg-yellow-100 h-screen">
        <div class="w-full h-full border rounded-lg mt-4">
            <iframe 
                src="https://drive.google.com/file/d/1ABCD12345EFGH67890/preview" 
                class="w-full h-[500px] border rounded-lg">
            </iframe>
        </div>
    </div>
</div>

    <div class="w-3/12"></div>

  </div>
</body>
</html>
