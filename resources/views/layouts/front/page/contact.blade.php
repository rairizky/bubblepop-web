@extends('layouts.front.front')

@section('content')
{{-- hero --}}
<div class="page-title parallax parallax1 flat_strech">
    <div class="container">
        <div class="row">
            <div class="col-md-12">                    
                <div class="page-title-heading">
                    <h1 class="title">Contact</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li> <a href="{{ route('bubblepop.index') }}">Home </a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>                   
                    </div>
                </div><!-- /.page-title-captions -->                        
            </div><!-- /.col-md-12 -->  
        </div><!-- /.row -->  
    </div><!-- /.container -->                      
</div>
{{-- end hero --}}

<section class="flat-row contact-1 ">
    <div class="container">
        <div class="row">
            <div class="flat-information col-sm-4">
                <span class="fa fa-map-marker" aria-hidden="true"></span>
                <h5 class="information-title">ADDRESS</h5>
                <p class="address">Depok, Indonesia.</p>
            </div>
            <div class="flat-information email col-sm-4">
                <span class="fa fa-envelope" aria-hidden="true"></span>
                <h5 class="information-title">Mail</h5>
                <p>mail@bubblepop.id</p>
            </div>
            <div class="flat-information phone col-sm-4">
                <span class="fa fa-phone" aria-hidden="true"></span>
                <h5 class="information-title">HOTLINE</h5>
                <p>021 000 000</p><br>
            </div>
        </div><!--  ./row -->
    </div><!-- ./container -->
</section>
@endsection