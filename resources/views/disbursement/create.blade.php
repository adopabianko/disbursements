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
                                <h3 class="card-title">Create Disbursement</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" id="create-disbursement-form">

                                @csrf
                                <div class="card-body">
                                    <div id="message"></div>

                                    <div class="form-group">
                                        <label for="bank_code">Bank Code</label> <label class="text-danger">*</label>
                                        <input type="text" name="bank_code" class="form-control" id="bank_code" placeholder="Enter Bank Code" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label> <label class="text-danger">*</label>
                                        <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Enter Account Number" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label> <label class="text-danger">*</label>
                                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="remark">Remark</label> <label class="text-danger">*</label>
                                        <textarea name="remark" class="form-control" id="remark" placeholder="Enter Remark" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn bg-gradient-primary" id="btn-create-disbursement">Process</button>
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
    <script src="{{ asset('theme/plugins/alertify/lib/alertify.min.js')}}"></script>
    <script>
        $(function() {
            $('#create-disbursement-form').validate({
                rules: {
                    bank_code: {
                        required: true,
                    },
                    account_number: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                    remark: {
                        required: true,
                    },
                },
                messages: {
                    bank_code: {
                        required: "Please enter a bank code",
                    },
                    account_number: {
                        required: "Please enter a account number",
                    },
                    amount: {
                        required: "Please enter a amount",
                    },
                    remark: {
                        required: "Please enter a remark",
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
                    var btn  = $("#btn-create-disbursement");

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : window.location.protocol + "//" +window.location.host+'/disbursement/store',
                        type : 'POST',
                        data : $("#create-disbursement-form").serialize(),
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
                                    alertify.alert(obj.message);
                                } else {
                                    // clear form
                                    $('#create-disbursement-form').trigger("reset");

                                    var alertSuccess = `
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        ${obj.message}
                                    </div>
                                    `;

                                    $('#message').html(alertSuccess);
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
