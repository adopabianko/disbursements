@extends('layouts.app')

@section('cs')
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ route('role') }}" class="btn btn-sm bg-gradient-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Access Management</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="access-management-form" method="POST" action="{{ route('role.access-management-store') }}">

                            @csrf
                            <input type="hidden" name="role_id" value="{{ $role->id }}">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center cb">
                                            <div class="icheck-primary">
                                                <input type="checkbox" class="cb" id="checked-all-permission">
                                                <label for="someCheckboxId"></label>
                                            </div>
                                        </th>
                                        <th>Permission Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $item)
                                        <tr>
                                            <td class="text-center">
                                                <div class="icheck-primary">
                                                    <input type="checkbox"
                                                           name="checkbox_permission[]"
                                                           value="{{ $item->id }}"
                                                           class="cb checkbox-permission"
                                                           @if (in_array($item->id, $permissionRoleArr)) checked  @endif
                                                    required>
                                                    <label for="someCheckboxId"></label>
                                                </div>
                                            </td>
                                            <td>{{ $item->display_name }}</td>
                                            <td>{{ $item->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div id="error-text" class="text-danger" style="margin-left: 10px"></div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary">Save</button>
                            </div>
                        </form>
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
<!-- jquery-validation -->
<script src="{{ asset('theme/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('theme/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(function() {
        $('#access-management-form').validate({
            rules: {
                "checkbox_permission[]": {
                    required: true,
                },
            },
            messages: {
                "checkbox_permission[]": "Permission options cannot be empty"
            },
            errorElement : 'div',
            errorLabelContainer: '#error-text',
        });
        $("#checked-all-permission").click(function() {
            $("input:checkbox").not(this).prop("checked", this.checked);
        })
    });
</script>
@stop
