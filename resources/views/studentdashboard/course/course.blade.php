@extends('studentdashboard.include.base')
@section('content')
   
 <!-- Header Layout Content -->
 <div class="mdk-header-layout__content page">



    <div class="page__heading border-bottom">
        <div class="container page__container d-flex align-items-center">
            <h1 class="mb-0">Courses</h1>
        </div>
    </div>

    <div class="container-fluid page__container">
        <form action="#" class="mb-3 border-bottom pb-3">
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
                        <label for="published01" class="form-label mr-1">Status</label>
                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                            <option selected>All</option>
                            <option value="1">In Progress</option>
                            <option value="3">New Releases</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">

            @foreach ($courses as $course)
            <div class="col-md-3">
                <div class="card card__course">
                    <div class="card-header card-header-large ">
                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}" class="mb-1" style="width:100%;" alt="logo">
                        </a>
                    </div>
                    <div class="p-3">
                        <div class="mb-2">
                            <span class="mr-2">
                                <h6 class=" mb-1"><a href="#">{{ $course->title }}</a></h4>
                                    <a href="#" class="rating-link active">Instructor: <span class="display-9 text-base text-secondary">{{ $course->instructor }}</span></a>
                                    {{-- <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons icon-16pt">star_half</i></a> --}}
                            </span>
                            {{-- <strong>4.7</strong><br /> --}}
                            {{-- <small class="text-muted">(391 ratings)</small> --}}
                        </div>
                        <div class="d-flex align-items-center">
                            <strong class="h6 m-0">₹ {{ $course->discounted_fees }}</strong>
                            <a href="{{ route('student.buyCourse', ['id' => $course->id]) }}" class="btn btn-primary ml-auto">
                                <i class="material-icons">add_shopping_cart</i>
                            </a>                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        
        </div>
        <hr>
        <div class="d-flex flex-row align-items-center mb-3">
            <div class="form-inline">
                <div class="pagination-info">
                    {{ $courses->firstItem() }} - {{ $courses->lastItem() }} of {{ $courses->total() }}
                </div>
            </div>
            <div class="ml-auto">
               
                <div class="pagination-controls">
                    {{ $courses->links('pagination::bootstrap-4') }} <!-- Bootstrap 4 pagination -->
                </div>
            </div>
        </div>

    </div>

</div>
<!-- // END Header Layout Content -->
@endsection
