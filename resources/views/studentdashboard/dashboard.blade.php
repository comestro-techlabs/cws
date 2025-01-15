@extends('studentdashboard.include.base')
@section('content')


    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
        @if ($courses->isEmpty())
        
        <div class="flex flex-col items-center justify-center mt-12 md:mt-16 lg:mt-20 text-center px-6 md:px-4 space-y-2">
            <img src="{{ asset('assets/welcome.png') }}" class="w-56 md:w-64 lg:w-72 ">
            <h4 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">
                Welcome! Please purchase a course to access your dashboard.
            </h4>
            <a href="{{route('student.course')}}" >
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-sm md:text-lg">
                    Browse Courses
                </button>
             
            </a>
        </div>
        
    @else
        <div class="container-fluid page__container">

            {{-- <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
                <i class="material-icons mr-3">error_outline</i>
                <div class="text-body">You have <strong>5 days left</strong> on your subscription</div>
                <a href="#" class="btn btn-warning ml-auto">Upgrade</a>
            </div> --}}

            <div class="row">
                <div class="col-lg-7">

                    <div class="card">
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-header__title">My Courses</h4>
                                <div class="card-subtitle text-muted">Your recent courses</div>
                            </div>
                            <div class="ml-auto">
                                <a href="{{route('student.coursePurchase')}}" class="btn btn-light">Browse All</a>
                            </div>
                        </div>




                        <ul class="list-group list-group-flush mb-0" style="z-index: initial;">
                            @foreach ($courses as $course)
                            <li class="list-group-item" style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">
                                         {{-- <img src="{{ asset('assets/images/logos/vuejs.svg')}}" alt="course" class=""> --}}
                                         <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="course" class=""> 

                                    </a>
                                    <div class="flex">
                                        {{-- <a href="#" class="text-body"><strong>Learn Vue.js Fundamentals</strong></a> --}}
                                        <a href="#" class="text-body"><strong>{{ $course->title }}</strong></a>
                                        {{-- <div class="d-flex align-items-center">
                                            <div class="progress" style="width: 100px; height:4px;">
                                                <div class="progress-bar bg-vuejs" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">25%</small>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="dropdown ml-3">
                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View Stats</a>
                                            <a class="dropdown-item" href="#">Proceed</a>
                                            <a class="dropdown-item" href="#">Close</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </li>

                           @endforeach
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-header__title">My Assignments</h4>
                                <div class="card-subtitle text-muted">Skill tests</div>
                            </div>
                            <div class="dropdown ml-auto">
                                <a class="btn btn-sm btn-light" href="{{route('student.assignments-view')}}">View all</a>
                            </div>
                        </div>
                        @if($assignments->isEmpty())
                        <div class="flex flex-col items-center justify-center mt-4 text-center ">
                            <img src="{{ asset('assets/images/no-data/No data-cuate.png') }}" alt="No assignments" class="w-32 mx-auto">
                            <p class="text-gray-500">No assignments available</p>
                        </div>

                        @else
                        <ul class="list-group list-group-flush mb-0">
                          @foreach($assignments as $assignment)
                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-body">
        
                                        <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i>
                                        <strong> {{ $assignment->title }}</strong><br> 
                                        <div class="d-flex align-items-center">
                                        {{-- <a href="take-course.html" class="small text-muted"></a>  --}}
                                          
                                        </div>
                                    </div>
                                    <div class="media-right text-center d-flex align-items-center">
                                        {{-- <span class="badge badge-warning mr-2">
                                            Good
                                        </span>
                                        <h4 class="mb-0 text-warning">5.8</h4>  --}}
                                        @if ($assignment->uploads->isNotEmpty())
                                                    @foreach ($assignment->uploads as $upload)
                                                        <span
                                                            class="
                                                            @if ($upload->status == 'submitted') bg-green-500 text-white rounded-lg px-2 py-1
                                                            @elseif($upload->status == 'graded') bg-red-500 text-white rounded-lg px-2 py-1 
                                                            @else text-red-500 @endif
                                                        ">
                                                            {{ ucfirst($upload->status) }}
                                                        </span><br>
                                                    @endforeach
                                                @else
                                                    <span class="bg-gray-500 text-white rounded-lg px-2 py-1">No uploads</span>
                                                @endif
                                    </div>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- START ACTIVITY -->
                    <div class="card">
                        <div class="card-header card-header-large bg-white d-flex align-items-center">
                            <h4 class="card-header__title flex m-0">Quizzes</h4>
                            {{-- <div class=" flatpickr-wrapper flatpickr-calendar-right d-flex ml-auto">
                                <div data-toggle="flatpickr" data-flatpickr-wrap="true" data-flatpickr-static="true" data-flatpickr-mode="range" data-flatpickr-alt-format="d/m/Y" data-flatpickr-date-format="d/m/Y">
                                    <a href="javascript:void(0)" class="link-date" data-toggle>13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                                    <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-header card-header-tabs-basic nav" role="tablist">
                            @if(!$exams->isEmpty())
                            <a href="#activity_all" class="active" data-toggle="tab" role="tab" aria-controls="activity_all" aria-selected="true">My Quiz</a>
                           
                            <a href="#activity_purchases" data-toggle="tab" role="tab" aria-controls="activity_purchases" aria-selected="false">First Attempt</a>
                            <a href="#activity_emails" data-toggle="tab" role="tab" aria-controls="activity_emails" aria-selected="false">Second Attempt</a>
                            @endif
                            {{-- <a href="#activity_quotes" data-toggle="tab" role="tab" aria-controls="activity_quotes" aria-selected="false">Quotes</a> --}}
                        </div>
                        <div class="list-group tab-content list-group-flush">
                            <div class="tab-pane active show fade" id="activity_all">
                                @if($exams->isEmpty())
                                    <div class="flex flex-col items-center justify-center mt-4 text-center ">
                                        <img src="{{ asset('assets/images/no-data/No data-pana.png') }}" alt="No assignments" class="w-32 mx-auto">
                                        <p class="text-gray-500">No Quiz available</p>
                                    </div>

                                @else

                                    @foreach($exams as $exam)
                                    <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                        {{-- <div class="avatar avatar-xs mr-3">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
                                            </span>
                                        </div> --}}


                                        <div class="flex">
                                            <div class="d-flex align-items-middle">
                                                {{-- <div class="avatar avatar-xxs mr-1">
                                                    <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                                </div> --}}
                                                
                                                <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i>

                                                <strong class="text-15pt mr-1">Exam: {{$exam->exam_name}}</strong>
                                            </div>
                                            {{-- <small class="text-muted">4 days ago</small> --}}
                                        </div>
                                        {{-- <div>$573</div> --}}


                                        <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                    </div>
                                    @endforeach
                               

                                <div class="card-footer text-center border-0">
                                    <a class="text-muted" href="{{route('student.course.quiz')}}">View All</a>
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="activity_purchases">
                                @if($first_attempts->isEmpty())
                                    <div class="flex flex-col items-center justify-center mt-4 text-center ">
                                        <img src="{{ asset('assets/images/no-data/No data-amico.png') }}" alt="No assignments" class="w-32 mx-auto">
                                        <p class="text-gray-500">Not Attempted Yet</p>
                                    </div>

                                @else
                                @foreach($first_attempts as $attempt)
                                    <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                        {{-- <div class="avatar avatar-xs mr-3">
                                            <span class="avatar-title rounded-circle bg-success">
                                                <i class="material-icons">monetization_on</i>
                                            </span>
                                        </div> --}}

                                        <div class="flex">
                                            <div class="d-flex align-items-middle">
                                                {{-- <div class="avatar avatar-xxs mr-1">
                                                    <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                                </div> --}}
                                                <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i>

                                                <strong class="text-15pt mr-1">Exam: {{$attempt['exam_name']}}</strong>

                                            </div>
                                            {{-- <small class="text-muted">4 days ago</small> --}}
                                        </div>
                                        <div>Marks: {{$attempt['total_marks']}}</div>
                                        <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="tab-pane" id="activity_emails">
                                @if($second_attempts->isEmpty())
                                    <div class="flex flex-col items-center justify-center mt-4 text-center ">
                                        <img src="{{ asset('assets/images/no-data/No data-amico.png') }}" alt="Not attempted yet" class="w-32 mx-auto">
                                        <p class="text-gray-500">Not Attempted Yet</p>
                                    </div>

                                @else
                                    @foreach ($second_attempts as $attempt)
                                        <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                            {{-- <div class="avatar avatar-xs mr-3">
                                                <span class="avatar-title rounded-circle bg-secondary">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div> --}}

                                            <div class="flex">
                                                <div class="d-flex align-items-middle">
                                                    {{-- <div class="avatar avatar-xxs mr-1">
                                                        <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                                    </div> --}}
                                                    <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i>

                                                    <strong class="text-15pt mr-1">Exam: {{ $attempt['exam_name'] }}</strong>

                                                </div>
                                                {{-- <small>Confirmation required for design</small> --}}
                                            </div>
                                            <small class="text-muted">Marks: {{ $attempt['total_marks'] }}</small>
                                            <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                        </div>
                                    @endforeach
                                @endif    
                                {{-- <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-secondary">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Sherri J. Cardenas</strong>

                                        </div>
                                        <small>Improve spacings on Projects page</small>
                                    </div>
                                    <small class="text-muted">3 days ago</small>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-secondary">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_jeremy-banks-798787-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Joseph S. Ferland</strong>

                                        </div>
                                        <small>You unlocked a new Badge</small>
                                    </div>
                                    <small class="text-muted">2 days ago</small>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div> --}}

                            </div>
                            {{-- <div class="tab-pane" id="activity_quotes"></div> --}}
                        </div>
                    </div>
                    <!-- END ACTIVITY -->

                    <!-- START SKILLS -->


                    {{-- <div class="card">

                        <div class="card-header">
                            <h4 class="card-header__title">Skills</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-skills">
                                <li>
                                    <div>HTML</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>61%</strong></div>
                                </li>
                                <li>
                                    <div>CSS/SCSS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>39%</strong></div>
                                </li>
                                <li>
                                    <div>JAVASCRIPT</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 76%;" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>76%</strong></div>
                                </li>
                                <li>
                                    <div>RUBY ON RAILS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 28%;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>28%</strong></div>
                                </li>
                                <li>
                                    <div>VUEJS</div>
                                    <div class="flex">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-vuejs" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="text-dark-gray"><strong>50%</strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer text-center border-0">
                            <a href="#">
                                <span class="text-muted">View All</span>
                            </a>
                        </div>
                    </div> --}}
                    <!-- END SKILLS -->
                </div>
            </div>
        </div>

@endif
    </div>
    <!-- // END header-layout__content -->
@endsection
