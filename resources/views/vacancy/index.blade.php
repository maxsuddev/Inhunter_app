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
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Vacancies Tables</h5>

            <form method="GET" action="{{ route('vacancy.index') }}">
              <div class="mb-3">
                  <label for="stateFilter" class="form-label">Filter by State</label>
                  <select id="stateFilter" name="state" class="form-select" onchange="this.form.submit()">
                      <option value="open_vacancy" {{ request('state') == 'open_vacancy' ? 'selected' : '' }}>Open</option>
                      <option value="working_vacancy" {{ request('state') == 'working_vacancy' ? 'selected' : '' }}>Working</option>
                      <option value="close_vacancy" {{ request('state') == 'close_vacancy' ? 'selected' : '' }}>Closed</option>
                      <option value="cancel_vacancy" {{ request('state') == 'cancel_vacancy' ? 'selected' : '' }}>Cancelled</option>
                  </select>
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
                      <th data-type="date" data-format="YYYY/DD/MM">Opened</th>
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
                              <td>{{ $vacancy->user->name  }}</td>
                          @elseif($vacancy->state === 'close_vacancy')
                              <td>{{ $vacancy->candidate->full_name  }}</td>
                          @endif

                          <td>{{ $vacancy->state }}</td>
                          <td>{{ \Carbon\Carbon::parse($vacancy->opened_at)->format('d M, H:i') }}</td> <!-- Masalan: 12 Sep, 2024 14:30 -->
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
