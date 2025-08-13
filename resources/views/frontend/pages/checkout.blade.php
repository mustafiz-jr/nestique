@extends('frontend.layouts.app')
@section('css')
    <style>
        /* Main Container */
        .nestique-checkout-page {
            padding: 40px 20px;
            background-color: var(--color-light);
        }

        .nestique-checkout-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .nestique-checkout-header {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-dark);
            margin-bottom: 40px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Main Layout */
        .nestique-checkout-layout {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 40px;
        }

        /* Form Column */
        .nestique-checkout-form-column,
        .nestique-order-summary-column {
            background-color: var(--color-primary);
            padding: 30px;
            border-radius: 12px;
        }

        .nestique-checkout-form-column h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .nestique-form-group {
            margin-bottom: 20px;
        }

        .nestique-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        /* Updated input field styling */
        .nestique-form-group input,
        .nestique-form-group select {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-bottom: 1px solid #ccc;
            background-color: transparent;
            border-radius: 0;
            font-family: var(--primary-font);
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .nestique-form-group input:focus,
        .nestique-form-group select:focus {
            outline: none;
            border-bottom: 1px solid var(--color-accent);
        }

        /* Updated gap for form rows */
        .nestique-form-group .form-row {
            display: flex;
            gap: 20px;
            /* Adjusted gap for a more professional look */
        }

        .nestique-form-group .form-row>* {
            flex-grow: 1;
        }

        .nestique-form-group .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .nestique-form-group .checkbox-container input {
            width: auto;
        }

        .nestique-form-group .checkbox-container label {
            margin: 0;
            font-weight: 400;
        }

        .nestique-form-separator {
            border-top: 1px solid #e0e0e0;
            margin: 30px 0;
        }

        /* Shipping options */
        .nestique-shipping-options .radio-option,
        .nestique-payment-options .radio-option {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nestique-shipping-options .radio-option:hover,
        .nestique-shipping-options .radio-option.selected,
        .nestique-payment-options .radio-option:hover,
        .nestique-payment-options .radio-option.selected {
            background-color: #e9e9e9;
            border-color: var(--color-accent);
        }

        .nestique-shipping-options input[type="radio"],
        .nestique-payment-options input[type="radio"] {
            margin-right: 15px;
            width: auto;
        }

        .nestique-shipping-options .details,
        .nestique-payment-options .details {
            flex-grow: 1;
        }

        .nestique-shipping-options .details h4,
        .nestique-payment-options .details h4 {
            margin: 0;
            font-weight: 600;
        }

        .nestique-shipping-options .details p,
        .nestique-payment-options .details p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Payment icons */
        .nestique-payment-icons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .nestique-payment-icons i {
            font-size: 2rem;
            color: #ccc;
        }

        .nestique-payment-details-container {
            display: none;
        }

        /* Call to Action Button */
        .nestique-checkout-btn {
            display: block;
            width: 100%;
            text-align: center;
            background: var(--color-accent);
            color: var(--color-light);
            padding: 15px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 30px;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .secondary-btn:hover {
            background: var(--color-accent);
            color: white;
        }

        .nestique-checkout-btn:hover {
            background-color: var(--color-secondary);
        }

        .nestique-checkout-btn span {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        .nestique-back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--color-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nestique-back-link:hover {
            color: var(--color-secondary);
        }

        /* Order Summary Column */
        .nestique-order-summary-column {
            background-color: var(--color-primary);
            padding: 30px;
            border-radius: 12px;
            height: fit-content;
        }

        .nestique-order-summary-column h3 {
            font-family: var(--primary-font);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        .nestique-summary-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 15px;
            /* Added padding to separate border */
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            /* Added bottom border */
        }

        /* Remove border from the last summary item for a cleaner look */
        .nestique-summary-item:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .nestique-summary-item img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .nestique-summary-item-details {
            flex-grow: 1;
        }

        .nestique-summary-item-details h4 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }

        .nestique-summary-item-details p {
            font-size: 0.8rem;
            color: #666;
            margin: 0;
        }

        .nestique-summary-item-price {
            font-weight: 700;
        }

        .save-info {
            color: var(--color-accent) !important;
        }

        .nestique-summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .nestique-summary-line.total {
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .nestique-summary-line.shipping span:last-child {
            color: var(--color-accent);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .nestique-checkout-layout {
                grid-template-columns: 1fr;
            }

            .nestique-checkout-header {
                font-size: 2rem;
            }

            .nestique-checkout-form-column {
                order: 2;
            }

            .nestique-order-summary-column {
                order: 1;
            }
        }

        @media (max-width: 576px) {
            .nestique-checkout-header {
                font-size: 1.8rem;
                text-align: center;
            }

            .nestique-checkout-page {
                padding: 20px 10px;
            }

            .nestique-form-group .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="nestique-checkout-page">
        <div class="nestique-checkout-container">
            <h1 class="nestique-checkout-header">Checkout</h1>
            <div class="nestique-checkout-layout">
                <!-- Checkout Form Column -->
                <div class="nestique-checkout-form-column">
                    <h2>Shipping Address</h2>
                    <form>
                        <div class="nestique-form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="nestique-form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option value="usa">United States</option>
                                <option value="canada">Canada</option>
                                <option value="uk">United Kingdom</option>
                            </select>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="first-name">First name</label>
                                <input type="text" id="first-name" name="first-name" placeholder="First name" required>
                            </div>
                            <br>
                            <div>
                                <label for="last-name">Last name</label>
                                <input type="text" id="last-name" name="last-name" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="nestique-form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" placeholder="Address" required>
                        </div>
                        <div class="nestique-form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="City" required>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="postal-code">Postal Code</label>
                                <input type="text" id="postal-code" name="postal-code" placeholder="Postal Code"
                                    required>
                            </div>
                            <br>
                            <div>
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="gap-1 fw-bold d-flex">
                            <input type="checkbox" id="save-info" name="save-info">
                            <label class="save-info" for="save-info">Save this information for next time</label>
                        </div>
                    </form>

                    <div class="nestique-form-separator"></div>

                    <h2>Shipping Method</h2>
                    <div class="nestique-form-group nestique-shipping-options">
                        <div class="radio-option selected">
                            <input type="radio" id="shipping-standard" name="shipping-method" value="standard"
                                data-price="5.00" checked>
                            <div class="details">
                                <label for="shipping-standard" class="h5">Standard Shipping</label>
                                <p>5-7 business days</p>
                            </div>
                            <div class="price">$5.00</div>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="shipping-express" name="shipping-method" value="express"
                                data-price="20.00">
                            <div class="details">
                                <label for="shipping-express" class="h5">Express Shipping</label>
                                <p>1-2 business days</p>
                            </div>
                            <div class="price">$20.00</div>
                        </div>
                    </div>

                    <div class="nestique-form-separator"></div>

                    <h2>Payment Method</h2>
                    <div class="nestique-form-group nestique-payment-options">
                        <div class="radio-option selected">
                            <input type="radio" id="payment-online" name="payment-method" value="online" checked>
                            <div class="details">
                                <label for="payment-online">Online Payment</label>
                            </div>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="payment-cod" name="payment-method" value="cod">
                            <div class="details">
                                <label for="payment-cod">Cash on Delivery (COD)</label>
                            </div>
                        </div>
                    </div>

                    <div id="online-payment-details" class="nestique-payment-details-container">
                        <div class="nestique-form-separator"></div>
                        <h2>Payment Details</h2>
                        <div class="nestique-form-group">
                            <label for="card-number">Card Number</label>
                            <div class="nestique-payment-icons">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-amex"></i>
                                <i class="fab fa-cc-discover"></i>
                            </div>
                            <input type="text" id="card-number" name="card-number" placeholder="Card Number"
                                required>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="exp-date">Expiration Date</label>
                                <input type="text" id="exp-date" name="exp-date" placeholder="MM/YY" required>
                            </div>
                            <div>
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart') }}" class="primary-btn px-3 ">
                            <span class="fas fa-arrow-left"></span>
                            Return to Cart
                        </a>
                        <button type="submit" class="secondary-btn px-5" id="checkout-button">
                            Pay now
                            <span class="fas fa-arrow-right"></span>
                        </button>
                    </div>

                </div>

                <!-- Order Summary Column -->
                <div class="nestique-order-summary-column">
                    <h3>Order Summary</h3>

                    <div class="nestique-summary-item">
                        <img src="https://placehold.co/60x60/ac8e51/ffffff?text=Hat" alt="Gradient Graphic T-shirt">
                        <div class="nestique-summary-item-details">
                            <h4>Gradient Graphic T-shirt</h4>
                            <p>x1</p>
                        </div>
                        <div class="nestique-summary-item-price">$145</div>
                    </div>

                    <div class="nestique-summary-item">
                        <img src="https://placehold.co/60x60/415E72/ffffff?text=Shirt" alt="Checkered Shirt">
                        <div class="nestique-summary-item-details">
                            <h4>Checkered Shirt</h4>
                            <p>x1</p>
                        </div>
                        <div class="nestique-summary-item-price">$180</div>
                    </div>

                    <div class="nestique-summary-item">
                        <img src="https://placehold.co/60x60/222222/ffffff?text=Jeans" alt="Skinny Fit Jeans">
                        <div class="nestique-summary-item-details">
                            <h4>Skinny Fit Jeans</h4>
                            <p>x1</p>
                        </div>
                        <div class="nestique-summary-item-price">$240</div>
                    </div>

                    <div class="nestique-form-separator"></div>

                    <div class="nestique-summary-line">
                        <span>Subtotal</span>
                        <span id="subtotal-price">$565</span>
                    </div>
                    <div class="nestique-summary-line shipping">
                        <span>Shipping</span>
                        <span id="shipping-price">$5.00</span>
                    </div>
                    <div class="nestique-summary-line total">
                        <span>Total</span>
                        <span id="total-price">$570.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const shippingOptions = document.querySelectorAll('input[name="shipping-method"]');
            const paymentOptions = document.querySelectorAll('input[name="payment-method"]');
            const onlinePaymentDetails = document.getElementById('online-payment-details');
            const subtotalPrice = 565; // This should be dynamic based on your cart

            const shippingPriceElement = document.getElementById('shipping-price');
            const totalPriceElement = document.getElementById('total-price');
            const checkoutButton = document.getElementById('checkout-button');

            const updateSummary = () => {
                let selectedShippingPrice = 0;
                let shippingIsFree = false;

                // Update shipping price based on selection
                const selectedShipping = document.querySelector('input[name="shipping-method"]:checked');
                if (selectedShipping) {
                    selectedShippingPrice = parseFloat(selectedShipping.getAttribute('data-price'));
                }

                // Check if COD is selected, shipping becomes free
                const selectedPayment = document.querySelector('input[name="payment-method"]:checked');
                if (selectedPayment && selectedPayment.value === 'cod') {
                    shippingIsFree = true;
                }

                const currentShippingCost = shippingIsFree ? 0 : selectedShippingPrice;
                const newTotal = subtotalPrice + currentShippingCost;

                // Update text content
                shippingPriceElement.textContent = shippingIsFree ? 'Free' :
                    `$${currentShippingCost.toFixed(2)}`;
                totalPriceElement.textContent = `$${newTotal.toFixed(2)}`;
            };

            const togglePaymentDetails = () => {
                const selectedPayment = document.querySelector('input[name="payment-method"]:checked');
                if (selectedPayment && selectedPayment.value === 'online') {
                    onlinePaymentDetails.style.display = 'block';
                    checkoutButton.textContent = 'Pay now';
                } else {
                    onlinePaymentDetails.style.display = 'none';
                    checkoutButton.textContent = 'Place Order';
                }
                updateSummary();
            };

            shippingOptions.forEach(option => {
                option.addEventListener('change', () => {
                    document.querySelectorAll('.nestique-shipping-options .radio-option').forEach(
                        el => el.classList.remove('selected'));
                    option.closest('.radio-option').classList.add('selected');
                    updateSummary();
                });
            });

            paymentOptions.forEach(option => {
                option.addEventListener('change', () => {
                    document.querySelectorAll('.nestique-payment-options .radio-option').forEach(
                        el => el.classList.remove('selected'));
                    option.closest('.radio-option').classList.add('selected');
                    togglePaymentDetails();
                });
            });

            // Initial call to set the correct state on page load
            togglePaymentDetails();
        });
    </script>
@endsection
