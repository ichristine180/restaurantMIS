<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-info navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#"> {{$role}} dashboard </a>
    </div>
  
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile') }}" style="background-color: white; color:black;">{{ __('Profile') }}</a>
            <a class="dropdown-item" href="{{ route('changePassword') }}" style="background-color: white; color:black;">{{ __('change password') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
            style="background-color: white; color:black;">
                                        {{ __('Logout') }}
                                    </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
