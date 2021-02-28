@extends('layouts.app', ['activePage' => 'orders', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">    

    <div class="container" style="margin-top: 10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">orders List <span style="margin-left:350px;">{{ date('Y-m-d') }}</span></div>

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Item Price [rwf]</th>
                <th>item DisCount[rwf]</th>
                <th>status</th>
                <th>Table Number</th>
             
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {
    $i=0;
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'name', name: 'item.name'},
            {data: 'price', name: 'item.price'},
            {data: 'discount', name: 'discount'},
            {data: 'status', name: 'status'},
            {data: 'code', name: 'tables.code'}
           
           
           
        ]
    });
    
  });
</script>
@endpush