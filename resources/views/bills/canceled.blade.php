@extends('layouts.app', ['activePage' => 'orders', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">    

    <div class="container" style="margin-top: 10px;margin-bottom: 100px; ">
    <div class="row justify-content-center">
        <div class="col-md-10">
      
            <div class="card">
            <div class="row">
            <a href="{{ route('bills') }}" class="btn btn-sm btn-success" style="margin-left:20px;"> Back To Dashboard</a>
            <a href="{{ route('printCanceled') }}" class="btn btn-sm btn-danger" target="_blank" style="margin-left:20px;">
            <i class="material-icons">local_printshop</i>Print</a>
            </div>
            </div>
                <div class="card-header bg-info text-white" style="margin-bottom: 10px; ">Canceled Bills LIST

                </div>
                <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>BillNumber</th>
                <th>Ammount [rwf]</th>
                <th>status</th>
                <th>Reason</th>
                <th>Canceled By</th>
                <th>Canceled At</th>
                
             
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
        ajax: "{{ route('canceledList') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'billNumber', name: 'bill.billNumber'},
            {data: 'ammount', name: 'bill.order.ammount'},
            {data: 'status', name: 'bill.status'},
            {data: 'reason', name: 'reason'},
            {data: 'name', name: 'user.name'},
            {data: 'created_at', name: 'created_at'},
           
           
           
           
        ]
    });
    
  });
</script>
@endpush