
@extends('panel.layouts.app')
@section('title', 'Company')
@section('page', 'Add Company')
@section('content')
    <div class="mb-3 align-left">
        <a href="{{ route('candidate.index') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-fill"></i>Back</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Company elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{route('candidate.store')}}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="full_name" class="form-control">
                                </div>
                            </div>
                            @error('full_name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" class="form-control">
                                </div>
                            </div>
                            @error('phone_number')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            @error('address')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">University place</label>
                                <div class="col-sm-10">
                                    <input type="text" name="university_place" class="form-control">
                                </div>
                            </div>
                            @error('university_place')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Last work</label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_work" class="form-control">
                                </div>
                            </div>
                            @error('last_work')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Birthday</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="birthday">
                                </div>
                            </div>

                            @error('birthday')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Positive skills</label>
                                <div class="col-sm-10">
                                    <input type="text" name="positive_skills" class="form-control">
                                </div>
                            </div>
                            @error('positive_skills')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="language_id"  name="language_id">
                                        <option selected>Languages</option>
                                        @foreach($languages as $language)
                                        <option value="{{ $language->id }}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="app_id"  name="app_id">
                                        <option selected>Apps</option>
                                        @foreach($apps as $app)
                                            <option value="{{ $app->id }}">{{$app->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('app_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="marital_state"  name="marital_state">
                                        <option selected>Marital state</option>
                                        @foreach($maritalStates as $key => $value)
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('app_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="app_id"  name="gender">
                                        <option selected>Gender</option>
                                        @foreach($gender as $key => $value)
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('app_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Is Student</legend>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="is_student" id="is_student_yes" value="1">
                                        <label class="form-check-label" for="is_student_yes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_student" id="is_student_no" value="0">
                                        <label class="form-check-label" for="is_student_no">
                                            No
                                        </label>
                                        <input type="hidden" name="status" value="new">
                                    </div>
                                </div>
                            </fieldset>
                            @error('is_student')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror






                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button  class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
