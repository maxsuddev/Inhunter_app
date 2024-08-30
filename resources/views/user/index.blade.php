@extends('panel.layouts.app')

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
                  <th>name.</th>
                  <th>email</th>
                    <th>role</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Created User</th>
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
