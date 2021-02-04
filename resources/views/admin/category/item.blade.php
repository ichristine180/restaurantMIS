@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Dashboard')])

@section ( 'title', 'Item')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    @endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-8" style="margin-right:auto;margin-left:auto;">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Items List in {{  $category->name }} Category</h4>
                        </div>
                        <div class="col-12 text-right">
                  <a href="{{ route('showIform',$category->id) }}" class="btn btn-sm btn-success">Add New</a>
                </div>
                            <div class="card-content table-responsive">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-dark">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Price[rwf]
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Updated At
                                    </th>
                                    </thead>

                                    @foreach( $items as $key=>$item )
                                        <tr>
                                            <td> {{$key +1 }}</td>
                                            <td> {{  $item->name }}</td>
                                            <td> <img class="img-thumbnail img-responsive"
                                                      src="{{asset('uploads/item/'.$item->image)}}" style="height: 50px; width:70px" alt=""></td>
                                            <td> {{  $item->price }}</td>
                                            <td> {{  $item->description }}</td>
                                            <td> {{ $item->updated_at }}</td>
                                        </tr>
                                        @endforeach
                                </table>
                            </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>


    @endpush
