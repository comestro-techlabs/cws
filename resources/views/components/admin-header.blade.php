<nav class="flex flex-wrap justify-between items-center mx-auto md:px-[2%] shadow-lg py-3 px-4 bg-red border-gray-200 dark:bg-gray-900">
    <div class="flex gap-2 items-center">
        <button class="md:hidden flex" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-slate-500">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
              </svg>
              
            </button>
        <a href="{{env('APP_URL')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                <img src="{{asset('assets/logosmall.png')}}" width="100px"/>
            </span>
        </a>
    </div>
    <div class="flex items-center space-x-6 rtl:space-x-reverse">
        <a href="#" class="text-sm  text-white rounded dark:text-blue-500 bg-black dark:bg-slate-700 px-3 py-2 hover:bg-red-600">Logout</a>
    </div>
</nav>

