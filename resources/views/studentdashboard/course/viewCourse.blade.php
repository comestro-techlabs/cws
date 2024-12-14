@extends('studentDashboard.include.base')
@section('content')
   
 <!-- Header Layout Content -->
 <div class="mdk-header-layout__content page">

    <div class="page__heading border-bottom">
        <div class="container page__container d-flex align-items-center">
            <h1 class="mb-0">{{$course->title}}&#39;s Guide</h1>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-lg-8">
                <a href="#" class="dp-preview card">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="digital product" class="img-fluid " style="height: 80%">
                    <span class="dp-preview__overlay">
                        <span class="btn btn-light">Preview</span>
                    </span>
                </a>
                <div class="mb-3"><strong class="text-dark-gray">DESCRIPTION</strong></div>
                <p class="mb-3">
                    {{$course->description}} 
                 </p>


                <div class="">
                    <ul class="list-group list-lessons">
                        <li class="list-group-item d-flex">
                            <a href="fixed-#">1. Wireframe</a>
                            <div class="ml-auto d-flex align-items-center">
                                <span class="badge badge-success mr-2">FREE</span>
                                <span class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</span>
                            </div>
                        </li>
                        
                      
                    </ul>
                </div>
                <div class="bg-white rounded-lg p-6 border-left border-top border-bottom border-right border-secondary">
                    <h2 class="text-2xl font-weight-bold text-primary mb-4">Course Content</h2>
                    <div id="accordion" class="accordion">
                        @foreach ($course->chapters as $chapter)
                        <div class="card">
                            <div class="card-header" id="heading{{ $loop->index }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link d-flex justify-content-between w-100 text-left font-weight-bold text-dark"
                                        type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                                        aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                        <span>{{ $chapter->title }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" fill="none" viewBox="0 0 10 6" class="rotate-180">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5L5 1 1 5" />
                                        </svg>
                                    </button>
                                </h5>
                            </div>
                
                            <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                                <div class="card-body px-4 py-2 text-sm text-dark">
                                    @foreach ($chapter->lessons as $lesson)
                                    <a href="#" class="d-flex align-items-center text-dark py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2" style="width: 20px; height: 20px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                        {{ $lesson->title }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-body" data-toggle="dropdown">Monthly</a>
                            <div class="dropdown-menu py-0">
                                <div class="dropdown-item py-3 border-bottom d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span>Montly</span>
                                        <strong class="ml-auto h4 m-0">${{$course->fees}}</strong>
                                    </div>
                                    <ul class="pl-4 mb-2 text-muted">
                                        <li>Use for a single month</li>
                                        <li>Basic access to app</li>
                                    </ul>
                                    <small class="text-muted">Read more about <a href="#">Subscriptions</a></small>
                                </div>
                                <div class="dropdown-item py-3 d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span>Yearly</span>
                                        <span class="ml-auto h4 m-0">$599.00</span>
                                    </div>
                                    <ul class="pl-4 mb-2 text-muted">
                                        <li>Use for a year</li>
                                        <li>PRO acces to app</li>
                                    </ul>
                                    <small class="text-muted">Read more about <a href="#">Subscriptions</a></small>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto h2 mb-0"><strong>{{$course->fees}}</strong></div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-block btn-lg">Purchase</button>
                        <button class="btn btn-light btn-block">Preview</button>
                    </div>

                    <div class="mb-4 text-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">

                            <span class="mb-1">
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                            </span>
                            <div class="d-flex align-items-center">
                                <strong>4.7/5</strong>
                                <span class="text-muted ml-1">&mdash; 4 reviews</span>
                            </div>

                        </div>
                    </div>

                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Level</strong>
                            <div class="ml-auto">Beginner</div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Released</strong>
                            <div class="ml-auto">21 January 2019</div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Students</strong>
                            <div class="ml-auto">393</div>
                        </div>
                    </div>

                    <div class="card card-body mb-0 bg-dark">
                        <ul class="list-unstyled text-white ml-1 mb-0">
                            <li class="d-flex align-items-center pb-1"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> Created by the Frontted Team</li>
                            <li class="d-flex align-items-center pb-1"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> 6 Months Support</li>
                            <li class="d-flex align-items-center"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> 100% Money Back Guarantee</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- // END Header Layout Content -->
@endsection
