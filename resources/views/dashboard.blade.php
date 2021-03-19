@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Products</p>
              <h3 class="card-title">{{$product}}
                <small></small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="/items">details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Orders</p>
              <h3 class="card-title">{{$orders}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons text-danger">warning</i>
                <a href="/orders">details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">3p</i>
              </div>
              <p class="card-category">Employees</p>
              <h3 class="card-title">{{$users}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons text-danger">warning</i>
                <a href="/employees">details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">money</i>
              </div>
              <p class="card-category">Bills</p>
              <h3 class="card-title">{{$bills}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <i class="material-icons text-danger">warning</i>
                <a href="#">details</a>
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
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush