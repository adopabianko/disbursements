@extends('layouts.app')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/plugins/alertify/themes/alertify.core.css') }}">
<link rel="stylesheet" href="{{ asset('theme/plugins/alertify/themes/alertify.bootstrap.css') }}">
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    @permission('user-add-new-data')
                    <div class="float-right">
                        <a href="{{ route('user.create') }}" class="btn btn-sm bg-gradient-success">Add New</a>
                    </div>
                    @endpermission
                </div>
            </div>
            @foreach(['danger', 'success'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('alert-' . $msg) }}
                    </div>
                @endif
            @endforeach
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
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-center">Actions</th>
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
<script src="{{ asset('theme/plugins/alertify/lib/alertify.min.js')}}"></script>
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
            ajax: window.location.href + '/datatables',
            columns: [
                {data: 'DT_RowIndex', name: 'id', className: "text-center", searchable: false, orderable: false},
                {data: 'display_name', name: 'display_name'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'actions', name: 'actions', className: "text-center", searchable: false, orderable: false},
            ]
        });
    })

    function Delete(id, name) {
        alertify.confirm("Are you sure want to delete " + "'"+ name +"'", function (e) {
            if (e) {
                $.get(window.location.href + '/' + id + '/destroy', function(data) {
                    var obj = jQuery.parseJSON(JSON.stringify(data));

                    if (obj.status == 'success') {
                        alertify.alert(obj.message, function(e) {
                            window.location.reload();
                        });
                    } else {
                        alertify.alert(obj.message);
                    }
                });
            }
        });
    }
</script>
@stop
