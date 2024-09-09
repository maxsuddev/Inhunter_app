@extends('panel.layouts.app')

@section('content')


        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="#" alt="Profile" class="rounded-circle">
                            <h2>{{$company->name}}</h2>
                            <h3>Web Designer</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Edit Company</button>
                                </li>  

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    
                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('company.edit', $company->id)}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Company Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="fullName" value="{{$company->name}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Owner Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="owner_name" type="text" class="form-control" id="fullName" value="{{$company->owner_name}}">
                                            </div>
                                        </div>

                                    

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone_number" type="text" class="form-control" id="Phone" value="{{$company->phone_number}}">
                                            </div>
                                        </div>

                                
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary"><i class="ri-edit-box-fill"></i>Edit</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                
                                </div>
                                <form action="{{ route('company.delete', $company->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this post?')"
                                    enctype="multipart/form-data">
                                   @csrf
                                   @method('DELETE')
                                   <div class="text-left">
                                   <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-fill"></i>Delete</button>
                                   </div>
                          </form>
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>


@endsection

