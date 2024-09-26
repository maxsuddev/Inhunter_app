@extends('panel.layouts.app')
@section('title', 'Candidate')
@section('page', 'Candidates Table')
@section('content')

    @if(auth()->user()->hasRole('employee'))

        <div class="mb-3 align-right">
        <a  href="{{ route('candidate.create') }}" class=" spa_rout btn btn-primary"><i class="bi bi-database-add me-1"></i>Add candidate</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @endif
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-2 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">New</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->new_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->new_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-2 col-md-6">
                        <div class="card info-card sales-card">


                            <div class="card-body">
                                <h5 class="card-title">Working</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->working_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->working_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <div class="col-xxl-2 col-md-6">
                        <div class="card info-card sales-card">


                            <div class="card-body">
                                <h5 class="card-title">Archive</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->archive_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->archive_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-2 col-md-6">
                        <div class="card info-card sales-card">


                            <div class="card-body">
                                <h5 class="card-title">Interview</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->interview_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->interview_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->


                    <div class="col-xxl-2 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">

                            <h5 class="card-title">Hired</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->hired_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->hired_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->
                </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users Tables</h5>
                        <form action="{{ route('candidate.index') }}" method="GET">
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
                                @if(auth()->user()->hasRole('employee'))
                                <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_string($filterCandidates))
                            @foreach($filterCandidates as $candidate)
                            <tr>
                                <td>{{$candidate->id}}</td>
                                <td>{{$candidate->full_name}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>{{$candidate->language->name}}</td>
                                <td>{{$candidate->app->name}}</td>
                                <td>{{$candidate->created_at}}</td>
                                <td> <a href="{{route('candidate.show',['candidate' => $candidate->id])}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></td>
                                <td>
                                    @if($candidate->status === 'new' && auth()->user()->hasRole('employee'))
                                        <a href="{{ route('candidate.changeState', $candidate->id) }}" class="btn btn-sm btn-primary">
                                            Assign to Me
                                        </a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>{{$filterCandidates}}</td>
                                </tr>
                            @endif



                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

@endsection
