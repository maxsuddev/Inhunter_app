@extends('panel.layouts.app')
@section('title', 'Vacancy')
@section('page', 'Vacancies Table')
@section('content')



<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Users Tables</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    ID
                  </th>
                  <th>Name</th>
                    <th>User Name</th>
                  <th>Company Name</th>
                    <th>Category </th>
                    <th>Candidate </th>
                    <th>State</th>


                  <th data-type="date" data-format="YYYY/DD/MM">Created</th>
                </tr>
              </thead>
              <tbody>
              @foreach($vacancies as $vacancy)

                <tr>
                  <td>{{$vacancy->id}}</td>
                  <td>{{$vacancy->name}}</td>
                  <td>{{$vacancy->user->name}}</td>
                  <td>{{$vacancy->company->name}}</td>
                    <td>{{$vacancy->category->name}}</td>
                    <td>{{$vacancy->candidate->full_name}}</td>
                    <td>{{$vacancy->state}}</td>

                    <td>{{$vacancy->created_at}}</td>


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
