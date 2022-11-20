<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                <h4><?php echo e($total_products); ?></h4>

                <p>Total Products</p>
                </div>
                <div class="icon">
                <i class="fa fa-camera"></i>
                </div>
                <a href="<?php echo e(route('products.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                <h4><?php echo e($total_customers); ?></h4>

                <p>Total Customers</p>
                </div>
                <div class="icon">
                <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo e(route('customers.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
        <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                <h4><?php echo e($bill_pending_paid_amount); ?>Tk</h4>

                <p>Total Payment Paid</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <a href="<?php echo e(route('customers.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h4><?php echo e($bill_pending_due_amount); ?>Tk</h4>

                    <p>Total Payment Due</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo e(route('customers.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                    <h4> <?php echo e($totalTransaction); ?> Tk  </h4>

                    <p>Total Transaction</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo e(route('customers.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                        <h4>Total <?php echo e($total_orders); ?></h4>

                        <p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-database" aria-hidden="true"></i>
                        </div>
                        <a href="<?php echo e(route('customers.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>



                <div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title text-danger">Products Alert</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        
                        <th>Title</th>
                        <th>Category</th>
                        
                        <th>Stock</th>
                        <th>SKU #</th>
                        
                        <th>Image</th>
                        <?php if((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 ): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e($product->title); ?></td>
                            <td><?php echo e($product->category ? $product->category->name : "No Category"); ?></td>
                            
                            <td> <span class="label bg-red">
                                <?php if($product->stock > 0): ?>
                                    <?php echo e($product->stock); ?>

                                <?php else: ?>
                                    <small class="label bg-red" style="">No Products Available</small>
                                <?php endif; ?>
                            </span>
                            </td>
                            <td><?php echo e($product->art_no); ?></td>
                            
                            <td>
                                <img src="<?php echo e(asset($product->image_path)); ?>" height="50" , width="50">
                            </td>
                            <?php if((Auth::user()->is_admin) == 1 || (Auth::user()->is_admin) == 2 ): ?>
                            <td>
                                <span class="">
                                    <a href="<?php echo e(route('stocks.add', $product->id)); ?>">
                                        <small class="label bg-green" style="margin-right: 15px">Add
                                            Stock</small>
                                    </a>
                                    <a href="<?php echo e(route('products.edit', $product->id)); ?>">
                                        <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                    </a>
                                    <a onclick="return confirm('Are you sure?')"
                                        href="<?php echo e(route('products.delete', $product->id)); ?>">
                                        <small class="label bg-red" style="margin-right: 15px">Delete</small>
                                    </a>
                                </span>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        
                        <th>Title</th>
                        <th>Category</th>
                        
                        <th>Stock</th>
                        <th>SKU #</th>
                        
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title text-success">Recent Sale</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        <th>Customer</th>
                        
                        
                        
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $cnt = 1
                    ?>
                    <?php $__currentLoopData = $order_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cnt++); ?></td>
                            <td><?php echo e($row->product); ?></td>
                            <td>
                                <?php
                                    $customer = DB::table('orders')->join('customers','orders.customer_id','customers.id')
                                                                    ->select('customers.name as customer')
                                                                    ->where('customers.id',$row->order)
                                                                    ->first();
                                ?>
                                <?php echo e($customer->customer); ?>

                            </td>
                            
                            
                            
                            
                            
                            
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        
                        
                        
                        
                        
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
    <script>
        $(function() {
            $('#example2').DataTable({
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

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dokan\resources\views/dashboard.blade.php ENDPATH**/ ?>