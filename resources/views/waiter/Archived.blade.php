@extends('layouts.app', ['activePage' => 'orders', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">    

    <div class="container" style="margin-top: 10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-10">
      
            <div class="card">
            <div class="row">
            <a href="{{ route('waiterHome') }}" class="btn btn-sm btn-success" style="margin-left:20px;"> Back To Dashboard</a>
            </div>
                <div class="card-header bg-info text-white" style="margin-bottom: 10px; ">YOUR PAID ORDERS LIST

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
        ajax: "{{ route('orders.archivedList') }}",
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