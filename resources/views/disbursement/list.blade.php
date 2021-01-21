@extends('layouts.app')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Disbursement</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Timestamp</th>
                                        <th>Bank Code</th>
                                        <th>Account Number</th>
                                        <th>Benerficiary Name</th>
                                        <th>Remark</th>
                                        <th>Receipt</th>
                                        <th>Time Served</th>
                                        <th>Fee</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

@section('js')
<!-- DataTables -->
<script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $('#datatables').DataTable({
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: window.location.protocol + "//" +window.location.host+'/disbursement/datatables',
            columns: [
                {data: 'DT_RowIndex', name: 'id', className: "text-center", searchable: false, orderable: false},
                {data: 'id', name: 'id'},
                {data: 'amount', name: 'amount'},
                {data: 'status', name: 'status'},
                {data: 'timestamp', name: 'timestamp'},
                {data: 'bank_code', name: 'bank_code'},
                {data: 'account_number', name: 'account_number'},
                {data: 'beneficiary_name', name: 'beneficiary_name'},
                {data: 'remark', name: 'remark'},
                {data: 'receipt', name: 'receipt'},
                {data: 'time_served', name: 'time_served'},
                {data: 'fee', name: 'fee'},
            ]
        });
    })
</script>
@stop
