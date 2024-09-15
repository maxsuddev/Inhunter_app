@extends('panel.layouts.app')
@section('title', 'Vacancy')
@section('page', 'Vacancies Table')
@section('content')
    <div class="mb-3 align-right">
        <a href="{{ route('vacancy.create') }}" class="btn btn-primary"><i class="bi bi-database-add me-1"></i>Add vacancies</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Opened</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">

                                        <h6>{{$stats->open_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->open_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
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

                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">


                            <div class="card-body">
                                <h5 class="card-title">Cancelled</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->cancelled_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->cancelled_percentage ?? ''}}%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">


                            <div class="card-body">
                                <h5 class="card-title">Closed</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$stats->closed_count ?? ''}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{ $stats->closed_percentage ?? ''}}%</span> <span
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
                        <h5 class="card-title">Vacancies Tables</h5>

                        <form action="{{ route('vacancy.index') }}" method="GET">
                            <div class="mb-3">
                                <label for="stateFilter" class="form-label">Filter by State</label>
                                <div class="justify-content-between" role="group">
                                    <button type="submit" name="state" value="open_vacancy" class="btn btn-primary {{ request('state') == 'open_vacancy' ? 'active' : '' }}">
                                        Open
                                    </button>
                                    <button type="submit" name="state" value="working_vacancy" class="btn btn-success {{ request('state') == 'working_vacancy' ? 'active' : '' }}">
                                        Working
                                    </button>
                                    <button type="submit" name="state" value="close_vacancy" class="btn btn-secondary {{ request('state') == 'close_vacancy' ? 'active' : '' }}">
                                        Closed
                                    </button>
                                    <button type="submit" name="state" value="cancel_vacancy" class="btn btn-danger {{ request('state') == 'cancel_vacancy' ? 'active' : '' }}">
                                        Cancelled
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Category</th>
                                @if($filterVacancies->contains('state', 'working_vacancy'))
                                    <th>User Name</th>
                                @elseif($filterVacancies->contains('state', 'close_vacancy'))
                                    <th>Candidate</th>
                                @endif
                                <th>State</th>
                                <th>Opened</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($filterVacancies as $vacancy)
                                <tr>
                                    <td>{{ $vacancy->id }}</td>
                                    <td>{{ $vacancy->name }}</td>
                                    <td>{{ $vacancy->company->name }}</td>
                                    <td>{{ $vacancy->category->name }}</td>

                                    @if($vacancy->state === 'working_vacancy')
                                        <td>{{ $vacancy->user->name }}</td>
                                    @elseif($vacancy->state === 'close_vacancy')
                                        <td>{{ $vacancy->candidate->full_name ?? '' }}</td>
                                    @endif

                                    <td>{{ $vacancy->state }}</td>
                                    <td>{{ \Carbon\Carbon::parse($vacancy->opened_at)->format('d M, H:i') }}</td>

                                    <!-- Action column -->
                                    <td>
                                        @if($vacancy->state === 'open_vacancy')
                                            <a href="{{ route('vacancy.changeState', $vacancy->id) }}" class="btn btn-sm btn-primary">
                                                Assign to Me
                                            </a>
    @endif

                                    </td>
                                </tr>
                            @endforeach
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
