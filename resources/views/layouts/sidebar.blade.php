<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ auth()->user()->avatar }}" alt="">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ auth()->user()->full_name }}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                               href="#" data-toggle="dropdown" aria-expanded="false">
                                <small class="designation text-muted">{{ \Illuminate\Support\Str::upper(auth()->user()->role) }}</small>
                                <span class="status-indicator online"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                                <a class="dropdown-item mt-2" href="{{ route('admin.users.show',auth()->user()->id) }}"> Manage Accounts </a>
                                <a href="{{ url('/logout') }}" class="dropdown-item"> Sign Out </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="btn btn-success btn-block">
                    <i class="mdi mdi-home"></i> Home
                </a>
            </div>
        </li>
        <li class="nav-item {{ active_class(['admin/*']) }}">
            <a class="nav-link" href="{{ url('admin') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/settings']) }}">
            <a class="nav-link" href="{{ route('admin.settings') }}">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">Sittings</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/slider']) }}">
            <a class="nav-link" href="{{ route('admin.slider.index') }}">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">Slider</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/filemanger']) }}">
            <a class="nav-link" href="{{ route('admin.lfm') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">File Manager</span>
            </a>
        </li>
        <li><hr></li>
        <li class="nav-item {{ active_class(['admin/users*','admin/users*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="false" aria-controls="user-pages">
                <i class="menu-icon mdi mdi-account-group"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="user-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.users.admins') }}">Admin</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.users.designers') }}">Designers</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.users.designersWait') }}">designers Wait list</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Normal Users</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.users.designerRequest') }}">Designers Request</a>
                    </li>


                </ul>
            </div>
        </li>

        <li><hr></li>
        <li class="nav-item {{ active_class(['admin/designs*']) }}">
            <a class="nav-link" href="{{ route('admin.designs.index') }}">
                <i class="menu-icon mdi mdi-account-group "></i>
                <span class="menu-title">Designs</span>
            </a>
        </li>
        <li><hr></li>
        <li class="nav-item {{ active_class(['admin/dsizes*']) }}">
            <a class="nav-link" href="{{ route('admin.dsizes.index') }}">
                <i class="menu-icon mdi mdi-format-font-size-increase "></i>
                <span class="menu-title">Dsizes</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/colors*']) }}">
            <a class="nav-link" href="{{ route('admin.colors.index') }}">
                <i class="menu-icon mdi mdi-invert-colors "></i>
                <span class="menu-title">colors</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/tsizes']) }}">
            <a class="nav-link" href="{{ route('admin.tsizes.index') }}">
                <i class="menu-icon mdi mdi-format-size "></i>
                <span class="menu-title">Tsizes</span>
            </a>
        </li>
        <li><hr></li>

        <li class="nav-item {{ active_class(['admin/tshirts']) }}">
            <a class="nav-link" href="{{ route('admin.tshirts.index') }}">
                <i class="menu-icon mdi mdi-tshirt-v "></i>
                <span class="menu-title">Tshirts</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/dcollections']) }}">
            <a class="nav-link" href="{{ route('admin.dcollections.index') }}">
                <i class="menu-icon mdi mdi-tshirt-v "></i>
                <span class="menu-title">Designs Collections</span>
            </a>
        </li>
        <li><hr></li>
        <li class="nav-item {{ active_class(['admin/orders*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#orders-pages" aria-expanded="false" aria-controls="user-pages">
                <i class="menu-icon mdi mdi-account-group"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="orders-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">All Orders</a>
                    </li>
                    @foreach(\App\OrderStatus::all() as $s)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.status.show',$s->id) }}">{{ \Illuminate\Support\Str::upper($s->status .' Orders') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['admin/orderstatus']) }}">
            <a class="nav-link" href="{{ route('admin.orderstatus.index') }}">
                <i class="menu-icon mdi mdi-state-machine "></i>
                <span class="menu-title">Order Statuses</span>
            </a>
        </li>
        <li><hr></li>

        <li class="nav-item {{ active_class(['admin/pages']) }}">
            <a class="nav-link" href="{{ route('admin.pages.index') }}">
                <i class="menu-icon mdi mdi-state-machine "></i>
                <span class="menu-title">Pages</span>
            </a>
        </li>

        <li>
            <hr>
        </li>
    </ul>
</nav>
