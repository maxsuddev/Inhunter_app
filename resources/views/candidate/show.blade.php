@extends('panel.layouts.app')

@section('content')
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{asset('storage/'.$candidate->photo_path)}}" alt="Profile" class="rounded-circle">
                            <h2>{{$candidate->full_name}}</h2>

                            <h3>{{ucfirst($candidate->status)}}</h3>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Edit</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">All</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                      <!-- Profile Edit Form -->
                                      <form action="{{ route('candidate.update', $candidate->id) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="full_name" type="text" class="form-control" id="full_name" value="{{$candidate->full_name}}">
                                            </div>
                                        </div>
                                        @error('full_name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone_number" type="text" class="form-control" id="Phone" value="{{ $candidate->phone_number}}">
                                            </div>
                                        </div>
                                        @error('phone_number')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror


                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address" value="{{$candidate->address}}">
                                            </div>
                                        </div>
                                        @error('address')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">University place</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="university_place" type="text" class="form-control" id="Country" value="{{$candidate->university_place}}">
                                            </div>
                                        </div>
                                        @error('university_place')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror


                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Last work</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="last_work" type="text" class="form-control" id="last_work" value="{{ $candidate->last_work }}">
                                            </div>
                                        </div>
                                          @error('last_work')
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              {{ $message}}
                                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                          @enderror


                                          <div class="row mb-3">
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Birthday</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <input name="birthday" type="date" class="form-control" id="last_work" value="{{ $candidate->birthday }}">
                                              </div>
                                          </div>
                                          @error('birthday')
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              {{ $message}}
                                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                          @enderror



                                          <div class="row mb-3">
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Last work</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <input name="positive_skills" type="text" class="form-control" id="last_work" value="{{ $candidate->positive_skills }}">
                                              </div>
                                          </div>
                                          @error('positive_skills')
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              {{ $message}}
                                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                          @enderror

                                          <div class="row mb-3">
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Languages</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <select class="form-control" aria-label="Default select example" id="language_id"  name="language_id">
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
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Apps</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <select class="form-control" aria-label="Default select example" id="app_id"  name="app_id">
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
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Marital State</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <select class="form-select" aria-label="Default select example" id="marital_state"  name="marital_state">
                                                      <option selected>Marital state</option>
                                                      @foreach($maritalStates as $key => $value)
                                                          <option value="{{ $key }}">{{$value}}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                              @error('marital_state')
                                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                  {{ $message}}
                                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                              </div>
                                              @enderror
                                          </div>


                                          <div class="row mb-3">
                                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                              <div class="col-md-8 col-lg-9">
                                                  <select class="form-select" aria-label="Default select example" id="app_id"  name="gender">
                                                      <option selected>Gender</option>
                                                      @foreach($gender as $key => $value)
                                                          <option value="{{ $key }}">{{$value}}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('gender')
                                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                      {{ $message}}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                  </div>
                                                  @enderror
                                              </div>
                                          </div>
                                          <fieldset class="row mb-3">
                                              <legend class="col-md-4 col-lg-3 col-form-label">Is Student</legend>
                                              <div class="col-md-8 col-lg-9">
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
                                                  </div>
                                              </div>
                                          </fieldset>
                                          @error('is_student')
                                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              {{ $message}}
                                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                          @enderror



                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->


                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{$candidate->full_name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">Web Designer</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">USA</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{$candidate->address}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{$candidate->phone_number}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                                    </div>

                                </div>





                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

@endsection

