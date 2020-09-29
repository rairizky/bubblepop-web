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
                        @yield('transaction')
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">List Order</h4>
                    </div>
                    <div class="box-body">
                        
                    </div>
                </div>
                <div class="mt-4 box">
                    <div class="box-head">
                        <h4 class="title">Payment</h4>
                    </div>
                    <div class="box-body">
                        <div class="form">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row row-10 mbn-20">
                                    <div class="col-12 mb-20">
                                        <label>Total</label>
                                        @if ($errors->has('total'))
                                            <small class="text-danger"> *{{ $errors->first('total') }}</small>
                                        @endif
                                        <input type="text" name="total" class="form-control" placeholder="Total" autocomplete="off" value="0" readonly>               
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Paid</label>
                                        @if ($errors->has('paid'))
                                            <small class="text-danger"> *{{ $errors->first('paid') }}</small>
                                        @endif
                                        <input type="text" name="paid" class="form-control" placeholder="Paid" autocomplete="off" value="0">               
                                    </div>
                                    <div class="col-12 mb-20 d-flex justify-content-end">
                                        <a href="#" class="btn btn-outline-danger mr-2">Cancel Order</a>    
                                        <button type="submit" class="btn btn-primary">End Order</button>              
                                    </div>
                                </div>
                            </form>
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