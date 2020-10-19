@extends('layouts.front.front')

@section('title', 'About')

@section('content')
{{-- hero --}}
<div class="page-title parallax parallax1 flat_strech" style="background: url({{ asset('images/bg/cafe-land.jpg') }})">
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
                <img src="{{ asset('/images/logo/logo_bubblepop.png') }}" alt="images">
            </div><!--col-md-6-->   

            <div class="col-md-6">
                <br>
                <div class="flat-divider"></div>
                <div class="wrap-content-story">
                    <div class="title-section style2 ">
                        <h1 class="title">About</h1>
                    </div>
                    <p class="content-story">
                        BUBBLE POP adalah usaha yang bergerak di bidang Food & Beverage. Produk yang ditawarkan adalah minuman seperti Milktea yang diberi tambahan topping bubble dalam penyajiannya. Kehadiran BUBBLE POP dipicu oleh keinginan pemilik untuk menambah pilihan produk Bubble Drink yang ada saat ini, dengan menghadirkan menu dengan banyak varian rasa, dan merubah pola konsumsi masyarakat dari softdrink berkarbonasi menjadi minuman yang lebih menyehatkan untuk tubuh. BUBBLE POP memasarkan produknya dengan menggunakan media sosial, web product, dan aplikasi android.
                    </p>
                    <h3>Visi</h3>
                    <p>Menciptakan usaha “Bubble Tea” dengan berbagai varian yang digemari oleh masyarakat dan sebagai wadah untuk meraih mimpi.</p><br>
                    
                    <h3>Misi</h3>
                    <ul class="iconlist">
                        <li><i class="fa fa-circle-o"></i> Memberikan dan mempertahankan cita rasa “Bubble Tea” yang terbaik. </li>
                        <li><i class="fa fa-circle-o"></i> Memberikan pelayanan terbaik kepada customer. </li>
                        <li><i class="fa fa-circle-o"></i> Melakukan usaha yang bermanfaat untuk lingkungan dan masyarakat. </li>
                        <li><i class="fa fa-circle-o"></i> Mengikuti selera masyarakat yang berkembang mengikuti zaman. </li>
                        <li><i class="fa fa-circle-o"></i> Memudahkan customer dalam waktu pemesanan. </li>
                    </ul>
                </div>
            </div><!--/.col-md-6-->  
        </div><!--/.row-->
    </div><!--/.container -->
</section>
@endsection