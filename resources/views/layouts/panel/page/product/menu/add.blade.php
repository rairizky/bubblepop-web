@extends('layouts.panel.panel')

@section('title', 'Product')
@section('subtitle', 'Add Menu')

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
                <h4 class="title">Add Menu</h4>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('panel.product.store.menu') }}" method="POST">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Name</label>
                                @if ($errors->has('name'))
                                    <small class="text-danger"> *{{ $errors->first('name') }}</small>
                                @endif
                                <input type="text" name="name" class="form-control" placeholder="Name product">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Image</label>
                                @if ($errors->has('image'))
                                    <small class="text-danger"> *{{ $errors->first('image') }}</small>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Price</label>
                                @if ($errors->has('price'))
                                    <small class="text-danger"> *{{ $errors->first('price') }}</small>
                                @endif
                                <input type="text" name="price" class="form-control" placeholder="20000">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Category</label>
                                @if ($errors->has('category'))
                                    <small class="text-danger"> *{{ $errors->first('category') }}</small>
                                @endif
                                <select name="category" class="form-control">
                                    <option value="" selected>-- Select Category --</option>
                                    @foreach ($categories as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Description</label>
                                @if ($errors->has('description'))
                                    <small class="text-danger"> *{{ $errors->first('description') }}</small>
                                @endif
                                <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Description product"></textarea>
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Status</label>
                                @if ($errors->has('status'))
                                    <small class="text-danger"> *{{ $errors->first('status') }}</small>
                                @endif
                                <select name="status" class="form-control">
                                    <option value="" selected>-- Select Status --</option>
                                    <option value="available">Available</option>
                                    <option value="notavailable">Not Available</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Add Menu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- All product  End -->
</div>
@endsection