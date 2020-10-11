<section class="flat-row flat-imagebox index-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section style2 ">
                    <div class="top-section">
                        <p>Discover</p>
                    </div>
                    <h1 class="title">New Menu</h1>
                </div>
            </div><!--col-md-12-->
        </div><!--row-->

        <div class="row">
            <div class="flat-divider d10px"></div>
            
            @foreach ($menus as $item)
                <div class="item">
                    <div class="imagebox effect1">
                        <div class="box-wrap">
                            <div class="box-image">
                                <a href="{{ route('bubblepop.detailmenu', $item->id) }}"><img src="{{ asset('front/images/imagebox/2.jpg') }}" alt="images"></a>
                            </div>
                            <div class="box-content">
                                <h5>{{ $item->name }}</h5>
                                <ul>
                                    <li style="margin-left: 15px;">
                                        <div class="row">
                                            Rp. {{ number_format($item->price_m) }} - M
                                        </div>
                                        <div class="row">
                                            Rp. {{ number_format($item->price_l) }} - L
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--row-->
    </div><!--container -->
</section>
<div class="row container justify-content-center ml-1 mr-1" style="margin-top: 32px;">
    <div class="read-more view-all">
        <a href="{{ route('bubblepop.menu') }}">View All Menu</a>
    </div>
</div>