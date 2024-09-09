
@extends('panel.layouts.app')
@section('title', 'Category')
@section('page', 'Category Table')
@section('content')

<div class="mb-3 align-right">
    <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="bi bi-database-add me-1"></i>Add category</a>
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
            <form method="GET" action="{{ route('category.index') }}">
              <div class="mb-3">
                  <label for="stateFilter" class="form-label">Filter by State</label>
                  <select id="stateFilter" name="status" class="form-select" onchange="this.form.submit()">
                      <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    
                  </select>
              </div>
          </form>

            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    ID
                  </th>
                  <th>Name</th>
                  <th>Status</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Created User</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($filtrCategory as $category)

                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->is_active}}</td>
                  <td>{{$category->created_at}}</td>
                  <td> <a href="{{route('category.show',['category' => $category->id])}}"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></td>

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
