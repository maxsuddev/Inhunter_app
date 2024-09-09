@extends('panel.layouts.app')

@section('content')


        <section class="section profile">
            <div class="row">
                

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Edit Category</button>
                                </li>  

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    
                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('category.edit', $category->id)}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Category Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name" value="{{$category->name}}">
                                            </div>
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror

                            <div class="row mb-3">
                                <label class="col-md-4 col-lg-3 col-form-label">Select</label>
                                <div class="col-md-8 col-lg-9">
                                    <select class="form-control" aria-label="Default select example" id="is_active"  name="is_active">
                                        @foreach($is_active as $key => $value)
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('is_active')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                                
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary"><i class="ri-edit-box-fill"></i>Edit</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                    <form action="{{ route('category.delete', $category->id)}}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this post?')"
                                    enctype="multipart/form-data">
                                   @csrf
                                   @method('DELETE')
                                   <div class="text-left">
                                   <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-fill"></i>Delete</button>
                                   </div>
                          </form>
                                </div>
                              
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>


@endsection

