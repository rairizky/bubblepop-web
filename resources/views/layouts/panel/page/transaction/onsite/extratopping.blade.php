@extends('layouts.panel.panel')

@section('title', 'Transaction')
@section('subtitle', 'Onsite Transaction')
@section('subtitle2', 'Add Extra Topping')

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

<div class="mb-20">
    <a href="{{ route('panel.transaction.cartmenu.onsite', $current_customer->id) }}" class="button button-google-pages button-sm">
        <i class="zmdi zmdi-caret-left-circle"></i>
        <span>Back to Transaction</span>
    </a>
</div>

<div class="media mb-20">
    <img src="{{ asset("uploads/menu/$menu_data->id/$menu_data->image") }}" width="60" class="mr-3 rounded" alt="{{ $menu_data->name }}">
    <div class="media-body">
        <div class="d-flex justify-content-between row mbn-20 mr-1 ml-1">
            <h6 class="mt-0">{{ $menu_data->name }} <span class="badge badge-pill badge-primary">{{ $get_order_menu->size }}</span></h6>
        </div>
        <div class="d-flex justify-content-between row mbn-20 mr-1 ml-1 mt-20">
            <p>
                {{ $get_order_menu->mount }} x {{ number_format($get_order_menu->price) }}
            </p>
        </div>
    </div>
</div>

<!-- content -->
<div class="row mbn-30">
    <!-- All Product Start -->
    <div class="col-xlg-4 col-lg-12 col-12 mb-30">
        <div class="row">
            <div class="col-sm-7 mb-20">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">Extra Topping</h4>
                    </div>
                    <div class="box-body">
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"></span>
                            </button>
                        </div>
                        @endif

                        @for ($i = 1; $i <= $get_order_menu->mount; $i++)

                            @php
                                $get_extra = App\Models\Extra::all()->where('detail_id', $get_order_menu->id)->where('extra_for', $i);
                            @endphp

                            @if ($get_extra->isEmpty())
                                <div class="mb-20">
                                    <form action="{{ route('panel.transaction.storeextratopping.onsite', [$current_customer->id, $get_order_menu->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-5">
                                            <input type="text" name="extra_id" value="{{ $i }}" hidden readonly>
                                            <label>{{ $i }}.</label>
                                            <select class="js-example-basic-multiple" name="topping[]" multiple="multiple">
                                                @foreach ($get_toppings as $topping)     
                                                <option value="{{ $topping->id }}">{{ $topping->name }} ({{ number_format($topping->price) }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="zmdi zmdi-plus"></i><span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mb-20">
                                    <form action="{{ route('panel.transaction.updateextratopping.onsite', [$current_customer->id, $get_order_menu->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-5">
                                            <input type="text" name="extra_id" value="{{ $i }}" hidden readonly>
                                            <label>{{ $i }}.</label>
                                            <select class="js-example-basic-multiple" name="topping[]" multiple="multiple">
                                                @foreach ($get_toppings as $topping)  
                                                <option value="{{ $topping->id }}" @foreach ($get_extra as $item) @if($topping->id == $item->topping_id) selected @endif @endforeach>{{ $topping->name }} ({{ number_format($topping->price) }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="zmdi zmdi-edit"></i><span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-sm-5 mb-20">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">List Extra Topping</h4>
                    </div>
                    <div class="box-body">

                        <hr>
                        <p>
                            <strong>Total 0 extra toppings.</strong>
                        </p>
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

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Select a Extra",
            allowClear: true
        });
    });
</script>
@endsection