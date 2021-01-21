@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('theme/plugins/alertify/themes/alertify.core.css') }}">
<link rel="stylesheet" href="{{ asset('theme/plugins/alertify/themes/alertify.bootstrap.css') }}">
@endsection

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
                                <h3 class="card-title">Check Status Disbursement</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" id="check-status-form">

                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id">ID</label> <label class="text-danger">*</label>
                                        <input type="text" name="id" class="form-control" id="id" placeholder="Enter ID" autofocus>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-gradient-primary" id="btn-check-status">Check Status</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->

                <div id="result-data"></div>
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
    <script src="{{ asset('theme/plugins/alertify/lib/alertify.min.js')}}"></script>
    <script>
        $(function() {
            $('#check-status-form').validate({
                rules: {
                    id: {
                        required: true,
                    },
                },
                messages: {
                    id: {
                        required: "Please enter a ID",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    var btn  = $("#btn-check-status");

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : window.location.protocol + "//" +window.location.host+'/disbursement/updatestatus',
                        type : 'POST',
                        data : $("#check-status-form").serialize(),
                        beforeSend : function () {
                            //Call Button Loading Function
                            BtnLoading(btn);
                        },
                        success : function(data) {
                            setTimeout(function(){
                                // Button loading reset
                                BtnReset(btn);

                                var obj = jQuery.parseJSON(JSON.stringify(data));

                                if (obj.status == 'error') {
                                    $('#result-data').html('');

                                    alertify.alert(obj.message);
                                } else {
                                    var tableData = `
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-primary">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>ID</td>
                                                                <td> : </td>
                                                                <td>${obj.data.id}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Amount</td>
                                                                <td> : </t>
                                                                <td>${obj.data.amount}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td> : </td>
                                                                <td>${obj.data.status}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Timestamp</td>
                                                                <td> : </td>
                                                                <td>${obj.data.timestamp}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bank Code</td>
                                                                <td> : </td>
                                                                <td>${obj.data.bank_code}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Account Number</td>
                                                                <td> : </td>
                                                                <td>${obj.data.account_number}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Beneficiary Name</td>
                                                                <td> : </td>
                                                                <td>${obj.data.beneficiary_name}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Remark</td>
                                                                <td> : </td>
                                                                <td>${obj.data.remark}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Receipt</td>
                                                                <td> : </td>
                                                                <td><a href="${obj.data.receipt}" target="_blank">${obj.data.receipt}</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Time Served</td>
                                                                <td> : </td>
                                                                <td>${obj.data.time_served}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fee</td>
                                                                <td> : </td>
                                                                <td>${obj.data.fee}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                                    // show detail data
                                    $('#result-data').html(tableData);
                                }

                            }, 500);
                        },
                        error: function() {
                            alertify.alert('Error occured.please try again');

                            // Button loading reset
                            BtnReset(btn);
                        }
                    })
                }
            });
        });

        function BtnLoading(btn) {
            btn.attr("data-original-text", btn.html());
            btn.prop("disabled", true);
            btn.html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        }

        function BtnReset(btn) {
            btn.prop("disabled", false);
            btn.html(btn.attr("data-original-text"));
        }
    </script>
@stop
