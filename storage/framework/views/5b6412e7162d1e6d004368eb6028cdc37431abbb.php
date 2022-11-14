<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php if(Session::has('order_delete_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>">
                        <?php echo e(Session::get('order_delete_message')); ?></p>
                    <?php echo e(Session::forget('order_delete_message')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Customer</th>
                                    <th>Total Devices</th>
                                    <th>Order Value</th>
                                    <th>Discount</th>
                                    <th>Paid Amount.</th>
                                    <th>Payment Status</th>
                                    <th>Due</th>
                                    
                                    <th>Order Date</th>
                                    
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($order->id); ?></td>
                                        <td><?php echo e($order->cname); ?> - <?php echo e($order->mobile); ?></td>
                                        <td><?php echo e($order->total_quantity); ?></td>
                                        <td><?php echo e($order->order_value); ?></td>
                                        <td><?php echo e($order->discount_amount); ?></td>
                                        <td><?php echo e($order->amount_paid); ?></td>
                                        <td>
                                            <?php if( ( $order->order_value - ($order->amount_paid + $order->discount_amount)) == 0): ?>
                                                <span class="label label-success">Paid</span>
                                            <?php else: ?>
                                                <span class="label label-danger">Due</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($order->order_value - ($order->amount_paid + $order->discount_amount)); ?></td>
                                        
                                        <td><?php echo e(date_format(date_create($order->start_date), 'm/d/Y')); ?></td>
                                        
                                        
                                        <td>
                                            <span class="">
                                                <a href="<?php echo e(route('orders.show', $order->id)); ?>">
                                                    <small class="label bg-green" style="margin-right: 15px">View</small>
                                                </a>
                                                
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="<?php echo e(route('orders.delete', $order->id)); ?>">
                                                    <small class="label bg-red" style="margin-right: 15px">Cancel</small>
                                                </a>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID #</th>
                                    <th>Customer</th>
                                    <th>Total Devices</th>
                                    <th>Order Value</th>
                                    <th>Discount</th>
                                    <th>Paid Amount.</th>
                                    <th>Created At</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


<div class="row">
    <div class="card">
        <div class="card-body">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            </div>
            <!-- /.col -->
            <div class="col-xs-4 offset-md-2">
                <div class="table-responsive ">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width:50%">Total Order Value:</th>
                            <td>৳ <?php echo e($orders_value); ?></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Total Discount:</th>
                            <td>৳ <?php echo e($discount_value); ?></td>
                        </tr>
                        <tr>
                            <th>Advance Payment:</th>
                            <td>৳ <?php echo e($amount_paid); ?></td>
                        </tr>
                        <tr>
                            <th>Total Due:</th>
                            <td>৳ <?php echo e($orders_value - ($amount_paid + $discount_value)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
    <!-- /.col -->
        </div>
    </div>

</div>
</div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(function() {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[ 0, "desc" ]]
            })
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Office Project\dokan\resources\views/customer/customer_order.blade.php ENDPATH**/ ?>