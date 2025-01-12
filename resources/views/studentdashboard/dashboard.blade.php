@extends('studentdashboard.include.base')
@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">


        <div class="container-fluid page__container">

            <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
                <i class="material-icons mr-3">error_outline</i>
                <div class="text-body">You have <strong>5 days left</strong> on your subscription</div>
                <a href="#" class="btn btn-warning ml-auto">Upgrade</a>
            </div>

            <div class="row">
                <div class="col-lg-7">

                    <div class="card">
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-header__title">In Progress</h4>
                                <div class="card-subtitle text-muted">Your recent courses</div>
                            </div>
                            <div class="ml-auto">
                                <a href="student-courses.html" class="btn btn-light">Browse All</a>
                            </div>
                        </div>




                        <ul class="list-group list-group-flush mb-0" style="z-index: initial;">

                            <li class="list-group-item" style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">
                                        <img src="{{ asset('assets/images/logos/vuejs.svg')}}" alt="course" class="">

                                    </a>
                                    <div class="flex">
                                        <a href="#" class="text-body"><strong>Learn Vue.js Fundamentals</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress" style="width: 100px; height:4px;">
                                                <div class="progress-bar bg-vuejs" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">25%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View Stats</a>
                                            <a class="dropdown-item" href="#">Proceed</a>
                                            <a class="dropdown-item" href="#">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item" style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">
                                        <img src="{{ asset('assets/images/logos/angular.svg')}}" alt="course" class="">

                                    </a>
                                    <div class="flex">
                                        <a href="#" class="text-body"><strong>Angular in Steps</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress" style="width: 100px; height:4px;">
                                                <div class="progress-bar bg-angular" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">100%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View Stats</a>
                                            <a class="dropdown-item" href="#">Proceed</a>
                                            <a class="dropdown-item" href="#">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item" style="z-index: initial;">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">
                                        <img src="{{ asset('assets/images/logos/javascript.svg')}}" alt="course" class="">

                                    </a>
                                    <div class="flex">
                                        <a href="#" class="text-body"><strong>ES6 Foundations</strong></a>
                                        <div class="d-flex align-items-center">
                                            <div class="progress" style="width: 100px; height:4px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted ml-2">80%</small>
                                        </div>
                                    </div>
                                    <div class="dropdown ml-3">
                                        <a href="#" class="dropdown-toggle text-muted" data-caret="false" data-toggle="dropdown">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View Stats</a>
                                            <a class="dropdown-item" href="#">Proceed</a>
                                            <a class="dropdown-item" href="#">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-large bg-light d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-header__title">My Quizes</h4>
                                <div class="card-subtitle text-muted">Skill tests</div>
                            </div>
                            <div class="dropdown ml-auto">
                                <a class="btn btn-sm btn-light" href="#">View all</a>
                            </div>
                        </div>



                        <ul class="list-group list-group-flush mb-0">

                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a class="text-body mb-1" href="#"><strong>Level 1 HTML</strong></a><br>
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i> <a href="take-course.html" class="small text-muted">Basics of HTML</a>
                                        </div>
                                    </div>
                                    <div class="media-right text-center d-flex align-items-center">
                                        <span class="badge badge-warning mr-2">
                                            Good
                                        </span>
                                        <h4 class="mb-0 text-warning">5.8</h4>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a class="text-body mb-1" href="#"><strong>Level 2 Angular</strong></a><br>
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i> <a href="take-course.html" class="small text-muted">Angular in Steps</a>
                                        </div>
                                    </div>
                                    <div class="media-right text-center d-flex align-items-center">
                                        <span class="badge badge-success mr-2">
                                            Great
                                        </span>
                                        <h4 class="mb-0 text-success">9.8</h4>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <a class="text-body mb-1" href="#"><strong>Graduation</strong></a><br>
                                        <div class="d-flex align-items-center">
                                            <i class="material-icons icon-16pt text-muted mr-1">queue_play_next</i> <a href="take-course.html" class="small text-muted">Bootstrap Foundations</a>
                                        </div>
                                    </div>
                                    <div class="media-right text-center d-flex align-items-center">
                                        <span class="badge badge-danger mr-2">
                                            Failed
                                        </span>
                                        <h4 class="mb-0 text-danger">2.8</h4>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- START ACTIVITY -->
                    <div class="card">
                        <div class="card-header card-header-large bg-white d-flex align-items-center">
                            <h4 class="card-header__title flex m-0">Recent Activity</h4>
                            <div class=" flatpickr-wrapper flatpickr-calendar-right d-flex ml-auto">
                                <div data-toggle="flatpickr" data-flatpickr-wrap="true" data-flatpickr-static="true" data-flatpickr-mode="range" data-flatpickr-alt-format="d/m/Y" data-flatpickr-date-format="d/m/Y">
                                    <a href="javascript:void(0)" class="link-date" data-toggle>13/03/2018 <span class="text-muted mx-1">to</span> 20/03/2018</a>
                                    <input class="d-none" type="hidden" value="13/03/2018 to 20/03/2018" data-input>
                                </div>
                            </div>
                        </div>
                        <div class="card-header card-header-tabs-basic nav" role="tablist">
                            <a href="#activity_all" class="active" data-toggle="tab" role="tab" aria-controls="activity_all" aria-selected="true">All</a>
                            <a href="#activity_purchases" data-toggle="tab" role="tab" aria-controls="activity_purchases" aria-selected="false">Purchases</a>
                            <a href="#activity_emails" data-toggle="tab" role="tab" aria-controls="activity_emails" aria-selected="false">Emails</a>
                            <a href="#activity_quotes" data-toggle="tab" role="tab" aria-controls="activity_quotes" aria-selected="false">Quotes</a>
                        </div>
                        <div class="list-group tab-content list-group-flush">
                            <div class="tab-pane active show fade" id="activity_all">


                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
                                        </span>
                                    </div>


                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>


                                            <strong class="text-15pt mr-1">Jenell D. Matney</strong>
                                        </div>
                                        <small class="text-muted">4 days ago</small>
                                    </div>
                                    <div>$573</div>


                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
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

                                <div class="list-group-item list-group-item-action d-flex align-items-center  bg-light ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
                                        </span>
                                    </div>


                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_jeremy-banks-798787-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>


                                            <strong class="text-15pt mr-1">Joseph S. Ferland</strong>
                                        </div>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                    <div>$244</div>


                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center  bg-light ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
                                        </span>
                                    </div>


                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_joao-silas-636453-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>


                                            <strong class="text-15pt mr-1">Bryan K. Davis</strong>
                                        </div>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                    <div>$664</div>


                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center  bg-light ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <img src="{{ asset('assets/images/logo.svg')}}" width="20" alt="avatar">
                                        </span>
                                    </div>


                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_michael-dam-258165-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>


                                            <strong class="text-15pt mr-1">Kaci M. Langston</strong>
                                        </div>
                                        <small class="text-muted">just now</small>
                                    </div>
                                    <div>$631</div>


                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="card-footer text-center border-0">
                                    <a class="text-muted" href="#">View All (54)</a>
                                </div>
                            </div>
                            <div class="tab-pane" id="activity_purchases">

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Sherri J. Cardenas</strong>

                                        </div>
                                        <small class="text-muted">4 days ago</small>
                                    </div>
                                    <div>$573</div>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Joseph S. Ferland</strong>

                                        </div>
                                        <small class="text-muted">3 days ago</small>
                                    </div>
                                    <div>$612</div>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_jeremy-banks-798787-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Bryan K. Davis</strong>

                                        </div>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                    <div>$244</div>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center  bg-light ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_joao-silas-636453-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Kaci M. Langston</strong>

                                        </div>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                    <div>$664</div>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                                <div class="list-group-item list-group-item-action d-flex align-items-center  bg-light ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="material-icons">monetization_on</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_michael-dam-258165-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1"></strong>

                                        </div>
                                        <small class="text-muted">just now</small>
                                    </div>
                                    <div>$631</div>
                                    <i class="material-icons icon-muted ml-3">arrow_forward</i>
                                </div>

                            </div>
                            <div class="tab-pane" id="activity_emails">

                                <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                    <div class="avatar avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-secondary">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>

                                    <div class="flex">
                                        <div class="d-flex align-items-middle">
                                            <div class="avatar avatar-xxs mr-1">
                                                <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg')}}" alt="Avatar" class="avatar-img rounded-circle">
                                            </div>
                                            <strong class="text-15pt mr-1">Jenell D. Matney</strong>

                                        </div>
                                        <small>Confirmation required for design</small>
                                    </div>
                                    <small class="text-muted">4 days ago</small>
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
                                </div>

                            </div>
                            <div class="tab-pane" id="activity_quotes"></div>
                        </div>
                    </div>
                    <!-- END ACTIVITY -->

                    <!-- START SKILLS -->

                    <div class="card">
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
                    </div>
                    <!-- END SKILLS -->
                </div>
            </div>
        </div>


    </div>
    <!-- // END header-layout__content -->
@endsection
