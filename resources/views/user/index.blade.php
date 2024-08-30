@extends('panel.layouts.app')

@section('content')



<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Users Tables</h5>
@dd($users)
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    <b>N</b>ame
                  </th>
                  <th>Ext.</th>
                  <th>City</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                  <th>Completion</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Unity Pugh</td>
                  <td>9958</td>
                  <td>Curicó</td>
                  <td>2005/02/11</td>
                  <td>37%</td>
                </tr>

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
