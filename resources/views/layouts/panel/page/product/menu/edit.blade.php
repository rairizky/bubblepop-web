@extends('layouts.panel.panel')

@section('title', 'Product')
@section('subtitle', 'Manage Menu')
@section('subtitle2', 'Edit')

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
                <h4 class="title">Edit Menu</h4>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('panel.product.update.menu', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Name</label>
                                @if ($errors->has('name'))
                                    <small class="text-danger"> *{{ $errors->first('name') }}</small>
                                @endif
                                <input type="text" name="name" class="form-control" placeholder="Name product" value="{{ $menu->name }}">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Image</label>
                                @if ($errors->has('image'))
                                    <small class="text-danger"> *{{ $errors->first('image') }}</small>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Price (M)</label>
                                @if ($errors->has('price_m'))
                                    <small class="text-danger"> *{{ $errors->first('price_m') }}</small>
                                @endif
                                <input type="text" name="price_m" class="form-control" placeholder="15000" value="{{ $menu->price_m }}">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Price (L)</label>
                                @if ($errors->has('price_l'))
                                    <small class="text-danger"> *{{ $errors->first('price_l') }}</small>
                                @endif
                                <input type="text" name="price_l" class="form-control" placeholder="18000" value="{{ $menu->price_l }}">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Category</label>
                                @if ($errors->has('category'))
                                    <small class="text-danger"> *{{ $errors->first('category') }}</small>
                                @endif
                                <select name="category" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $data)
                                        <option value="{{ $data->id }}" @if($menu->category_id == $data->id) selected @else '' @endif>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Description</label>
                                @if ($errors->has('description'))
                                    <small class="text-danger"> *{{ $errors->first('description') }}</small>
                                @endif
                                <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Description product">{{ $menu->description }}</textarea>
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Status</label>
                                @if ($errors->has('status'))
                                    <small class="text-danger"> *{{ $errors->first('status') }}</small>
                                @endif
                                <select name="status" class="form-control">
                                    <option value="">-- Select Status --</option>
                                    <option value="available" @if($menu->status == 'available') selected @else '' @endif>Available</option>
                                    <option value="notavailable" @if($menu->status == 'notavailable') selected @else '' @endif>Not Available</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Update Menu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- All product  End -->
</div>
@endsection