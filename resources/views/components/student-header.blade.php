 <header class="bg-slate-100 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
       
        <a href="{{env('APP_URL')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">
                <img src="{{asset('assets/LearnSyntax.png')}}" width="150px"/>
            </span>
        </a>

        <nav id="navMenu" class="hidden md:flex space-x-6">
            <a href="#" class="hover:text-gray-200">Profile</a>
        </nav>

        

       
        <button id="menuBtn" class="md:hidden text-white focus:outline-none">
            ☰
        </button>
    </div>

   
    <div id="mobileMenu" class="hidden flex flex-col space-y-2 p-4 md:hidden bg-blue-700">
         <a href="#" class="hover:text-gray-200">Dashboard</a>
        <a href="{{env('APP_URL')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">
                <img src="{{asset('assets/LearnSyntax.png')}}" width="150px"/>
            </span>
        </a>
    </div>
</header>

<script>
    document.getElementById('menuBtn').addEventListener('click', function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script> 

