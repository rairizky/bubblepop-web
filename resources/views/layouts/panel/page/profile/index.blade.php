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
                        <img src="{{ asset("uploads/profile/{$profile->user_id}/".$profile->image) }}" class="" alt="">
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

<div class="row mbn-50 mt-4">
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

<div class="alert alert-danger" style="margin-top: 36px;" role="alert">
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
<div class="row mbn-50 mt-4">
    <div class="col-xlg-12 col-lg-12 col-12 mb-30 mt-4">
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

<div class="row mt-4">
    <div class="col-xlg-12 col-lg-12 col-12 mb-30 mt-4">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Change Password</h3>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('profile.changepassword') }}" method="POST">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Current Password</label>
                                @if ($errors->has('current_password'))
                                    <small class="text-danger"> *{{ $errors->first('current_password') }}</small>
                                @endif
                                <input type="password" name="current_password" class="form-control" placeholder="Current password">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>New Password</label>
                                @if ($errors->has('new_password'))
                                    <small class="text-danger"> *{{ $errors->first('new_password') }}</small>
                                @endif
                                <input type="password" name="new_password" class="form-control" placeholder="New password">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>New Confirm Password</label>
                                @if ($errors->has('new_confirm_password'))
                                    <small class="text-danger"> *{{ $errors->first('new_confirm_password') }}</small>
                                @endif
                                <input type="password" name="new_confirm_password" class="form-control" placeholder="New confirm password">
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <a style="color: white;" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirm">Change Password</a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        After you confirm change password, you will redirect to form login and confirm your changed password.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Confirm Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection