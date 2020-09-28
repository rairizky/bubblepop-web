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
                    <table class="table data-table data-table-default">

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