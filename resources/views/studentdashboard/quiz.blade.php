@extends('studentDashboard.include.base')
@section('content')




<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">


    <div class="page__heading border-bottom">
        <div class="container-fluid page__container d-flex align-items-center">
            <h1 class="mb-0">Quiz</h1>
            <div class="ml-auto d-flex align-items-center">
                
                <div class="countdown" data-value="4" data-unit="hour"></div>
                <!-- <span class="badge badge-primary ml-2"><div class="material-icons icon-16pt">access_time</div></span> -->
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="media align-items-center">
                            <div class="media-left">
                                <h4 class="m-0 text-primary mr-2"><strong>#9</strong></h4>
                            </div>
                            <div class="media-body">
                                <h4 class="card-title m-0">
                                    Github command to deploy comits?
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck01" type="checkbox" class="custom-control-input">
                                <label for="customCheck01" class="custom-control-label">git push</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck02" type="checkbox" class="custom-control-input">
                                <label for="customCheck02" class="custom-control-label">git commit -m "message"</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input id="customCheck03" type="checkbox" class="custom-control-input">
                                <label for="customCheck03" class="custom-control-label">git pull</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-light">Skip</a>
                        <a href="#" class="btn btn-success float-right">Submit <i class="material-icons btn__icon--right">arrow_forward</i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="list-group">

                    <a href="#" class="list-group-item active">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#9</span>
                            </span>
                            <span class="media-body">
                                Github command to deploy comits?
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#10</span>
                            </span>
                            <span class="media-body">
                                What's the difference between private and public repos?
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#11</span>
                            </span>
                            <span class="media-body">
                                What is the purpose of a branch?
                            </span>
                        </span>
                    </a>


                    <a href="#" class="list-group-item">
                        <span class="media align-items-center">
                            <span class="media-left mr-2">
                                <span class="btn btn-light btn-sm">#12</span>
                            </span>
                            <span class="media-body">
                                Final Question?
                            </span>
                        </span>
                    </a>

                </div>
            </div>
        </div>

    </div>


</div>

@endsection