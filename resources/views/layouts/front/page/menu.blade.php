@extends('layouts.front.front')

@section('title', 'Menu')

@section('content')
{{-- hero --}}
<div class="page-title parallax parallax1 flat_strech">
    <div class="container">
        <div class="row">
            <div class="col-md-12">                    
                <div class="page-title-heading">
                    <h1 class="title">Our Menu</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li> <a href="{{ route('bubblepop.index') }}">Home </a></li>
                            <li><a href="#">Menu</a></li>
                        </ul>                   
                    </div>
                </div><!-- /.page-title-captions -->                        
            </div><!-- /.col-md-12 -->  
        </div><!-- /.row -->  
    </div><!-- /.container -->                      
</div>
{{-- end hero --}}

{{-- menu --}}
<section class="flat-row products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section style2 ">
                    <h1 class="title">Menu</h1>
                </div>
                <form class="flat-shop-ordering" method="get">
                    <select name="orderby" class="orderby">
                        <option value="menu_order" selected="selected">Sort by date</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </form>
            </div><!--col-md-12-->
        </div><!--row-->
    </div>

    <div class="container">
        <div class="row">
            @foreach ($menus as $menu)
            <div class="col-sm-3 col-xs-6">
                <div class="product effect1">
                    <div class="box-wrap">
                        <div class="box-image">
                            <a href="{{ route('bubblepop.detailmenu', $menu->id) }}">
                                <img src="{{ asset('front/images/imagebox/3.jpg') }}" alt="images">
                            </a>
                        </div>
                        <div class="box-content">
                            <h6>{{ $menu->name }}</h6>
                            <ul>
                                <li style="margin-left: 15px;">
                                    <div class="row">
                                        Rp. {{ number_format($menu->price_m) }} - M
                                    </div>
                                    <div class="row">
                                        Rp. {{ number_format($menu->price_l) }} - L
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-arrow-right"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="clearfix"></div>
            <nav class="navigation  paging-navigation pager-numeric">
                {{ $menus->links() }}
            </nav>
        </div><!--row-->
    </div><!--container -->
</section>
{{-- all menu --}}
@endsection