<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark sidebar-left bg-dark-gray" data-perfect-scrollbar>

            <div class="d-flex align-items-center sidebar-p-a sidebar-account flex-shrink-0">
                <a href="index.html" class="flex d-flex align-items-center text-underline-0">
                    
                    <span class="flex d-flex flex-column">
                        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                            <span class="self-center text-2xl font-semibold whitespace-nowrap ">
                                <img src="{{ asset('assets/LearnSyntax.png') }}" class="md:h-8" alt="">
                            </span>
                        </a>
                    </span>
                        {{-- <small>Next Generation</small> --}}
                    </span>
                </a>
            </div>


            {{-- <ul class="sidebar-menu">
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="{{route('student.dashboard')}}">

                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">photo_filter</i>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
            </ul> --}}

            {{-- <div class="sidebar-heading">Student</div> --}}
            <div class="sidebar-block p-0">
                <ul class="sidebar-menu mt-0">

                     <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.dashboard')}}">

                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">star_half</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.course')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                            <span class="sidebar-menu-text">Courses</span>
                        </a>
                    </li>
                     
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.coursePurchase')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">shopping_cart</i>
                            <span class="sidebar-menu-text">My Course</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.assignments-view')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">live_help</i>
                            <span class="sidebar-menu-text">Manage Assignment</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" >
                        {{-- <a class="sidebar-menu-button" href="student-quiz.html"> --}}
                            {{-- {{dd($courses)}} --}}
                        <a class="sidebar-menu-button" href="{{route('student.course.quiz')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">live_help</i>
                            <span class="sidebar-menu-text">Take Quiz</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item" >
                        <a class="sidebar-menu-button" href="{{ route('student.course.result') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dns</i>
                            <span class="sidebar-menu-text">View Result</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.editProfile'  )}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                            <span class="sidebar-menu-text">Edit Account</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.billing')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">monetization_on</i>
                            <span class="sidebar-menu-text">Billing</span>
                        </a>
                    </li>
                
                    <li class="sidebar-menu-item">
                        <a href="{{ route('auth.logout') }}"class="sidebar-menu-button" >
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">exit_to_app</i>
                            <span class="sidebar-menu-text">Logout</span>
                        </a> 
                        
                    </li>
                </ul>
            </div>


         
        </div>
    </div>
</div>