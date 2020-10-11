@extends('layouts.front.front')

@section('content')
{{-- hero --}}
<div class="page-title parallax parallax1 flat_strech">
    <div class="container">
        <div class="row">
            <div class="col-md-12">                    
                <div class="page-title-heading">
                    <h1 class="title">Detail {{ $get_menu->name }}</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li> <a href="{{ route('bubblepop.index') }}">Home </a></li>
                            <li><a href="{{ route('bubblepop.menu') }}">Menu</a></li>
                            <li><a href="#">{{ $get_menu->name }}</a></li>
                        </ul>                   
                    </div>
                </div><!-- /.page-title-captions -->                        
            </div><!-- /.col-md-12 -->  
        </div><!-- /.row -->  
    </div><!-- /.container -->                      
</div>
{{-- end hero --}}

{{-- detail menu --}}
<div class="flat-row flat-wooc">
    <div class="container">
        <div class="row">
            <div class="woocommerce-page clearfix"> 
                <div class="col-md-6">                 
                    <div class="flat-product-single-slider">
                        <div id="flat-product-flexslider">
                            <div class="flex-viewport" style="overflow: hidden; position: relative;">
                                <ul class="slides" style="width: 800%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                                    <li class="flex-active-slide" style="width: 558px; margin-right: 0px; float: left; display: block;">
                                        <img alt="product-single" src="{{ asset('front/images/shop/1.jpg') }}" class="attachment-themesflat-gallery-product size-themesflat-gallery-product" draggable="false" width="450" height="450">
                                    </li>
                                </ul>
                            </div>
                            <ul class="flex-direction-nav">
                                <li class="flex-nav-prev">
                                    <a class="flex-prev flex-disabled" href="#" tabindex="-1">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="flex-nav-next">
                                    <a class="flex-next" href="#">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="flat-product-carousel">
                            
                    </div>
                    </div><!-- /.flat-portfolio-single-slider --> 
                </div><!--/.col-md-6 -->  
                <br>
                <div class="col-md-6">
                    <div class="entry-summary">
                        <h2 class="product_title">{{ $get_menu->name }}</h2>

                        <p class="price">
                            Rp. {{ number_format($get_menu->price_m) }} <span class="badge">M</span>
                        </p>
                        <p class="price">
                            Rp. {{ number_format($get_menu->price_l) }} <span class="badge">L</span>
                        </p>

                        <div class="description">
                            <p>
                                Terlalu manis/kurang manis? jangan lupa tambahkan extra/less sugar pada menu anda, dan rasakan sensasi nya
                            </p>
                        </div>

                        <ul class="flat-socials">
                            <li>Share link: </li>
                            <li class="twitter">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li class="facebook">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="instagram">
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li> 
                            <li class="linkin">
                                <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                            </li>  
                        </ul>
                    </div><!-- /.entry-summary -->
                </div><!--/.col-md-8 -->
            </div><!--/.woocommerce-page -->
        </div><!--/.row -->
            <!--  <div class="flat-divider d62px"></div> -->
    </div><!--/.container -->
</div>
{{-- end detail menu --}}
@endsection