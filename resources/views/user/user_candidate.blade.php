@extends('panel.layouts.app')
@section('title', 'User Candidate')
@section('page', 'Candidate Table')
@section('nav-user')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('user.vacancy', $user->id)}}"
                   class="{{ request()->routeIs('user.vacancy') ? 'active' : '' }}">
                    Vacancy
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('user.candidate', $user->id)}}"
                   class="{{ request()->routeIs('user.candidate') ? 'active' : '' }}">
                    Candidate
                </a>
            </li>
        </ol>


    </nav>
@endsection
@section('content')

        <section class="section profile">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users Tables</h5>
                            <form action="{{ route('user.candidate', $user->id) }}" method="GET">
                                <div class="mb-3">
                                    <label for="stateFilter" class="form-label">Filter by State</label>
                                    <div class="justify-content-between" role="group">
                                        <button type="submit" name="state" value="new" class="btn btn-primary {{ request('state') == 'new' ? 'active' : '' }}">
                                            New
                                        </button>
                                        <button type="submit" name="state" value="working" class="btn btn-success {{ request('state') == 'working' ? 'active' : '' }}">
                                            Working
                                        </button>
                                        <button type="submit" name="state" value="interview" class="btn btn-secondary {{ request('state') == 'interview' ? 'active' : '' }}">
                                            Interview
                                        </button>
                                        <button type="submit" name="state" value="archive" class="btn btn-danger {{ request('state') == 'archive' ? 'active' : '' }}">
                                            Archive
                                        </button>
                                        <button type="submit" name="state" value="hired" class="btn btn-danger {{ request('state') == 'hired' ? 'active' : '' }}">
                                            Hired
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>Full Name.</th>
                                    <th>Gender</th>
                                    <th>Language</th>
                                    <th>App</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                    <th>Show</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($candidates as $candidate)
                                <tr>
                                    <td>{{$candidate->id}}</td>
                                    <td>{{$candidate->full_name}}</td>
                                    <td>{{$candidate->gender}}</td>
                                    <td>{{$candidate->language->name}}</td>
                                    <td>{{$candidate->app->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($candidate->create_at)->format('d M, H:i') }}</td>
                                    <td> <a href="{{route('candidate.show',['candidate' => $candidate->id])}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeStateModal"
                                                data-candidate-id="{{ $candidate->id }}"
                                                data-candidate-status="{{ $candidate->status }}">
                                            Change Status
                                        </button>
                                    </td>
                                    <div class="modal fade" id="changeStateModal" tabindex="-1" aria-labelledby="changeStateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changeStateModalLabel">Change State</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('candidate.updateStatus', ['user' => $user->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="candidate_id" id="candidate_id" value="{{$candidate->id}}">

                                                        <div class="mb-3">
                                                            <div class="btn-group1" role="group">
                                                                <button type="submit" name="status" value="new" class="btn btn-primary" id="new_btn">New</button>
                                                                <button type="submit" name="status" value="working" class="btn btn-success" id="working_btn">Working</button>
                                                                <button type="submit" name="status" value="interview" class="btn btn-secondary" id="interview_btn">Interview</button>
                                                                <button type="submit" name="status" value="archive" class="btn btn-danger" id="archive_btn">Archive</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>

        </section>
@endsection

