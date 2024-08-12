<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="hero-wrap hero-bread" style="background-image: url(<?php echo URLROOT; ?>/images/post-item7.jpg)">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">



                <form action="<?php echo URLROOT?>/carts/insertAdress" method="POST" class="billing-form">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <!-- Billing Details Form Fields -->
                    
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Shipping Adress</label>
                                <input type="text" class="form-control" name="shipping_address"required>
                                <input hidden type="text" name="total_amount" 
                                value="<?php echo $data['total']?>">
                            </div>
                        </div>

                      
                    </div>
                    <!-- Submit Button -->
                    <p><button type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                </form><!-- END -->

                <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total bg-light p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>
                           
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span><?php echo $data['total']?></span>
                            </p>
                        </div>
                    </div>
                  
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->

<?php require APPROOT . '/views/inc/footer.php'; ?>
