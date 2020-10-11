<section class="flat-row container">
    <div class="container">
        <div class="row">
            <div class="title-section">
                <div class="top-section">
                    <p>Special</p>
                </div>
                <h1 class="title">Promo</h1>
            </div>
            <div class="owl-carousel owl-theme" style="margin-top: 24px;">
                @foreach ($promos as $item)
                <div class="item">
                    <img src="{{ asset('uploads/promo/'.$item->id.'/'.$item->image) }}" alt="">
                </div>
                @endforeach
            </div>
        </div><!--/.row-->
    </div><!--/.container -->
</section>

