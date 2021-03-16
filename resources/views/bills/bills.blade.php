@extends('layouts.app', ['activePage' => 'Bills', 'titlePage' => __('bills')])

@section('content')
  <div class="content">
  <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Payed Bills</p>
              <h3 class="card-title">{{$payedBills}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
                <a href="#">details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Non Payed </p>
              <h3 class="card-title">{{$nonPayedBills}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
              <a href="{{ route('bills.nonPayed') }}">details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Archived </p>
              <h3 class="card-title">{{$archivedBills}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
              <a href="{{ route('bills.archived') }}">details</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">All Bills</p>
              <h3 class="card-title">{{$allBills}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
                <a href="{{ route('bills.billsList') }}">details</a>
              </div>
            </div>
          </div>
        </div>
      
     
    <div class="container" style="margin-top: -10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.msg')
            <div class="card">
            
                <div class="card-header bg-info text-white" style="margin-bottom: 10px; "> PAID BILLS LIST

                </div>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>BillNumber</th>
                <th>Ammount [rwf]</th>
                <th>status</th>
                <th>Done By</th>
                <th>Paid At</th>
                
             
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@push('js')

<script type="text/javascript">
  $(function () {
    $i=0;
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('bills.payed') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'billNumber', name: 'billNumber'},
            {data: 'ammount', name: 'order.ammount'},
            {data: 'status', name: 'status'},
            {data: 'name', name: 'user.name'},
            {data: 'updated_at', name: 'updated_at'},
           
           
           
           
        ]
    });
    
  });
</script>
@endpush 