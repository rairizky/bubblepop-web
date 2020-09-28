<div class="header-section">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">

            <!-- Header Logo (Header Left) Start -->
            <div class="header-logo col-auto">
                <h3>BUBBLE POP</h3>
            </div><!-- Header Logo (Header Left) End -->

            <!-- Header Right Start -->
            <div class="header-right flex-grow-1 col-auto">
                <div class="row justify-content-between align-items-center">

                    <!-- Side Header Toggle & Search Start -->
                    <div class="col-auto">
                        <div class="row align-items-center">

                            <!--Side Header Toggle-->
                            <div class="col-auto"><button class="side-header-toggle"><i class="zmdi zmdi-menu"></i></button></div>

                        </div>
                    </div><!-- Side Header Toggle & Search End -->

                    <!-- Header Notifications Area Start -->
                    @php
                        $profile = \App\Models\User::find(auth()->user()->id)->profile;
                    @endphp
                    <div class="col-auto">

                        <ul class="header-notification-area">

                            <!--User-->
                            <li class="adomx-dropdown col-auto">
                                <a class="toggle" href="#">
                                    <span class="user">
                                        <span class="avatar">
                                        @if ($profile != null)
                                            <img src="{{ asset("uploads/profile/{$profile->user_id}/".$profile->image) }}" class="" alt="">
                                        @endif
                                        <span class="status"></span>
                                    </span>
                                </a>

                                <!-- Dropdown -->
                                <div class="adomx-dropdown-menu dropdown-menu-user">
                                    <div class="head">
                                        <h5 class="name">{{ Auth::user()->name }}</h5>
                                        <a class="mail" href="#">{{ Auth::user()->email }}</a>
                                    </div>
                                    <div class="body">
                                        <ul>
                                            <li>
                                                <a href="{{ route('profile.index') }}">
                                                    <i class="zmdi zmdi-account"></i>Profile
                                                </a>
                                            </li>
                                        </ul>
                                        <ul>
                                          <li>
                                              <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="zmdi zmdi-block"></i>Logout
                                                    </a>
                                                </form>
                                          </li>
                                        </ul>
                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div><!-- Header Notifications Area End -->

                </div>
            </div><!-- Header Right End -->

        </div>
    </div>
</div>