@extends('layouts.panel.panel')

@section('title', 'Promo')
@section('subtitle', 'Add Promo')

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
                <h4 class="title">Add Promo</h4>
            </div>
            <div class="box-body">
                <div class="form">
                    <form action="{{ route('panel.promo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-10 mbn-20">
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Title</label>
                                @if ($errors->has('title'))
                                    <small class="text-danger"> *{{ $errors->first('title') }}</small>
                                @endif
                                <input type="text" name="title" class="form-control" placeholder="Promo title..." autocomplete="off">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Image</label>
                                @if ($errors->has('image'))
                                    <small class="text-danger"> *{{ $errors->first('image') }}</small>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Description</label>
                                @if ($errors->has('description'))
                                    <small class="text-danger"> *{{ $errors->first('description') }}</small>
                                @endif
                                <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Desc promo..."></textarea>
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Promo Start</label>
                                @if ($errors->has('promo_start'))
                                    <small class="text-danger"> *{{ $errors->first('promo_start') }}</small>
                                @endif
                                <input type="date" name="promo_start" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20">
                                <label>Promo End</label>
                                @if ($errors->has('promo_end'))
                                    <small class="text-danger"> *{{ $errors->first('promo_end') }}</small>
                                @endif
                                <input type="date" name="promo_end" class="form-control">
                            </div>
                            <div class="col-sm-12 col-12 mb-20 d-flex justify-content-end">
                                <button class="btn btn-primary">Add Promo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- All product  End -->
</div>

@endsection

@section('script')
<script>
    
</script>
@endsection