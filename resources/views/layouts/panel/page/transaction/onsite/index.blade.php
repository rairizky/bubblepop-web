@extends('layouts.panel.panel')

@section('title', 'Transaction')
@section('subtitle', 'Onsite Transaction')

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

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <div class="row">
            <div class="col-sm-7 mb-20">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">New Transaction</h4>
                    </div>
                    <div class="box-body">
                        <div class="form">
                            <form action="{{ route('panel.transaction.storeinvoice.onsite') }}" method="POST">
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
                        <div class="container mt-2 mb-2">
                            <p>atau</p>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalScan">Scan QR CODE</button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalScan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Scan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('panel.transaction.storescaninvoice.onsite') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('images/acc/qr_text.png') }}">
                                            </div>
                                            
                                            <p class="d-flex justify-content-center">Scan or input manually transaction code below</p>
                                            <input type="text" name="transaction_code" class="form-control" placeholder="Transaction code" autocomplete="off">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Scan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- All product  End -->
</div>
@endsection

@section('script')
<script>
    var t = $('.data-table-default').DataTable({
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>
@endsection