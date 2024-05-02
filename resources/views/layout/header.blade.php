<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-primary pl-md-0 pr-0" id="navbar" data-primary>
            <div class="container-fluid pr-0 ">

                <!-- Navbar toggler -->
                <button class="navbar-toggler navbar-toggler-custom d-lg-none d-flex mr-navbar" type="button" data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>


                <div class="d-flex sidebar-account flex-shrink-0 mr-auto mr-lg-0">
                    <a href="{{ route('dashboard.index') }}" class="flex d-flex align-items-center text-underline-0">
                        <span class="mr-1  text-white">
                        </span>
                        <span class="flex d-flex flex-column text-white">
                            <strong class="sidebar-brand">Todak Food Ordering</strong>
                        </span>
                    </a>
                </div>

                @if (auth()->user())
                    <div class="dropdown">
                        <a href="#account_menu" class="dropdown-toggle navbar-toggler navbar-toggler-dashboard border-left d-flex align-items-center ml-navbar" data-toggle="dropdown">
                            
                            <img src="{{ asset('assets/images/avatar/blue.svg') }}" class="rounded-circle" width="32" alt="Frontted">
                            <span class="ml-1 d-flex-inline">
                                <span class="text-light">{{ auth()->user()->name }}</span>
                            </span>
                        </a>
                        <div id="company_menu" class="dropdown-menu dropdown-menu-right navbar-company-menu">
                            <div class="dropdown-item d-flex align-items-center py-2 navbar-company-info py-3">

                                <span class="mr-3">
                                    <img src="{{ asset('assets/images/frontted-logo-blue.svg') }}" width="43" height="43" alt="avatar">
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong class="h5 m-0">{{ ucfirst(auth()->user()->name) }}</strong>
                                    <small class="text-muted text-uppercase">{{ ucfirst(auth()->user()->role) }}</small>
                                    @if (auth()->user()->role == 'customer')
                                        <small class="text-muted">Total Points: {{ auth()->user()->loyalty_points->sum('points') }} Points</small>
                                    @endif
                                </span>

                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="material-icons mr-2">exit_to_app</span> Logout
                            </a>
                            @if (auth()->user()->role == 'restaurant_manager')
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('order.sales') }}">
                                    <i class="fas fa-dollar-sign mr-2"></i> Order Sales
                                </a>
                            @endif

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="navbar-toggler navbar-toggler-dashboard border-left d-flex align-items-center ml-navbar">
                        <span class="ml-1 d-flex-inline">
                            <span class="text-light">Admin Login <i class="fa fa-sign-in-alt"></i></span>
                        </span>
                    </a>
                @endif
            </div>
        </div>

    </div>
</div>