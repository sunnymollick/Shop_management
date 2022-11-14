<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    </section>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    
                    <img src="<?php echo e(asset($settings->image_path)); ?>" height="100" width="250" alt="Logo">
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
                <b>Order Date:</b> <?php echo e(date_format(date_create($order->return_date), 'd/m/Y')); ?><br>
                
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php
            $createdAt = strtotime($order->start_date);
            // $returnDate = strtotime($order->return_date);
            // $datediff = $returnDate - $createdAt;

            // $d = max(round($datediff / (60 * 60 * 24)), 1) + 1;
        ?>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>SKU</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($i = 1); ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($product->art_no); ?></td>
                                <td><?php echo e($product->title); ?></td>
                                <td><?php echo e($product->quantity); ?></td>
                                <td><?php echo e($product->unit_price); ?></td>
                                <td>৳ <?php echo e($product->price); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead"> Payment Status  :
                    <?php if(($order->order_value - $order->discount_amount - $order->amount_paid) == 0): ?>
                        <span style="padding-left: 110px"><span class="label label-success" style="font-size: 20px">Paid</span></span>
                    <?php else: ?>
                        
                        <span style="padding-left: 110px"><button class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">Due</button></span>
                    <?php endif; ?>
                </p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Order Date:</th>
                            <td><?php echo e(date_format(date_create($order->created_at), 'd/m/Y')); ?></td>
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
                            <th>Amount Paid:</th>
                            <td>৳ <?php echo e($order->amount_paid); ?></td>
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="text-dark" id="staticBackdropLabel">Payment</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?php echo e($settings->company_name); ?></strong><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?php echo e($order->cname); ?></strong><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice <?php echo e($invoice->invoice_id); ?></b><br>
                            <b>Order Date:</b> <?php echo e(date_format(date_create($order->return_date), 'd/m/Y')); ?><br>
                            
                        </div>
                        <!-- /.col -->
                    </div>
                    <form action="<?php echo e(route('due.paid',$order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="">Total</label>
                                <input type="text" name="total" value="৳ <?php echo e($order->order_value); ?>" class="form-control" readonly id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Discount</label>
                                <input type="text" name="discount" value="৳ <?php echo e($order->discount_amount); ?>" class="form-control" readonly id="">
                            </div>
                            <div class="col-md-4">
                                <label for="">Net Total</label>
                                <input type="text" name="total" value="৳ <?php echo e($order->order_value - $order->discount_amount); ?>" class="form-control" readonly id="">
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="">Advance Paid</label>
                                <input type="text" name="discount" value="৳ <?php echo e($order->advance_paid); ?>" class="form-control" readonly id="">
                            </div>

                            <div class="col-md-6">
                                <label for="">Due</label>
                                <input type="text" name="due" value="৳ <?php echo e($order->order_value - $order->discount_amount - $order->amount_paid); ?>" class="form-control" readonly id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Pay</label>
                                <input type="text" name="paid" value="<?php echo e($order->order_value - $order->discount_amount - $order->amount_paid); ?>" class="form-control" placeholder="Enter Amount" id="">
                            </div>
                            <div class="col-md-6">
                                <label for="">Reference</label>
                                <input type="text" name="ref_2" placeholder="Enter Reference Name" class="form-control" id="ref">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="">Payment Method</label>
                                <br>
                                <input type="radio" name="payment_method"  value="Cash" id="payment_cash">
                                <label for="">Cash</label>

                                <input type="radio" name="payment_method" value="Bkash" id="payment_bkash">
                                <label for="">Bkash</label>

                                <input type="radio" name="payment_method" value="Bank Transaction" id="payment_bank">
                                <label for="">Bank</label>
                            </div>
                            <div class="col-md-6" id="transaction_code">
                                <label for="">Transaction Code</label>
                                <input type="text" name="transaction_code_2" class="form-control" placeholder="Enter Transaction Code"  id="transaction_value">
                            </div>


                            <br>
                        </div>


                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
            </div>
        </div>

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?php echo e(route('invoice.print', $order->id)); ?>" target="_blank" class="btn btn-primary"
                    style="margin-right: 5px;"><i class="fa fa-eye"></i> View Invoice</a>
                <a href="<?php echo e(route('invoice.print', $order->id)); ?>" target="_blank" class="btn btn-warning"
                    style="margin-right: 5px;"><i class="fa fa-print"></i> Print Invoice </a>
                    <?php if(($order->order_value - $order->discount_amount - $order->amount_paid) != 0): ?>
                    <button class="btn btn-success" style="margin-right: 5px;" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Pay Due</button></span>
                    <?php endif; ?>


                
                

                

                
                <a href="<?php echo e(route('receiptCreate', $order->id)); ?>" target="_blank" class="btn btn-primary pull-right"
                    style="margin-right: 5px;"><i class="fa fa-print"></i> Print Receipt</a>
                
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function(){
            $("#transaction_code").hide();
            $('#payment_bkash').on('click', function () {
            if ($(this).prop('checked') == true) {
                $("#transaction_code").show();
            }
            });

            $('#payment_cash').on('click', function () {
            if ($(this).prop('checked') == true) {
                $("#transaction_code").hide();
            }
            });

            $('#payment_bank').on('click', function () {
            if ($(this).prop('checked') == true) {
                $("#transaction_code").show();
            }
        });

        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Office Project\dokan\resources\views/order/show.blade.php ENDPATH**/ ?>