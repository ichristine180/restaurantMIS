@extends('layouts.app', ['activePage' => 'tables', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
<div class="row">
        <div class="col-lg-6 col-md-12" style="margin-left:auto;margin-right:auto;">
        <div class="col-12 text-right">
        <form action="{{ route('createTables') }}" method="post">
        @csrf
                  <button type="submit" class="btn btn-sm btn-success">Create Table</button>
                  </form>
                </div>
                @include('layouts.msg')
          <div class="card">
          
            <div class="card-header card-header-tabs card-header-info">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">
                 List of tables, you can add new or remove table
                  </span>
                  
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table" id="myTable">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                             #
                            </label>
                          </div>
                        </td>
                        <td>Table Number</td>
                        <td class="td-actions text-right"> 
                          <button type="button" rel="tooltip"  class="btn btn-danger btn-link btn-sm">
                            Remove Table
                          </button>
                        </td>
                      </tr>
                      @foreach($table as $tables)
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                             {{++$i}}
                            </label>
                          </div>
                        </td>
                        <td>{{$tables->code}}</td>
                        <td class="td-actions text-right"> 
                        <form id="delete-form-{{ $tables->id }}" action="{{ route('destroyTables',$tables->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                        <button type="button" title="Remove" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $tables->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }">
                      
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                        @endforeach
                    
                    </tbody>
                  
                  </table>
                  {{ $table->render() }}
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
  </div>
@endsection

@push('js')
  <script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>
@endpush