@extends('layouts.front.front')

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