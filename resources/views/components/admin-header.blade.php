<!-- component -->
<nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full rounded-full">

    <div class="mb-2 sm:mb-0 flex flex-row
    ">
    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>


    </div>

    <div class="sm:mb-0 self-center">
      <!-- <div class="h-10" style="display: table-cell, vertical-align: middle;"> -->
      <a href="#" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1">Link1</a>
      <a href="#" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Link2</a>
      <!-- <a href="/two" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">About Us</a> -->
      <a href="#" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Link3</a>
      <!-- </div> -->

    </div>
  </nav>
