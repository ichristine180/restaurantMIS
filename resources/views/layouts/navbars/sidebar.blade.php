<div class="sidebar" data-color="azure" data-background-color="azure" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Restaurant MIS') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @if($role === 'Managing Director' || $role === 'Manager' )
      <li class="nav-item{{ $activePage == '' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">free_breakfast</i>
            <p>{{ __('Products Management') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Employees' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('employees') }}">
          <i class="material-icons">explicit</i>
            <p>{{ __('Employees Management') }}</p>
        </a>
      </li>
      @endif
    </ul>
  </div>
</div>
