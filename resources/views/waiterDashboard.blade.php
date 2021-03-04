@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
  <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Payed Orders</p>
              <h3 class="card-title">{{$payedOrders}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
                <a href="{{ route('orders.paid') }}">details</a>
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
              <h3 class="card-title">{{$nonPayedOrders}}</h3>
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
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Archived </p>
              <h3 class="card-title">{{$archivedOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
              <a href="{{ route('orders.archived') }}">details</a>
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
              <p class="card-category">All Orders</p>
              <h3 class="card-title">{{$allOrders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons">date_range</i>
                <a href="{{ route('orders') }}">details</a>
              </div>
            </div>
          </div>
        </div>
      
     
    <div class="container" style="margin-top: -10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.msg')
            <div class="card">
            <div class="row">
            <a href="{{ route('orders.create') }}" class="btn btn-sm btn-success" style="margin-left:15px;">Create Orders</a>
            </div>
                <div class="card-header bg-info text-white" style="margin-bottom: 10px; ">YOUR NON PAYED ORDERS LIST

                </div>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Price [rwf]</th>
                <th>DisCount[rwf]</th>
                <th>status</th>
                <th>Table</th>
                <th>Quantity</th>
                <th>Ammount</th>
                <th>Created At</th>
             
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
        ajax: "{{ route('orders.nonPayed') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'name', name: 'item.name'},
            {data: 'price', name: 'item.price'},
            {data: 'discount', name: 'discount'},
            {data: 'status', name: 'status'},
            {data: 'code', name: 'tables.code'},
            {data: 'quantity', name: 'quantity'},
            {data: 'ammount', name: 'ammount'},
            {data: 'created_at', name: 'created_at'}
           
           
           
        ]
    });
    
  });
</script>
@endpush