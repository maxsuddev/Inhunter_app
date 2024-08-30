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
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Is_student</th>
                                <th>University Place</th>
                                <th>Marital State</th>
                                <th>Last Work</th>
                                <th>Positive Skills</th>
                                <th>Language</th>
                                <th>App</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($candidates as $candidate)
                            <tr>
                                <td>{{$candidate->id}}</td>
                                <td>{{$candidate->full_name}}</td>
                                <td>{{$candidate->phone_number}}</td>
                                <td>{{$candidate->address}}</td>
                                <td>{{$candidate->brithday}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>{{$candidate->is_student}}</td>
                                <td>{{$candidate->university_place}}</td>
                                <td>{{$candidate->marital_state}}</td>
                                <td>{{$candidate->last_work}}</td>
                                <td>{{$candidate->positive_skills}}</td>
                                <td>{{$candidate->language->name}}</td>
                                <td>{{$candidate->app->name}}</td>

                                <td>{{$candidate->created_at}}</td>






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
