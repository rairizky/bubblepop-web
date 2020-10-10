@extends('layouts.panel.panel')

@section('title', 'Category')
@section('subtitle', 'Manage Category')

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
                <h4 class="title">List All Category</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table data-table data-table-default">

                        <!-- Table Head Start -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="col-md-7">Name</th>
                                <th>#</th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            @foreach ($categories as $data)
                            <tr>
                                <td class="fw-600"></td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <a href="{{ route('panel.category.edit', $data->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a data-toggle="modal"  class="btn btn-danger btn-sm" data-target="#modalConfirm{{ $data->id }}" style="color: white;">Delete</a>
                                    <div class="modal fade" id="modalConfirm{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <a style="color: white;" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                                    <form action="{{ route('panel.category.delete', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete category</button>
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