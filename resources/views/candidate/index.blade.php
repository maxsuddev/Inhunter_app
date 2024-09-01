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
                                <th>Full Name.</th>
                                <th>Gender</th>
                                <th>Language</th>
                                <th>App</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                <th>Show</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_string($candidates))
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{$candidate->id}}</td>
                                <td>{{$candidate->full_name}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>{{$candidate->language->name}}</td>
                                <td>{{$candidate->app->name}}</td>
                                <td>{{$candidate->created_at}}</td>
                                <td><a href="{{route('candidate.show',['candidate' => $candidate->id])}}">Show</a> </td>
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
