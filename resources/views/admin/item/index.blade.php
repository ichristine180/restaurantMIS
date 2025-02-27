@extends('layouts.app', ['activePage' => 'item', 'titlePage' => __('Dashboard')])

@section ( 'title', 'Item')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    @endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.msg')

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">All Items</h4>
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
                                        Category
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
                                    <th>
                                        Action
                                    </th>
                                    </thead>

                                    @foreach( $items as $key=>$item )
                                        <tr>
                                            <td> {{$key +1 }}</td>
                                            <td> {{  $item->name }}</td>
                                            <td> <img class="img-thumbnail img-responsive"
                                                      src="{{asset('uploads/item/'.$item->image)}}" style="height: 50px; width:70px" alt=""></td>
                                            <td> {{  $item->category->name }}</td>
                                            <td> {{  $item->price }}</td>
                                            <td> {{  $item->description }}</td>
                                            <td> {{ $item->updated_at }}</td>

                                            <td>
                                                <a href="{{ route('ShowIUform',$item->id) }}" class="btn btn-info btn-sm" title="Edit item"><i class="material-icons">mode_edit</i></a>

                                                <form id="delete-form-{{ $item->id }}" action="{{ route('delete',$item->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" title="Delete Item" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $item->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>


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
