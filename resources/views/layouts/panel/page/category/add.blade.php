@extends('layouts.panel.panel')

@section('title', 'Category')
@section('subtitle', 'Add Category')

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
                <h4 class="title">Add Category</h4>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('panel.category.storecategory') }}" method="POST">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Name</label>
                                @if ($errors->has('name'))
                                    <small class="text-danger"> *{{ $errors->first('name') }}</small>
                                @endif
                                <input type="text" name="name" class="form-control" placeholder="eg: dessert">
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Add Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- All product  End -->
</div>
@endsection