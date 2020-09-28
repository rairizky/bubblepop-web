@extends('layouts.panel.panel')

@section('title', 'Product')
@section('subtitle', 'Manage Menu')

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
                <h4 class="title">List All Menu</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover data-table data-table-default">

                        <!-- Table Head Start -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            @foreach ($menus as $data)
                                <tr>
                                    <td class="align-middle"></td>
                                    <td class="align-middle">
                                        {{ $data->name }}
                                    </td>
                                    <td>
                                        <p>Rp. {{ number_format($data->price_m) }} (<span class="text-primary">M</span>)</p>
                                        <p>Rp. {{ number_format($data->price_l) }} (<span class="text-primary">L</span>)</p>
                                    </td>
                                    <td class="align-middle">
                                        {{ $data->category->name }}
                                    </td>
                                    <td class="align-middle">
                                        @if ($data->status == "available")
                                        <span class="badge badge-pill badge-primary">{{ $data->status }}</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('panel.product.edit.menu', $data->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <a data-toggle="modal"  class="btn btn-danger btn-sm" data-target="#modalConfirm" style="color: white;">Delete</a>
                                        <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want delete this menu?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a style="color: white;" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                                        <form action="{{ route('panel.product.delete.menu', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete menu</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody><!-- Table Body End -->

                    </table>
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