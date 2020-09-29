@extends('layouts.panel.panel')

@section('title', 'Transaction')
@section('subtitle', 'Onsite Transaction')

@section('transaction')

<!-- content -->
<div class="form">
    <form action="#" method="POST">
        @csrf
        <div class="row row-10 mbn-20">
            <div class="col-12 mb-20">
                <label>Name Customer</label>
                <div class="row mbn-20">
                    <div class="col-md-6 mb-20">
                        @if ($errors->has('name'))
                            <small class="text-danger"> *{{ $errors->first('name') }}</small>
                        @endif
                        <input type="text" name="name" class="form-control" placeholder="Name customer" autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-20 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary">Create Invoice</button>
                    </div>
                </div>                
            </div>
        </div>
    </form>
</div>

@endsection

@include('layouts.panel.page.transaction.onsite.index')