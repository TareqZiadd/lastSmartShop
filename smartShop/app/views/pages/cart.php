<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="hero-wrap hero-bread" style="background-image: url(<?php echo URLROOT; ?>/images/post-item7.jpg)">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Wishlist</h1>
            </div>
        </div>
    </div>
</div>

<?php var_dump($data) ?>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <?php 
                    $total = 0; 
                    if (!empty($data['carts'])): 
                        foreach ($data['carts'] as $cart) {
                            $total += $cart->price * $cart->quantity; 
                        }
                    endif;
                    ?>
                    <form action="<?php echo URLROOT; ?>/carts/checkout" method="post">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['carts'])): ?>
                                    <?php foreach ($data['carts'] as $cart): ?>
                                        <tr class="text-center">
                                            <td class="product-remove">
                                                <a href="<?php echo URLROOT . "/carts/delById/" . $cart->product_id; ?>">
                                                    <span class="ion-ios-close"></span> DELETE
                                                </a>
                                            </td>
                                            <td class="image-prod">
                                                <div class="img" style="background-image:url(<?php echo URLROOT; ?>/images/banner-image.png);"></div>
                                            </td>
                                            <td class="product-name">
                                                <h3><?php echo $cart->name; ?></h3>
                                            </td>
                                            <td class="price">$<?php echo number_format($cart->price, 2); ?></td>
                                            <td class="quantity">
                                                <input type="hidden" name="products[<?php echo $cart->product_id; ?>][product_id]" value="<?php echo $cart->product_id; ?>">
                                                <select name="products[<?php echo $cart->product_id; ?>][quantity]" class="form-control quantity-select" data-price="<?php echo $cart->price; ?>">
                                                    <?php for ($i = 1; $i <= $cart->quantity; $i++): ?>
                                                        <option value="<?php echo $i; ?>" <?php echo ($i == $cart->quantity) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                            <td class="total">$<span class="product-total"><?php echo number_format($cart->price * $cart->quantity, 2); ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No items in cart</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="row justify-content-start">
                            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                                <div class="cart-total mb-3">
                                    <h3>Cart Totals</h3>
                                    <p class="d-flex">
                                        <span>Subtotal</span>
                                        <span id="cart-subtotal">$<?php echo number_format($total, 2); ?></span>
                                    </p>
                                </div>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // تحديث إجمالي المنتج بناءً على الكمية المحددة
    function updateProductTotal(selectElement) {
        const quantity = parseInt(selectElement.value) || 0;
        const price = parseFloat(selectElement.dataset.price);
        const productTotalElement = selectElement.closest('tr').querySelector('.product-total');
        const productTotal = (quantity * price).toFixed(2);

        productTotalElement.innerText = productTotal;

        updateGrandTotal();
    }

    // تحديث الإجمالي العام للسب توتال
    function updateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.product-total').forEach(function(totalElement) {
            let total = parseFloat(totalElement.innerText);
            grandTotal += total;
        });
        document.getElementById('cart-subtotal').innerText = `$${grandTotal.toFixed(2)}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // تحديث الإجمالي العام عند تحميل الصفحة
        updateGrandTotal();

        // إضافة مراقب لتغيير الكمية في جميع الحقول
        document.querySelectorAll('.quantity-select').forEach(function(selectElement) {
            // تعيين قيمة عشوائية خلال أول 3 ثوانٍ
            setTimeout(function() {
                const options = selectElement.querySelectorAll('option');
                const randomIndex = Math.floor(Math.random() * options.length);
                selectElement.value = options[randomIndex].value;
                updateProductTotal(selectElement);
            }, 3000);

            // تعيين القيمة إلى 1 بعد 3 ثوانٍ
            setTimeout(function() {
                selectElement.value = 1;
                updateProductTotal(selectElement);
            }, 3000);
            
            selectElement.addEventListener('change', function() {
                updateProductTotal(selectElement);
            });
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
