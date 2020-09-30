@extends('layouts.panel.panel')

@section('title', 'Transaction')
@section('subtitle', 'Onsite Transaction')

@section('content')

<!-- content -->
<div class="row mbn-30">
    <!-- All Product Start -->
    <div class="col-xlg-4 col-lg-12 col-12 mb-30">
        <p>
            <span class="text-heading fw-600">Order Owner :</span> {{ $current_customer->name }} <br>
            <span class="text-heading fw-600">Cashier Name :</span> {{ \App\Models\User::find($current_customer->cashier)->name }}
        </p>
        <div class="row">
            <div class="col-sm-7 mb-20">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">New Transaction</h4>
                    </div>
                    <div class="box-body">
                        <!-- content -->
                        <form action="#" method="GET">
                            <div class="mb-20">
                                <label>Search</label>
                                <input type="text" name="search" class="form-control" placeholder="Search menu...">
                            </div>
                        </form>
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
                        <div class="row">
                            @foreach ($menus as $data)
                            <div class="col-sm-6 mb-30">
                                <div class="card">
                                    <img src="{{ asset("uploads/menu/$data->id/$data->image") }}" class="card-img-top" alt="{{ $data->image }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $data->name }}</h5>
                                        <form action="{{ route('panel.transaction.storecart.onsite', $current_customer->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="menu_id" value="{{ $data->id }}" hidden>
                                            <div class="mb-20">
                                                <label>Size</label>
                                                <div class="adomx-checkbox-radio-group inline">
                                                    <label class="adomx-radio">
                                                        <input id="size_m" type="radio" name="size" value="M"> <i class="icon"></i>Rp. {{ number_format($data->price_m) }} (M)
                                                    </label>
                                                    <label class="adomx-radio">
                                                        <input id="size_l" type="radio" name="size" value="L"> <i class="icon"></i>Rp. {{ number_format($data->price_l) }} (L)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-20">
                                                <label>Mount</label>
                                                <input type="number" name="mount" class="form-control" placeholder="eg: 3" autocomplete="off">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">List Order</h4>
                    </div>
                    <div class="box-body">
                        @foreach ($order_detail as $list)
                            <div class="media">
                                @php
                                    $menu_data = App\Models\Menu::find($list->menu_id);

                                    $get_mount = $menu_data->detail_order->mount;
                                    $get_price = $menu_data->detail_order->price;
                                    $subtotal = $get_mount*$get_price;
                                @endphp
                                <img src="{{ asset("uploads/menu/$menu_data->id/$menu_data->image") }}" width="60" class="mr-3 rounded" alt="{{ $menu_data->name }}">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between row mbn-20 mr-1 ml-1">
                                        <h6 class="mt-0">{{ $menu_data->name }} <span class="badge badge-pill badge-primary">{{ $menu_data->detail_order->size }}</span></h6>
                                        <div class="dropdown">
                                            <a class="toggle" id="dropdownActionOrder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-caret-down"></i><span class="badge"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownActionOrder">
                                                <a class="dropdown-item" href="#">Add Topping</a>
                                                <hr>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <hr>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between row mbn-20 mr-1 ml-1 mt-20">
                                        <p>
                                            <strong>{{ $menu_data->detail_order->mount }}</strong> x {{ number_format($menu_data->detail_order->price) }}
                                            </p>
                                        
                                        <p>
                                            Rp. {{ number_format($subtotal) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <p>
                            <strong>Total {{ $sum_item }} items.</strong>
                        </p>
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
                                        <input type="text" name="total" class="form-control" placeholder="Total" autocomplete="off" value="48000" readonly>               
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Paid</label>
                                        @if ($errors->has('paid'))
                                            <small class="text-danger"> *{{ $errors->first('paid') }}</small>
                                        @endif
                                        <input type="text" name="paid" class="form-control" placeholder="Paid" autocomplete="off" value="0">    
                                        <p class="mt-5 text-danger">Change : 0</p>           
                                    </div>
                                    <div class="col-12 mb-20 d-flex justify-content-end">
                                        <a href="#" class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#modalCancelOrder">Cancel Order</a>    
                                        <button type="submit" class="btn btn-primary">End Order</button>   
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalCancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation Cancel</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want cancel this order?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="{{ route('panel.transaction.cancelorder.onsite', $current_customer->id) }}" class="btn btn-danger">Yes! Cancel Order</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>           
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
<script type="text/javascript">
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