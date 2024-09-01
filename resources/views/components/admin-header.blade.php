<nav class="fixed top-0 z-50 w-full  bg-white flex flex-wrap justify-between items-center mx-auto md:px-[2%] shadow-lg py-3 px-4 bg-red border-gray-200 dark:bg-gray-900">
    <div class="flex gap-2 items-center">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="{{env('APP_URL')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                <img src="{{asset('assets/logosmall.png')}}" width="100px"/>
            </span>
        </a>
    </div>
    <div class="flex items-center space-x-6 rtl:space-x-reverse">
        <a href="{{route('logout')}}" class="text-sm  text-white rounded dark:text-blue-500 bg-black dark:bg-slate-700 px-3 py-2 hover:bg-red-600">Logout</a>
    </div>
</nav>
<br>
<br>
