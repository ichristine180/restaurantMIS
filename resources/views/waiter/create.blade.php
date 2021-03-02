@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'orders', 'title' => __('Employees/register')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
  <div class="col-md-8" style="margin-right:auto;margin-left:auto; margin-top:100px;">
      <form class="form" method="POST" action="{{ route('orders.postOrders') }}">
        @csrf
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
            <h4 class="card-title"><strong>{{ __('Create Order') }}</strong></h4>
          </div>
          <div class="card-body ">
          <div class="bmd-form-group{{ $errors->has('item') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">filter_list</i>
                  </span>
                </div>
                <select class="form-control" name="item">
                    <option selected="selected" value="">Choose Item</option>
                    @foreach($items as $items)
                    <option value="{{$items->id}}">{{$items->name}}</option>
                    @endforeach
                  </select>
              </div>
              @if ($errors->has('item'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('item') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('table') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">filter_list</i>
                  </span>
                </div>
                <select class="form-control" name="table">
                    <option selected="selected" value="">Choose table</option>
                    @foreach($table as $table)
                    <option value="{{$table->id}}">{{$table->code}}</option>
                    @endforeach
                  </select>
              </div>
              @if ($errors->has('table'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('table') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('discount') ? ' has-danger' : '' }} mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">remove_circle</i>
                  </span>
                </div>
                <input type="number" name="discount" class="form-control" placeholder="{{ __('discount...') }}" value="{{ old('discount') }}">
              </div>
              @if ($errors->has('discount'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('discount') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('quantity') ? ' has-danger' : '' }} mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">add_circle</i>
                  </span>
                </div>
                <input type="number" name="quantity" class="form-control" placeholder="{{ __('quantity...') }}" value="{{ old('quantity') }}" required>
              </div>
              @if ($errors->has('quantity'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('quantity') }}</strong>
                </div>
              @endif
            </div>
            <div class="row">
                <a  class="btn btn-default" href="{{ route('waiterHome') }}" style="float:left; margin-left:30px;">{{ __('cancel') }}</a>
                <button type="submit" class="btn btn-info" style="float:right; margin-left:auto;margin-right:30px;">{{ __('Create') }}</button>
              </div>
          </div>
         
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
