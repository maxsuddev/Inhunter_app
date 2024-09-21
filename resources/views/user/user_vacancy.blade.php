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
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Vacancies Table</h5>

                        <form action="{{ route('user.vacancy', $user->id) }}" method="GET">
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
                                    <td>{{ $vacancy->state }}</td>
                                    @if(!$vacancy->candidate === null)
                                    <td>{{ $vacancy->candidate->id }}</td>
                                    @endif
                                    <td>{{ \Carbon\Carbon::parse($vacancy->opened_at)->format('d M, H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeStateModal{{ $vacancy->id }}">
                                            Change state
                                        </button>

                                        <!-- State Change Modal -->
                                        <div class="modal fade" id="changeStateModal{{ $vacancy->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Change state</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('vacancy.updateStatus', $user->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
                                                            <div class="mb-3">
                                                                <div class="justify-content-between" role="group">
                                                                    <button type="submit" name="state" value="open_vacancy" class="btn btn-primary">
                                                                        Open
                                                                    </button>
                                                                    <button type="submit" name="state" value="working_vacancy" class="btn btn-success">
                                                                        Working
                                                                    </button>
                                                                    <button type="submit" name="state" value="close_vacancy" class="btn btn-secondary">
                                                                        Closed
                                                                    </button>
                                                                    <button type="submit" name="state" value="cancel_vacancy" class="btn btn-danger">
                                                                        Cancelled
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </section>

    <!-- Archived Candidate Modal -->
    @if(session('archivedCandidates'))
        <div class="modal fade" id="assignCandidateModal" tabindex="-1" aria-labelledby="assignCandidateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignCandidateLabel">Assign Archived Candidate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('vacancy.assignCandidate', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}">
                                <label for="candidate_id" class="form-label">Select Archived Candidate</label>
                                <select class="form-select" id="candidate_id" name="candidate_id" required>
                                    @foreach(session('archivedCandidates') as $candidate)
                                        <option value="{{ $candidate->id }}">{{  $candidate->id .' - '.' '.$candidate->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign Candidate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trigger the candidate assignment modal on close_vacancy state -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let candidateModal = new bootstrap.Modal(document.getElementById('assignCandidateModal'));
                candidateModal.show();
            });
        </script>
    @endif
@endsection
