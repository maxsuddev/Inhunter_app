@extends('panel.layouts.app')
@section('title', 'Candidate')
@section('page', 'Candidates Table')
@section('content')

    <div class="mb-3 align-right">
        <a href="{{ route('candidate.create') }}" class="btn btn-primary"><i class="bi bi-database-add me-1"></i>Add candidate</a>
    </div>
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
                        <h5 class="card-title">Users Tables</h5>
                        <form method="GET" action="{{ route('candidate.index') }}">
                            <div class="mb-3">
                                <label for="stateFilter" class="form-label">Filter by State</label>
                                <select id="stateFilter" name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                                    <option value="archive" {{ request('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                    <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Done</option>
                                </select>
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
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_string($filtrCandidates))
                            @foreach($filtrCandidates as $candidate)
                            <tr>
                                <td>{{$candidate->id}}</td>
                                <td>{{$candidate->full_name}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>{{$candidate->language->name}}</td>
                                <td>{{$candidate->app->name}}</td>
                                <td>{{$candidate->created_at}}</td>
                                <td> <a href="{{route('candidate.show',['candidate' => $candidate->id])}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></td>
                            </tr>
                            @endforeach  @else
                                <tr>
                                    <td>{{$candidates}}</td>
                                </tr>
                            @endif



                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
