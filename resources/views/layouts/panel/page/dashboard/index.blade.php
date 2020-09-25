@extends('layouts.panel.panel')

@section('title', 'Dashboard')

@section('content')

<!-- notice -->

<!-- content -->
<div class="row">
    <!-- Top Report Start -->
    <div class="col-xlg-3 col-md-6 col-12 mb-30">
        <div class="top-report">

            <!-- Head -->
            <div class="head">
                <h4>Total Visitor</h4>
                <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
            </div>

            <!-- Content -->
            <div class="content">
                <h5>Todays</h5>
                <h2>100,560.00</h2>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="progess">
                    <div class="progess-bar" style="width: 92%;"></div>
                </div>
                <p>92% of unique visitor</p>
            </div>

        </div>
    </div><!-- Top Report End -->

    <!-- Top Report Start -->
    <div class="col-xlg-3 col-md-6 col-12 mb-30">
        <div class="top-report">

            <!-- Head -->
            <div class="head">
                <h4>Product Sold</h4>
                <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
            </div>

            <!-- Content -->
            <div class="content">
                <h5>Todays</h5>
                <h2>85,000.00</h2>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="progess">
                    <div class="progess-bar" style="width: 98%;"></div>
                </div>
                <p>98% of unique visitor</p>
            </div>

        </div>
    </div><!-- Top Report End -->

    <!-- Top Report Start -->
    <div class="col-xlg-3 col-md-6 col-12 mb-30">
        <div class="top-report">

            <!-- Head -->
            <div class="head">
                <h4>Order Received</h4>
                <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
            </div>

            <!-- Content -->
            <div class="content">
                <h5>Todays</h5>
                <h2>5,000.00</h2>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="progess">
                    <div class="progess-bar" style="width: 88%;"></div>
                </div>
                <p>88% of unique visitor</p>
            </div>

        </div>
    </div><!-- Top Report End -->

    <!-- Top Report Start -->
    <div class="col-xlg-3 col-md-6 col-12 mb-30">
        <div class="top-report">

            <!-- Head -->
            <div class="head">
                <h4>Total Revenue</h4>
                <a href="#" class="view"><i class="zmdi zmdi-eye"></i></a>
            </div>

            <!-- Content -->
            <div class="content">
                <h5>Todays</h5>
                <h2>3,000,000.00</h2>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="progess">
                    <div class="progess-bar" style="width: 76%;"></div>
                </div>
                <p>76% of unique visitor</p>
            </div>

        </div>
    </div><!-- Top Report End -->
</div><!-- Top Report Wrap End -->

<div class="row mbn-30">
    <!-- Daily Sale Report Start -->
    <div class="col-xlg-4 col-lg-12 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Daily Sale Report</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table daily-sale-report data-table data-table-default">

                        <!-- Table Head Start -->
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Detail</th>
                                <th>Payment</th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            <tr>
                                <td class="fw-600">Alexander</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-success d-flex justify-content-between fw-600">$500.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                            <tr>
                                <td class="fw-600">Linda</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-success d-flex justify-content-between fw-600">$20.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                            <tr>
                                <td class="fw-600">Patrick</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-danger d-flex justify-content-between fw-600">$120.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                            <tr>
                                <td class="fw-600">Jose</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-success d-flex justify-content-between fw-600">$1750.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                            <tr>
                                <td class="fw-600">Amber</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-warning d-flex justify-content-between fw-600">$165.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                            <tr>
                                <td class="fw-600">Linda</td>
                                <td>
                                    <p>Sed do eiusmod tempor <br>incididunt ut labore.</p>
                                </td>
                                <td><span class="text-success d-flex justify-content-between fw-600">$20.00<span class="tippy" data-tippy-content="Sed do eiusmod tempor <br/> incididunt ut labore."><i class="zmdi zmdi-info-outline"></i></span></span></td>
                            </tr>
                        </tbody><!-- Table Body End -->

                    </table>
                </div>
            </div>
        </div>
    </div><!-- Daily Sale Report End -->
</div>
@endsection

@section('script')
<script>
    $('.data-table-default').DataTable({
        
    });
</script>
@endsection