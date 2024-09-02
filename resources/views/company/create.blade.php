
@extends('panel.layouts.app')
@section('title', 'Company')
@section('page', 'Add Company')
@section('content')

    <div class="mb-3 align-left">
        <a href="{{ route('company.index') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-fill"></i>Back</a>
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
                        <form action="{{route('company.store')}}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @enderror

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Owner</label>
                                <div class="col-sm-10">
                                    <input type="text" name="owner_name" class="form-control">
                                </div>
                            </div>
                            @error('owner_name')
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
    </section>@endsection
