@extends('layouts.panel.panel')

@section('title', 'Product')
@section('subtitle', 'Add Product')

@section('content')

<!-- notice -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"></span>
    </button>
</div>
@endif

<!-- content -->
<div class="row mbn-30">
    <!-- All Product Start -->
    <div class="col-xlg-4 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Add Product</h4>
            </div>
            <div class="box-body">
                
            </div>
        </div>
    </div><!-- All product  End -->
</div>
@endsection