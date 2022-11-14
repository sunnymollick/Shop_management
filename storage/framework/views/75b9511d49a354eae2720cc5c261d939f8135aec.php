<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
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
    <div class="wrapper" style="scrollbar-width: none;">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?php echo e($settings->company_name); ?>

                        <small class="pull-right">Date: <?php echo e(date('d/m/Y')); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong><?php echo e($settings->company_name); ?></strong><br>
                        <?php echo e($settings->company_address); ?><br>
                        <?php echo e($settings->company_city); ?><br>
                        Phone: <?php echo e($settings->phone); ?><br>
                        Email: <?php echo e($settings->email); ?>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?php echo e($order->cname); ?></strong><br>
                        Office Address: <?php echo e($order->address); ?><br>
                        Deliver Address: <?php echo e($order->delivery_address); ?><br>
                        Phone: <?php echo e($order->mobile); ?><br>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice <?php echo e($invoice->invoice_id); ?></b><br>
                    <br>
                    <b>Order ID:</b> <?php echo e($order->id); ?><br>
                    <b>Payment Due:</b> <?php echo e(date_format(date_create($order->return_date), 'd/m/Y')); ?><br>
                    
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Art. No.</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($product->quantity); ?></td>
                                    <td><?php echo e($product->title); ?></td>
                                    <td><?php echo e($product->art_no); ?></td>
                                    <td><?php echo e($product->description); ?></td>
                                    <td><?php echo e($product->price); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php
                $createdAt = strtotime($order->start_date);
                $returnDate = strtotime($order->return_date);
                $datediff = $returnDate - $createdAt;
        
                $d = max(round($datediff / (60 * 60 * 24)), 1) + 1;
            ?>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6" style="padding-top: 100px;">
                    <p class="signature text-center mt-5">
                        --------------------------<br>
                        Signature
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Amount Due <?php echo e(date_format(date_create($order->return_date), 'd/m/Y')); ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Created At:</th>
                                <td><?php echo e(date_format(date_create($order->created_at), 'd/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Rent From:</th>
                                <td><?php echo e(date_format(date_create($order->start_date), 'd/m/Y')); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Rent To:</th>
                                <td><?php echo e(date_format(date_create($order->return_date), 'd/m/Y')); ?></td>
                            </tr>
    
                            <tr>
                                <th style="width:50%">Total Days:</th>
                                <td><?php echo e($d); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Total:</th>
                                <td>৳ <?php echo e($order->order_value); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">Discount:</th>
                                <td>৳ <?php echo e($order->discount_amount); ?></td>
                            </tr>
                            <tr>
                                <th>Net Total:</th>
                                <td>৳ <?php echo e($order->order_value - $order->discount_amount); ?></td>
                            </tr>
                            <tr>
                                <th>Advance Payment:</th>
                                <td>৳ <?php echo e($order->advance_paid); ?></td>
                            </tr>
                            <tr>
                                <th>Due:</th>
                                <td>৳ <?php echo e($order->order_value - $order->discount_amount - $order->amount_paid); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <p class="tos mt-5" style="padding-top: 100px;">I agree with all terms and conditions.</p>
        </section>
    </div>
    <!-- ./wrapper -->
</body>

</html>
<?php /**PATH C:\laragon\www\lens\resources\views/invoice/show.blade.php ENDPATH**/ ?>