<?php $__env->startSection('content'); ?>
    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <!-- Swiper -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto" src="<?php echo e(env('app_url')); ?><?php echo e(substr($product->image_path, 6)); ?>"
                                     alt="">
                            </div>
















                        </div>
                    </div>
























                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content ml-25px">
                        <h2><?php echo e($product->title); ?></h2>
                        <div class="pricing-meta">
                            <ul class="d-flex">
                                <li class="new-price"> BDT <?php echo e($product->unit_price); ?></li>
                            </ul>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">( 2 Review )</a></span>
                        </div>
                        <div class="stock mt-30px">
                            <span class="avallabillty">Availability:
                                <?php if($product->stock > 0): ?>
                                    <span class="in-stock"><i
                                            class="fa fa-check"></i>In Stock</span></span>
                            <?php endif; ?>
                        </div>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="number" name="qtybutton" value="1"/>
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart"> Add To
                                    Cart
                                </button>
                            </div>

                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Category: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="<?php echo e(route('shopByCategory', $product->category)); ?>"><?php echo e($product->category ? $product->category->name : "No Category"); ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">







                            <?php echo e($product->description); ?>



                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>

                               <?php echo e($product->description); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('ecommerce.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\lens\resources\views/ecommerce/product-details.blade.php ENDPATH**/ ?>