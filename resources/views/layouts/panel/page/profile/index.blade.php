@extends('layouts.panel.panel')

@section('title', 'Profile')
@section('subtitle', Auth::user()->name)

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
<div class="row mbn-50">
    <!--Author Top Start-->
    <div class="col-12 mb-50">
        <div class="author-top">
            <div class="inner">
                <div class="author-profile">
                    <div class="image">
                        @if ($profile != null)
                        <img src="{{ asset('uploads/profile/'.$profile->image) }}" class="" alt="">
                        @endif
                    </div>
                    <div class="info">
                        <h5>{{ $current->name }}</h5>
                        <span>{{ $current->role }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Author Top End-->
</div>

<div class="row mt-4">
    <div class="col-xlg-12 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Account Information</h3>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('profile.updateprofile.account') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Name</label>
                                @if ($errors->has('name'))
                                    <small class="text-danger"> *{{ $errors->first('name') }}</small>
                                @endif
                                <input type="text" name="name" class="form-control" placeholder="Fullname" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="mail@bubblepop.my.id" disabled value="{{ auth()->user()->email }}">
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Update Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@if ($profile == null)

<div class="alert alert-danger" role="alert">
    Add <strong>Profile Information</strong> first!
</div>

<div class="row mbn-50">
    <div class="col-xlg-12 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Profile Information</h3>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('profile.addprofile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Image</label>
                                @if ($errors->has('image'))
                                    <small class="text-danger"> *{{ $errors->first('image') }}</small>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Phone</label>
                                @if ($errors->has('phone'))
                                    <small class="text-danger"> *{{ $errors->first('phone') }}</small>
                                @endif
                                <input type="text" name="phone" class="form-control" placeholder="0858xxx">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Address</label>
                                @if ($errors->has('address'))
                                    <small class="text-danger"> *{{ $errors->first('address') }}</small>
                                @endif
                                <textarea name="address" cols="30" rows="10" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Add Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@else
<div class="row mbn-50">
    <div class="col-xlg-12 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Profile Information</h3>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('profile.updateprofile.information') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Image</label>
                                @if ($errors->has('image'))
                                    <small class="text-danger"> *{{ $errors->first('image') }}</small>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Phone</label>
                                @if ($errors->has('phone'))
                                    <small class="text-danger"> *{{ $errors->first('phone') }}</small>
                                @endif
                                <input type="text" name="phone" value="{{ $profile->phone }}" class="form-control" placeholder="0858xxx">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Address</label>
                                @if ($errors->has('address'))
                                    <small class="text-danger"> *{{ $errors->first('address') }}</small>
                                @endif
                                <textarea name="address" cols="30" rows="10" class="form-control" placeholder="Address">{{ $profile->address }}</textarea>
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endif

@endsection