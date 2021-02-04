@extends('layouts.app', ['activePage' => 'item', 'titlePage' => __('Dashboard')])
@section ( 'title', 'Item')

@push('css')


@endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-8" style="margin-right:auto;margin-left:auto;">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Add New Item in  {{  $category->name }} Category</h4>
                        </div>
                        <div class="card-content ">

                            <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <input type="hidden" name="category" value="{{$category->id}}">
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
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('price') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">money</i>
                  </span>
                </div>
                                            <input type="number" class="form-control" name="price" placeholder="Unit Price..." value="{{ old('price') }}" required>
                                        </div>
                                        @if ($errors->has('price'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('price') }}</strong>
                </div>
              @endif
                                    </div>
                                </div>
</div>
<div class="row">
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                   Description
                  </span>
                </div>
                                            <textarea name="description" class="form-control" placeholder="Describe item here..." value="{{ old('description') }}" required> </textarea>
                                        </div>
                                        @if ($errors->has('description'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('description') }}</strong>
                </div>
              @endif
                                    </div>
                                </div>
</div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('image') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons"> </i>
                  </span>
                </div>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        @if ($errors->has('image'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('image') }}</strong>
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
