

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
        <?php if(Session::has('message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>">
                        <!-- <?php echo e(Session::get('product_add_message')); ?> -->
                        <?php echo e(Session('message')); ?>

                    </p>
                    <!-- <?php echo e(Session::forget('product_add_message')); ?> -->
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-horizontal" id="formId" action="<?php echo e(route('update.category',$category->id)); ?>"
                                  method="POST"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id">
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" style="" role="alert">
                                                <strong style="color: red">* <?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                        <label for="title" class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php echo e($category->name); ?>" id="name" name="name" required>
                                        </div>
                                    </div>
                                    
                                    

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success pull-right" id="submitId"
                                            style="padding-left: 40px; padding-right: 40px">Update
                                    </button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Office Project\dokan\resources\views/product/edit_category.blade.php ENDPATH**/ ?>