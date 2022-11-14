<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/AdminLTE.min.css')); ?>">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();" style="margin: 60px;">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Terms and conditions
                        <small class="pull-right">Date: <?php echo e(date('d/m/Y')); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->

            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">



                <!-- /.col -->
            </div>
            <!-- /.row -->
<p class="tos mt-5" style="padding-top: 100px;"><?php echo e($settings->tos); ?></p>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6" style="padding-top: 200px">
                    <div class="row">
                        <div class="col-xs-6">
                            <p class="signature text-center mt-5">
                        --------------------------<br>
                        Signature
                    </p>
                </div>

                    </div>
                </div>

            </div>
            <!-- /.row -->

        </section>


    </div>
    <!-- ./wrapper -->
</body>

</html>
<?php /**PATH C:\wamp\www\projectNafizVai\resources\views/order/tos.blade.php ENDPATH**/ ?>