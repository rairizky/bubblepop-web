@extends('layouts.panel.panel')

@section('title', 'Users')
@section('subtitle', 'Add Users')

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
    <div class="col-xlg-12 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Form Users</h3>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('panel.users.storeusers') }}" method="POST">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Name</label>
                                @if ($errors->has('name'))
                                    <small class="text-danger"> *{{ $errors->first('name') }}</small>
                                @endif
                                <input type="text" name="name" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Email</label>
                                @if ($errors->has('email'))
                                    <small class="text-danger"> *{{ $errors->first('email') }}</small>
                                @endif
                                <input type="text" name="email" class="form-control" placeholder="mail@bubblepop.my.id">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Password</label>
                                @if ($errors->has('password'))
                                    <small class="text-danger"> *{{ $errors->first('password') }}</small>
                                @endif
                                <input type="password" name="password" class="form-control" placeholder="••••••">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Role</label>
                                @if ($errors->has('role'))
                                    <small class="text-danger"> *{{ $errors->first('role') }}</small>
                                @endif
                                <select name="role" class="form-control">
                                    <option value="" selected>-- Select Role --</option>
                                    <option value="admin">admin</option>
                                    <option value="cashier">cashier</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Add Users</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection