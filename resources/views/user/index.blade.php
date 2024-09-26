@extends('panel.layouts.app')
@section('title', 'User')
@section('page', 'Users Table')
@section('content')
    @if(auth()->user()->hasRole('manager'))

    <div class="mb-3 align-right">
        <a href="{{ route('user.create') }}" class=" spa_rout btn btn-primary"><i class="bi bi-database-add me-1"></i>Add user</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                  <th>name.</th>
                  <th>email</th>
                    <th>role</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Created User</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)

                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>userRole</td>
                  <td>{{$user->created_at}}</td>
                    <td>
                        @if(auth()->check() && auth()->user()->id === $user->id)
                            <a class="spa_rout" href="{{ route('user.show', ['user' => $user->id]) }}">
                                <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
                            </a>
                        @endif

                            @if(auth()->check() && auth()->user()->id === $user->id && auth()->user()->hasRole('employee'))
                                <a class="spa_rout" href="{{ route('user.vacancy', ['user' => $user->id]) }}">
                                    <span class="badge rounded-pill bg-success p-2 ms-2">Desktop</span>
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
  </section>
@endsection
