@extends('panel.layouts.app')
@section('title', 'User Vacancy')
@section('page', 'Vacancies Table')
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
    <section class="section">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Your Vacancies Tables</h5>

                            <form action="{{ route('user.vacancy' , $user->id) }}" method="GET">
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
                                    @if($vacancies->contains('state', 'working_vacancy'))
                                        <th>User Name</th>
                                    @elseif($vacancies->contains('state', 'close_vacancy'))
                                        <th>Candidate</th>
                                    @endif
                                    <th>State</th>
                                    <th>Opened</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vacancies as $vacancy)
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
                                        <td>   <!-- Vertically centered Modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                                                Change state
                                            </button>
                                        </td>
                                        <div class="modal fade" id="verticalycentered" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Change state</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form action="{{ route('user.vacancy' , $user->id) }}" method="GET">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Vertically centered Modal-->

                                        <!-- Action column -->

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
