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
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
        <i class="material-icons">view_list</i>
          <p>{{ __(' Products Management') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse hide" id="laravelExample">
          <ul class="nav">
          <li class="nav-item {{ ($activePage == 'category') ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('category') }}">
          <i class="material-icons">free_breakfast</i>
            <p>{{ __('Categories') }}</p>
        </a>
        </li>
        <li class="nav-item {{ ($activePage == 'item') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('items') }}">
          <i class="material-icons">free_breakfast</i>
            <p>{{ __('Items') }}</p>
        </a>
        </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'Employees' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('employees') }}">
          <i class="material-icons">explicit</i>
            <p>{{ __('Employees Management') }}</p>
        </a>
      </li>
      @endif
      @if($role === 'Waiter')
      <li class="nav-item{{ $activePage == 'tables' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tables') }}">
          <i class="material-icons">table</i>
            <p>{{ __('Tables') }}</p>
        </a>
      </li>
      @endif
      @if($role === 'Waiter'||'Supervisor'||'Cashier')
      <li class="nav-item{{ $activePage == 'orders' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('orders') }}">
          <i class="material-icons">information</i>
            <p>{{ __('Orders') }}</p>
        </a>
      </li>
      @endif
      @if($isWaiter)
      <li class="nav-item{{ $activePage == '' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('waiterHome') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Waiter Dashboard') }}</p>
        </a>
      </li>
      @endif
    </ul>
  </div>
</div>
