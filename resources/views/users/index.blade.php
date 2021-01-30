@extends('layouts.app', ['activePage' => 'Employees', 'titlePage' => __('Dashboard')])

@section('content')

    <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title" >Employees</h4>
              <p class="card-category"> Here you can manage Employees</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('register') }}" class="btn btn-sm btn-success">Add user</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-dark">
                    <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                     userName
                    </th>
                    <th>
                      Registration date
                    </th>
                    <th>
                      role
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  @foreach($users as $user)
                  <tbody>
                                            <tr>
                                            <td>
                         {{++$i}}
                        </td>
                                            <td>
                         {{$user->name}}
                        </td>
                        <td>
                          {{$user->email}}
                        </td>
                        <td>
                          {{$user->username}}
                        </td>
                        <td>
                          {{$user->created_at}}
                        </td>
                        <td>
                        {{$user->userRole($user->role)}}</td>

                        <td class="td-actions text-right">
                        @if( $user->userRole(Auth::User()->role) == 'Managing Director')
                       
                                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('update',$user->id) }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            @if($user->username!=Auth::User()->username)
                            <a rel="tooltip" class="btn btn-danger btn-link" href="#" data-original-title="" title="">
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                            @endif
                            @if($user->userRole(Auth::User()->role) == 'Manager')
                            @if($user->userRole($user->role) !='Managing Director')
                       <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
<i class="material-icons">edit</i>
<div class="ripple-container"></div>
</a>
<a rel="tooltip" class="btn btn-danger btn-link" href="#" data-original-title="" title="">
<i class="material-icons">delete</i>
<div class="ripple-container"></div>
</a>
@endif
@endif 
                                                    </td>
                      </tr>
                                        </tbody>
                                        @endforeach
                </table>
                {!! $users->links() !!}
              </div>
            </div>
          </div>
          </div>
            </div>
          </div>
          </div>
            </div>
          @endsection

