@extends('layouts.app', ['activePage' => 'orders', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">    

    <div class="container" style="margin-top: 10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-10">
      
            <div class="card">
            <div class="row">
            <a href="{{ route('bills') }}" class="btn btn-sm btn-success" style="margin-left:20px;"> Back To Dashboard</a>
            </div>
                <div class="card-header bg-info text-white" style="margin-bottom: 10px; ">Non PAID Bills LIST

                </div>
                <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>BillNumber</th>
                <th>Ammount [rwf]</th>
                <th>status</th>
                <th>Created By</th>
                <th>created At</th>
                <th>Action</th>
                
             
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
        ajax: "{{ route('bills.nonPayedList') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'billNumber', name: 'billNumber'},
            {data: 'ammount', name: 'order.ammount'},
            {data: 'status', name: 'status'},
            {data: 'name', name: 'user.name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'}
           
           
           
           
        ]
    });
    
  });
</script>
@endpush