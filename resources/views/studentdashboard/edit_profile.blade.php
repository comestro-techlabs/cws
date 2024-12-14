@extends('studentdashboard.include.base')
@section('content')

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">


    <div class="page__heading border-bottom mb-4">
        <div class="container-fluid page__container d-flex align-items-center">
            <h1 class="mb-0">Edit Account</h1>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{route('student.updateProfile')}}" method="post">
        @csrf
        <div class="container-fluid page__container">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color">Basic Information</strong></p>
                        <p class="text-muted mb-0">Edit your account details and settings.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ old('name', $student->name) }}"  type="text" class="form-control py-4"  >
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control py-4" value="{{ old('contact', Auth::user()->contact) }}">
                        </div>
                        <div class="form-group">
                            <label for="education_qualification">Education Qualification</label>
                            <input type="text" id="education_qualification" name="education_qualification" class="form-control py-4" value="{{ old('education_qualification', Auth::user()->education_qualification) }}">

                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth</label><br>
                            <input type="date" id="dob" name="dob" class="form-control py-4" value="{{ old('dob', Auth::user()->dob) }}">

                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-control py-2" required>
                                <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control py-4" value={{ old('password',Auth::user()->password)}}  required>
                        </div>
                    </div>
                </div>
            </div>

           

            
            <div class="text-right mb-5">
                <button type="submit" class="btn btn-success">Update Profile</button>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Cancel</a>

            </div>
        </div>
    </form>

</div>
    
@endsection