@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Dashboard')])

@section ( 'title', 'Category')

@push('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    @endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin-right:auto;margin-left:auto;">
                    @include('layouts.msg')

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">All Categories</h4>
                        </div>
                        <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('createcategory') }}" class="btn btn-sm btn-success">Add New</a>
                </div>
              </div>
                            <div class="card-content table-responsive">
                                <table id="table" class="table" cellspacing="0" width="100%">
                                    <thead class=" text-dark">
                                    <th>
                                       #
                                    </th>
                                    <th>
                                        Name of Category
                                    </th>
                                    <th>
                                        Added At
                                    </th>
                                    <th>
                                       Number Of Items
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    </thead>

                                    @foreach( $categories as $key=>$category )
                                        <tr>
                                            <td> {{$key +1 }}</td>
                                            <td> {{  $category->name }}</td>
                                            <td> {{ $category->updated_at->format('d M Y')}}</td>
                                            <td>{{$category->getNumberOfItem($category->items)}}</td>
                                            <td>
                                                <a href="{{ route('showform',$category->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                                                <form id="delete-form-{{ $category->id }}" action="{{ route('destroy',$category->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $category->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                                        <a href="{{ route('viewItem',$category->id) }}" class="btn btn-success btn-sm"><i class="material-icons md-48">visibility</i></a>
                                            </td>


                                        </tr>
                                        @endforeach
                                </table>
                                {!! $categories->links() !!}
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
