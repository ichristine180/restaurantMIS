@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Dashboard')])

@section ( 'title', 'Slider')

@push('css')


@endpush

@section('content')

<div class="container" style="height: auto;">
  <div class="row align-items-center">
  <div class="col-md-8" style="margin-right:auto;margin-left:auto; margin-top:100px;">

                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Add New Category</h4>
                        </div>
                        <div class="card-content ">

                            <form action="{{ route('categorystore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">content_paste</i>
                  </span>
                </div>
        
                <input type="text" class="form-control" name="name" placeholder="{{ __('Name...') }}" value="{{ old('name') }}" required>
                                        </div>
                                        @if ($errors->has('name'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
              @endif
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                <a  class="btn btn-default" href="{{ route('category') }}" style="float:left; margin-left:30px;">{{ __('cancel') }}</a>
                <button type="submit" class="btn btn-info" style="float:right; margin-left:auto;margin-right:30px;">{{ __('Save') }}</button>
              </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')



@endpush
