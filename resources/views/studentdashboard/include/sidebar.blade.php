<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark sidebar-left bg-dark-gray" data-perfect-scrollbar>

            <div class="d-flex align-items-center sidebar-p-a sidebar-account flex-shrink-0">
                <a href="index.html" class="flex d-flex align-items-center text-underline-0">
                    
                    <span class="flex d-flex flex-column">
                        <span class="sidebar-brand"> <span class="self-center text-2xl font-semibold whitespace-nowrap ">
                            <img src="{{ asset('assets/comestro.png') }}" class="md:h-14 h-12 " alt="">
                        </span></span>
                        {{-- <small>Next Generation</small> --}}
                    </span>
                </a>
            </div>


            <ul class="sidebar-menu">
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="index.html">

                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">photo_filter</i>
                        <span class="sidebar-menu-text">Overview</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">Student</div>
            <div class="sidebar-block p-0">
                <ul class="sidebar-menu mt-0">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="student-dashboard.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">star_half</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.course')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">queue_play_next</i>
                            <span class="sidebar-menu-text">Courses</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('student.buyCourse', ['id' => $course->id]) }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">shopping_cart</i>
                            <span class="sidebar-menu-text">Purchase Course</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="student-lessons.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dns</i>
                            <span class="sidebar-menu-text">Browse Lessons</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{route('student.assignments-view')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">live_help</i>
                            <span class="sidebar-menu-text">Manage Assignment</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        {{-- <a class="sidebar-menu-button" href="student-quiz.html"> --}}
                        <a class="sidebar-menu-button" href="{{route('student.quiz')}}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">live_help</i>
                            <span class="sidebar-menu-text">Take Quiz</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="student-discussions.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">forum</i>
                            <span class="sidebar-menu-text">Discussions</span>
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


            {{-- <div class="sidebar-heading">Author</div>
            <div class="sidebar-block p-0">
                <ul class="sidebar-menu mt-0">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-dashboard.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                            <span class="badge badge-warning rounded-circle badge-notifications ml-auto">8</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-courses.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">layers</i>
                            <span class="sidebar-menu-text">Courses</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-quiz-manager.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment</i>
                            <span class="sidebar-menu-text">Quiz Manager</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-earnings.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">local_atm</i>
                            <span class="sidebar-menu-text">Earnings</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-reports.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">pie_chart</i>
                            <span class="sidebar-menu-text">Reports</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="author-payout.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">credit_card</i>
                            <span class="sidebar-menu-text">Payout</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="login.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">exit_to_app</i>
                            <span class="sidebar-menu-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div> --}}

            {{-- <div class="sidebar-heading">Admin</div>
            <div class="sidebar-block p-0">
                <ul class="sidebar-menu mt-0">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="admin-dashboard.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="admin-emails.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">email</i>
                            <span class="sidebar-menu-text">Emails</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="admin-chat.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">comment</i>
                            <span class="sidebar-menu-text">Chat</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="admin-tickets.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">local_offer</i>
                            <span class="sidebar-menu-text">Tickets</span>
                            <span class="badge badge-warning badge-notifications ml-auto">NEW</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="admin-trello.html">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">touch_app</i>
                            <span class="sidebar-menu-text">Trello</span>
                        </a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</div>