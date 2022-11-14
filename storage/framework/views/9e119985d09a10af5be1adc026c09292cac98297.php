<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php if(Session::has('product_delete_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>">
                        <?php echo e(Session::get('product_delete_message')); ?></p>
                    <?php echo e(Session::forget('product_delete_message')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Damage Products</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>SKU #</th>
                                    <th>Loss Amount</th>
                                    <th>Damage Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($cnt++); ?></td>
                                        <td><?php echo e($product->product_name); ?></td>
                                        
                                        <td><?php echo e($product->category); ?></td>
                                        

                                        </td>
                                        <td>
                                            <?php echo e($product->quantity); ?>

                                        </td>
                                        <td><?php echo e($product->sku); ?></td>
                                        <td><?php echo e($product->loss_amount); ?></td>
                                        <td><?php echo e($product->damage_note); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>SKU #</th>
                                    <th>Loss Amount</th>
                                    <th>Damage Note</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
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

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Office Project\dokan\resources\views/report/damage_index.blade.php ENDPATH**/ ?>