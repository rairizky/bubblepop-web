<div class="side-header show">
    <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
    <!-- Side Header Inner Start -->
    <div class="side-header-inner custom-scroll">

        <nav class="side-header-menu" id="side-header-menu">
            <ul>
                <li class="{{ Route::is('panel.dashboard.index')? 'active' : '' }}">
                    <a href="{{ route('panel.dashboard.index') }}">
                        <i class="ti-home"></i> <span>Dashboard</span>
                    </a>
                </li>

                @can('isSuperadmin')
                <li class="has-sub-menu {{ request()->is('v1/panel/users*')? 'active' : '' }}">
                    <a href="#">
                        <i class="ti-user"></i> <span>Users</span>
                    </a>
                    <ul class="side-header-sub-menu">
                        <li class="{{ Route::is('panel.users.index')? 'active' : '' }}">
                            <a href="{{ route('panel.users.index') }}">
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="{{ Route::is('panel.users.add')? 'active' : '' }}">
                            <a href="{{ route('panel.users.add') }}">
                                <span>Add Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('isAdmin')
                <li class="has-sub-menu">
                    <a href="#">
                        <i class="ti-heart"></i> <span>Product</span>
                    </a>
                    <ul class="side-header-sub-menu">
                        <li>
                            <a href="#">
                                <span>Manage Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Add Product</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('isCashier')
                <li class="has-sub-menu">
                    <a href="#">
                        <i class="ti-shopping-cart"></i> <span>Transaction</span>
                    </a>
                    <ul class="side-header-sub-menu">
                        <li>
                            <a href="#">
                                <i class="ti-shopping-cart"></i> <span>Create Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-qrcode"></i> <span>Scan Transaction</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>

    </div><!-- Side Header Inner End -->
</div>