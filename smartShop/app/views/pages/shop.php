<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="hero-wrap hero-bread" style="background-image: url(<?php echo URLROOT; ?>/images/post-item7.jpg)">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Shop</span></p>
                <h1 class="mb-0 bread">Shop</h1>
            </div>
        </div>
    </div>
</div>
<a href="<?php echo URLROOT ?>/product/add" style="background-color:rgba(72,71,71,0.01);margin-left:230px;border-radius: 13px;font-size: 22px" class="add-to-cart text-center py-2 mr-1"><span>Add Product </span></a>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($data['shops'] as $product): ?>
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch ftco-animate mb-4">
                    <div class="product <?php echo $product->cart_quantity > 0 ? 'dark-card' : ''; ?>">
                        <a href="#" class="img-prod">
                            <img class="img-fluid <?php echo $product->cart_quantity > 0 ? 'shadow-img' : ''; ?>" 
                                 src="<?php echo URLROOT; ?>/images/banner-image1.png" alt="Product Image">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <h3><?php echo $product->name; ?></h3>
                            <h3><a href="#"><?php echo "Price: " . $product->price . " JD"; ?></a></h3>
                            <div class="pricing">
                                <p class="price"><span><?php echo $product->description . ' - ' . $product->quantity . ' available'; ?></span></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <form action="<?php echo URLROOT; ?>/carts/insertCart" method="POST" class="bottom-area d-flex px-3">
                                    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $product->name; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $product->price; ?>">
                                    <input type="hidden" name="product_quantity" value="<?php echo $product->quantity; ?>">
                                    <button type="submit" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></button>
                                </form>
                                <a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="ftco-gallery">
    <!-- Instagram section -->
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
