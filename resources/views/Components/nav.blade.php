<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/sris_logo.jpg') }}" alt="Logo" /></a>
        {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a> --}}
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="mdi mdi-home"></i>Home
                </a>
            </li>
            {{-- <li class="nav-item d-none d-lg-block full-screen-link">
          <a class="nav-link">
            <i class="mdi mdi-file-document"></i>Docs
          </a>
        </li> --}}
            {{-- <li class="nav-item d-none d-lg-block full-screen-link">
          <a class="nav-link">
            <i class="mdi mdi-fullscreen"></i>Demo
          </a>
        </li> --}}
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i style="margin-right: 5px;" class="mdi mdi-calendar-clock"></i> {{ date('Y-m-d') }}
                </a>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-text">
                        <img src="https://i0.wp.com/ui-avatars.com/api/{{ optional(optional(request())->user())->name }}?ssl=1"
                            style="border-radius: 20px; height:40px; width:40px;" />
                        {{-- <i class="mdi mdi-account"></i>{{ auth()->user()->name }} --}}
                    </div>
                </a>
                <div class="dropdown-menu pull-right navbar-dropdown" data-offset="100"
                    aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('users.passwordChangeIndex') }}">Change Password</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
