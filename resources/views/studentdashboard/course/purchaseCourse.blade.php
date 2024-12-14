@extends('studentDashboard.include.base')
@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page"
        style="padding-top: 60px;">


        <div class="page__heading border-bottom">
            <div class="container-fluid page__container d-flex align-items-center">
                <h1 class="mb-0">Courses</h1>
                <a href="quiz-edit.html" class="btn btn-success ml-auto"><i class="material-icons">add</i> New Course</a>
            </div>
        </div>

        <div class="container-fluid page__container">

            {{-- <form action="#" class="mb-3 border-bottom pb-3">
                <div class="d-flex">
                    <div class="search-form mr-3 search-form--light">
                        <input type="text" class="form-control" placeholder="Search courses" id="searchSample02">
                        <button class="btn" type="button"><i class="material-icons">search</i></button>
                    </div>

                    <div class="form-inline ml-auto">
                        <div class="form-group mr-3">
                            <label for="custom-select" class="form-label mr-1">Category</label>
                            <select id="custom-select" class="form-control custom-select" style="width: 200px;">
                                <option selected>All categories</option>
                                <option value="1">Vue.js</option>
                                <option value="2">Node.js</option>
                                <option value="3">GitHub</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="published01" class="form-label mr-1">Published</label>
                            <select id="published01" class="form-control custom-select" style="width: 200px;">
                                <option selected>Published</option>
                                <option value="1">Draft</option>
                                <option value="3">All</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form> --}}



            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex flex-column flex-sm-row">
                                    <a href="#" class="avatar mb-3 w-xs-plus-down-100 mr-sm-3">
                                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                                            alt="{{ $course->title }}" class="avatar-course-img">
                                    </a>
                                    <div class="flex" style="min-width: 200px;">
                                        <div class="d-flex">
                                            <div>
                                                <h4 class="card-title mb-1"><a href="#">{{ $course->title }}</a></h4>
                                                <p class="text-muted">{{ Str::limit($course->description, 100) }}</p>
                                                {{-- <p class="text-sm text-gray-500 mt-4">Instructor: {{ $course->instructor }}</p> --}}
                                            </div>
                                            {{-- <div class="dropdown ml-auto">
                                            <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Edit Course</a>
                                                <a class="dropdown-item" href="#">Statistics</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">Archive</a>
                                            </div>
                                        </div> --}}
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <div class="d-flex flex flex-column mr-3">
                                                <div class="d-flex align-items-center py-2 border-bottom">
                                                    {{-- <span class="mr-2 bg-secondary">Rs. {{ $course->discounted_fees }}</span> --}}
                                                    <small class="text-muted ml-auto"> <a
                                                            href="{{ route('course.show', $course->id) }}"> Start Course
                                                        </a></small>
                                                </div>
                                                <div class="d-flex align-items-center py-2">
                                                    <span class="badge badge-vuejs mr-2"> {{ $course->instructor }}</span>
                                                    <span class="badge badge-soft-secondary">₹ {{ $course->discounted_fees }}
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>


    </div>
    <!-- // END header-layout__content -->
@endsection
