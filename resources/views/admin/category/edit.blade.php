@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Dashboard')])

@section ( 'title', 'Category')

@push('css')


@endpush

@section('content')

<div class="container" style="height: auto;">
  <div class="row align-items-center">
  <div class="col-md-8" style="margin-right:auto;margin-left:auto; margin-top:100px;">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <button type="button" class="close" onclick="this.parentElement.style.display='none'; ">
                                    <i class="material-icons">close</i>
                                </button>
                                <span> {{ $error }}</span>
                            </div>
                        @endforeach

                    @endif
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Edit Category Name</h4>
                        </div>
                        <div class="card-content ">

                            <form action="{{ route('editcategory',$category->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">content_paste</i>
                  </span>
                </div>
        
             <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                        </div>
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
