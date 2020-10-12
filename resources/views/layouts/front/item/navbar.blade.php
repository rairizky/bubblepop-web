<header id="header" class="header clearfix">
    <div class="header-wrap clearfix">
        <div class="container">
        <div class="logo-mobi"><a href="{{ route('bubblepop.index') }}"> <img src="{{ asset('/images/logo/logo_bubblepop.png') }}" width="130" alt="Logo"></a></div>
        <div class="btn-menu">
            <span></span>
        </div>
            <nav id="mainnav" class="mainnav">
                <ul class="menu">
                    <li> <a href="{{ route('bubblepop.index') }}">Home</a></li>
                    <li> <a href="{{ route('bubblepop.menu') }}">Menu</a></li>
                    <li class="logo">
                        <a href="{{ route('bubblepop.index') }}"> <img src="{{ asset('/images/logo/logo_bubblepop.png') }}" width="130" alt="Logo"></a>
                    </li>
                    <li> <a href="{{ route('bubblepop.about') }}">About</a></li>
                    <li> <a href="{{ route('bubblepop.contact') }}">Contact</a></li>
                </ul><!--/.menu -->                                      
            </nav><!--/.mainnav -->
        </div><!--/.container -->
    </div><!--/.header-wrap -->
</header><!--/.header -->  