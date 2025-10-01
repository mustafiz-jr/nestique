<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (optional for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>

        <!-- Checkout Form -->
        <form id="checkout-form" method="POST" action="/your-backend-endpoint">
            <!-- Replace action with your backend endpoint -->

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Payment Method Selection -->
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <div>
                    <label class="me-3">
                        <input type="radio" id="payment-online" name="payment-method" value="online" checked>
                        Online (Stripe)
                    </label>
                    <label>
                        <input type="radio" id="payment-cod" name="payment-method" value="cod">
                        Cash on Delivery
                    </label>
                </div>
            </div>

            <!-- Stripe Payment Details -->
            <div id="online-payment-details" class="mb-4" style="display: block;">
                <label for="card-element" class="form-label">Credit or Debit Card</label>
                <div id="card-element" class="form-control py-3"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" name="stripeToken" id="stripe-token-id">

            <!-- Submit Button -->
            <button id="checkout-button" class="btn btn-primary w-100" type="submit">
                Pay Now
            </button>
        </form>
    </div>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const checkoutForm = document.getElementById('checkout-form');
        const checkoutButton = document.getElementById('checkout-button');
        const cardErrors = document.getElementById('card-errors');
        const stripeTokenInput = document.getElementById('stripe-token-id');
        const onlinePaymentDetails = document.getElementById('online-payment-details');
        const originalButtonText = checkoutButton.innerHTML;

        // Stripe Init (⚠️ Replace with your real publishable key)
        const stripe = Stripe("pk_test_1234567890ABCDEFG");
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        // Handle errors in real-time
        cardElement.on('change', function(event) {
            cardErrors.textContent = event.error ? event.error.message : '';
        });

        // Payment method toggle (COD vs Stripe)
        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
            input.addEventListener('change', function() {
                onlinePaymentDetails.style.display = (this.value === 'online') ? 'block' : 'none';
            });
        });

        // Form submit handler
        checkoutForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            checkoutButton.disabled = true;
            checkoutButton.innerHTML = 'Processing... <i class="fas fa-spinner fa-spin"></i>';

            const selectedPaymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

            if (selectedPaymentMethod === 'online') {
                const {
                    token,
                    error
                } = await stripe.createToken(cardElement, {
                    name: document.getElementById('name').value,
                });

                if (error) {
                    cardErrors.textContent = error.message;
                    checkoutButton.disabled = false;
                    checkoutButton.innerHTML = originalButtonText;
                } else {
                    stripeTokenInput.value = token.id;
                    checkoutForm.submit();
                }
            } else {
                checkoutForm.submit();
            }
        });
    </script>
</body>

</html>
