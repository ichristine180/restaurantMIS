@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Restaurant Management System')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <!-- <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
      <h3>{{ __('Log in to see how you can speed up your web development with out of the box CRUD for #User Management and more.') }} </h3>
    </div> -->
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
    @if (session('status_login'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_login') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
      <form class="form" method="POST" action="{{ route('postLogin') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-info text-center">
            <h4 class="card-title" style="color:black;"><strong>{{ __('Restaurant Management System') }}</strong></h4>
          </div>
          <div class="card-body">
            <p class="card-description text-center">{{ __('Sign in to  ') }} <strong>To access your </strong> {{ __(' account ') }}</p>
            <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="{{ __('username...') }}" value="{{ old('username') }}" required>
              </div>
              @if ($errors->has('username'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('username') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}"  required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
          </div>
          <div class="card-footer justify-content-center">
          <div class="row">
        <div class="col-6">
        @if (Route::has('password.request'))
                <a href="#" class="btn btn-info btn-link btn-lg">
                    <small style="color:black;">{{ __('Forgot password?') }}</small>
                </a>
            @endif
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-info btn-link btn-lg" style="color:black;">{{ __('Login') }}</button>
          </div>
          </div>
          </div>
        </div>
      </form>
     
    </div>
  </div>
</div>
@endsection
