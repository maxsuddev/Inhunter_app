@extends('panel.layouts.app')
@section('title', 'Companies')
@section('page', 'Companies Table')
@section('content')

    <div class="mb-3 align-right">
        <a href="{{ route('company.create') }}" class="btn btn-primary"><i class="bi bi-database-add me-1"></i>Add company</a>
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

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    ID
                  </th>
                  <th>Name</th>
                  <th>Owner Name</th>
                    <th>Phone</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($companies as $company)

                <tr>
                  <td>{{$company->id}}</td>
                  <td>{{$company->name}}</td>
                    <td>{{$company->owner_name}}</td>
                    <td>{{$company->phone_number}}</td>
                    <td>{{$company->created_at}}</td>
                    <td> <a href="{{route('company.show',['company' => $company->id])}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></td>

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
