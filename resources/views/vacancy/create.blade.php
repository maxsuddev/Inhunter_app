
@extends('panel.layouts.app')
@section('title', 'Vacancy')
@section('page', 'Add Vacancy')
@section('content')

    <div class="mb-3 align-left">
        <a href="{{ route('vacancy.index') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-fill"></i>Back</a>
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
                        <h5 class="card-title">Category element</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('vacancy.store') }}" method="POST">
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
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="category_id"  name="category_id">
                                        <option selected>Choose Category</option>
                                        @foreach($category as $item)
                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Company</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" id="company_id"  name="company_id">
                                        <option selected>Choose Company</option>
                                        @foreach($company as $company_item)
                                            <option value="{{ $company_item->id }}">{{$company_item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('$company_id')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="status" value="open_vacancy">
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
