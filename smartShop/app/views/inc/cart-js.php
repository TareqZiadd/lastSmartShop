<script>
    document.addEventListener('DOMContentLoaded', function() {
        let quantityInputs = document.querySelectorAll('.quantity input');
        
        function updateGrandTotal() {
            let grandTotal = 0;
            let rows = document.querySelectorAll('.cart-list tbody tr');
            rows.forEach(function(row) {
                let total = parseFloat(row.querySelector('.total').innerText.replace('$', ''));
                if (!isNaN(total)) {
                    grandTotal += total;
                }
            });
            document.querySelector('#grand-total').innerText = '$' + grandTotal.toFixed(2);
            document.querySelector('#subtotal').innerText = '$' + grandTotal.toFixed(2);
        }

        quantityInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                let price = parseFloat(this.closest('tr').querySelector('.price').innerText.replace('$', ''));
                let quantity = parseInt(this.value);
                
                // تأكد من أن الكمية صالحة
                if (isNaN(quantity) || quantity <= 0) {
                    quantity = 0;
                }

                let total = price * quantity;
                
                // تأكد من أن الإجمالي ليس NaN
                if (isNaN(total)) {
                    total = 0;
                }

                this.closest('tr').querySelector('.total').innerText = '$' + total.toFixed(2);

                updateGrandTotal();
            });
        });

        updateGrandTotal();
    });
</script>



