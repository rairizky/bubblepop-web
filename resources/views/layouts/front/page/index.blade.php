@extends('layouts.front.front')

@section('title', 'Home')

@section('content')
    <!-- Slider -->
    @include('layouts.front.page.index.slider')
    {{-- end slider --}}

    {{-- promo --}}
    @include('layouts.front.page.index.promo')
    {{-- end promo --}}

    {{-- new menu --}}
    @include('layouts.front.page.index.newmenu')
    {{-- end new menu --}}
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            stagePadding: 0,
            items: 1,
            loop:true,
            margin:24,
            singleItem:true,
            nav:true,
        })
    });
</script>
@endsection