 <!-- Single Prodect -->
    <div class="product">
        <div class="thumb" style="background-color: #F7F8FA">
            <a href="<?php echo e(route('bundle', $bundle)); ?>" class="image">
                <img src="<?php echo e(asset('/assets/images/bundle/bundle_default_image.png')); ?>" alt="Product" height="300px" width="280px" style="object-fit: contain"/>
                <img class="hover-image" src="<?php echo e(asset('/assets/images/bundle/bundle_default_image.png')); ?>"
                     alt="Product"  height="270px" width="300px" style="object-fit: contain"/>
            </a>
            <span class="badges">
                                                    <span class="new">New</span>
                                                </span>
        </div>
        <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
            <h5 class="title"><a href="<?php echo e(route('bundle', $bundle)); ?>"><?php echo e($bundle->name); ?>

                </a>
            </h5>
            <span class="price">
                                                    <span class="new"> BDT <?php echo e($bundle->products()->sum('unit_price')); ?></span>
                                                </span>
        </div>
        <button title="Add To Cart" class=" add-to-cart">Add
            To Cart
        </button>
    </div>

<?php /**PATH C:\laragon\www\lens\resources\views/ecommerce/components/bundle-card.blade.php ENDPATH**/ ?>