@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Dashboard')])

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
                            <h4 class="card-title ">Edit Item</h4>
                        </div>
                        <div class="card-content ">

                            <form action="{{ route('editItem',$item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">content_paste</i>
                  </span>
                </div>
                                            <input type="text" class="form-control" name="name" value="{{$item->name}}">
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
                                            <input type="number" class="form-control" name="price" value="{{$item->price}}">
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
                                            <textarea name="description" class="form-control" > {{$item->description}}</textarea>
                                        </div>
                                        @if ($errors->has('description'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('description') }}</strong>
                </div>
              @endif
</div>
                                    </div>
                                </div>

                                <input type="hidden" name="category" value="{{$item->category->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                    <img class="img-thumbnail img-responsive"
                                                      src="{{asset('uploads/item/'.$item->image)}}" style="height: 50px; width:70px" alt="">
                                        <input type="file" name="image">
                                        
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                <a  class="btn btn-default" href="{{ route('items') }}" style="float:left; margin-left:30px;">{{ __('cancel') }}</a>
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
