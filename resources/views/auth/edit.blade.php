@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'Employees', 'title' => __('Employees/register')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
  <div class="col-md-8" style="margin-right:auto;margin-left:auto; margin-top:100px;">
      <form class="form" method="POST" action="{{ route('putUpdate') }}">
        @csrf
        <input type="hidden" name="id"  value="{{$user->id}}">
        @if (session('error'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('error') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
        <div class="card card-login card-hidden mb-1">
          <div class="card-header card-header-info text-center">
            <h4 class="card-title"><strong>{{ __('UPdate Employees Information') }}</strong></h4>
          </div>
          <div class="card-body ">
            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="{{ __('Name...') }}" value="{{$user->name}}" required>
              </div>
              @if ($errors->has('name'))
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{$user->email}}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">people</i>
                  </span>
                </div>
                <input type="text" name="username" id="username" class="form-control" placeholder="{{ __('username...') }}" value="{{$user->username}}" required>
              </div>
              @if ($errors->has('username'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('username') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('role') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">people</i>
                  </span>
                </div>
                <select class="form-control" name="role">
                    @foreach($listofRoles as $listofRoles)
                    <option value="{{$listofRoles->id}}" {{ ($user->userRole($user->role) == $listofRoles->name ? "selected":"") }}>{{$listofRoles->name}}</option>
                  
                    @endforeach
                  </select>
              </div>
              @if ($errors->has('role'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('role') }}</strong>
                </div>
              @endif
            </div>
            <div class="row">
                <a  class="btn btn-default" href="{{ route('employees') }}" style="float:left; margin-left:30px;">{{ __('cancel') }}</a>
                <button type="submit" class="btn btn-info" style="float:right; margin-left:auto;margin-right:30px;">{{ __('Save') }}</button>
              </div>
          </div>
         
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
