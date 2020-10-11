@extends('layouts.front.front')

@section('content')
{{-- hero --}}
<div class="page-title parallax parallax1 flat_strech">
    <div class="container">
        <div class="row">
            <div class="col-md-12">                    
                <div class="page-title-heading">
                    <h1 class="title">About</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li> <a href="{{ route('bubblepop.index') }}">Home </a></li>
                            <li><a href="#">About</a></li>
                        </ul>                   
                    </div>
                </div><!-- /.page-title-captions -->                        
            </div><!-- /.col-md-12 -->  
        </div><!-- /.row -->  
    </div><!-- /.container -->                      
</div>
{{-- end hero --}}

<section class="flat-row flat-our">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('front/images/imagebox/1.png') }}" alt="images">
            </div><!--col-md-6-->   

            <div class="col-md-6">
                <div class="flat-divider d96px"></div>
                <div class="wrap-content-story">
                    <div class="title-section style2 ">
                        <h1 class="title">Our Story</h1>
                    </div>
                    <p class="content-story">Sumi is a restaurant, bar and coffee roastery located on a busy corner site in Farringdon's Exmouth Market. With glazed frontage on two sides of the building, overlooking the market and a bustling.</p>
                    <ul class="iconlist">
                        <li><i class="fa fa-circle-o"></i> Sumi is a restaurant, bar and coffee roastery located </li>
                        <li><i class="fa fa-circle-o"></i> Sumi is a restaurant, bar and coffee </li>
                        <li><i class="fa fa-circle-o"></i> Sumi is a restaurant, bar and coffee roastery located on a Sumi </li>
                        <li><i class="fa fa-circle-o"></i> restaurant, bar and coffee roastery located </li>
                    </ul>
                </div>
            </div><!--/.col-md-6-->  
        </div><!--/.row-->
    </div><!--/.container -->
</section>
@endsection