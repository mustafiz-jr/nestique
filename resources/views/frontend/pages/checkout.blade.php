@extends('frontend.layouts.app')

@section('css')
    <style>
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
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
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

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .StripeElement--focus {
            border-bottom: 1px solid var(--color-accent);
        }

        .StripeElement--invalid {
            border-bottom: 1px solid #e74c3c;
        }

        .card-errors {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }

        .coupon-success {
            color: #27ae60;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .coupon-error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="nestique-checkout-page">
        <div class="nestique-checkout-container">
            <h1 class="nestique-checkout-header">Checkout</h1>
            <div class="nestique-checkout-layout">
                <div class="nestique-checkout-form-column">
                    <h2>Shipping Address</h2>
                    <form action="" method="POST" id="checkout-form">
                        @csrf
                        {{-- HIDDEN INPUT FOR STRIPE TOKEN --}}
                        <input type="hidden" id="stripe-token-id" name="stripe_token">
                        {{-- HIDDEN INPUTS TO PASS CALCULATED PRICE TO CONTROLLER --}}
                        <input type="hidden" id="shipping-price-input" name="shipping_price"
                            value="{{ $shippingMethods->first()->price ?? 0.0 }}">
                        <input type="hidden" id="total-price-input" name="total_price"
                            value="{{ number_format(str_replace(',', '', $subtotal) + ($shippingMethods->first()->price ?? 0.0), 2, '.', '') }}">
                        {{-- END HIDDEN INPUTS --}}

                        <div class="nestique-form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email"
                                value="{{ $customer->email }}" required>
                            <div class="error-message" id="email-error">Please enter a valid
                                email address</div>
                        </div>
                        <div class="nestique-form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option {{ $customer->country == 'usa' ? 'selected' : '' }} value="usa">United States
                                </option>
                                <option {{ $customer->country == 'canada' ? 'selected' : '' }} value="canada">Canada
                                </option>
                                <option {{ $customer->country == 'uk' ? 'selected' : '' }} value="uk">United Kingdom
                                </option>
                                <option {{ $customer->country == 'Bangladesh' ? 'selected' : '' }} value="bangladesh">
                                    Bangladesh</option>
                            </select>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $customer->name }}"
                                    placeholder="Name" required>
                                <div class="error-message" id="name-error">Please enter your
                                    name</div>
                            </div>
                            <div>
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" value="{{ $customer->address }}"
                                    placeholder="Address" required>
                                <div class="error-message" id="address-error">Please enter
                                    your address</div>
                            </div>
                        </div>
                        <div class="nestique-form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="{{ $customer->city }}"
                                placeholder="City" required>
                            <div class="error-message" id="city-error">Please enter your city
                            </div>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="zip-code">Zip Code</label>
                                <input type="text" id="zip-code" name="zip" value="{{ $customer->zip }}"
                                    placeholder="Zip Code" required>
                                <div class="error-message" id="zip-error">Please enter your
                                    zip code</div>
                            </div>
                            <div>
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ $customer->phone }}"
                                    placeholder="Phone" required>
                                <div class="error-message" id="phone-error">Please enter
                                    your phone number</div>
                            </div>
                        </div>
                        <div class="gap-1 fw-bold d-flex">
                            <input type="checkbox" id="save-info" name="save-info">
                            <label class="save-info" for="save-info">Save this information for
                                next time</label>
                        </div>
                        <div class="nestique-form-separator"></div>
                        <h2>Shipping Method</h2>
                        <div class="nestique-form-group nestique-shipping-options">
                            @foreach ($shippingMethods as $method)
                                <div class="radio-option">
                                    <input type="radio" id="shipping-{{ $method->id }}" name="shipping-method"
                                        value="{{ $method->name }}" data-price="{{ $method->price }}"
                                        {{ $loop->first ? 'checked' : '' }}>
                                    <div class="details">
                                        <label for="shipping-{{ $method->id }}"
                                            class="h5">{{ $method->name }}</label>
                                        <p>{{ $method->duration }}</p>
                                    </div>
                                    <div class="price">
                                        ${{ number_format($method->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="nestique-form-separator"></div>
                        <h2>Payment Method</h2>
                        <div class="nestique-form-group nestique-payment-options">
                            <div class="radio-option">
                                <input onclick="setAction('stripe')" type="radio" id="payment-online"
                                    name="payment-method" value="online" checked>
                                <label for="payment-online">Online Payment (Stripe)</label>
                            </div>
                            <div class="radio-option">
                                <input onclick="setAction('cod')" type="radio" id="payment-cod" name="payment-method"
                                    value="cod">
                                <label for="payment-cod">Cash on Delivery (COD)</label>
                            </div>
                        </div>
                        <!-- Stripe Payment Details -->
                        <div id="online-payment-details" class="mb-4" style="display: block;">
                            <label for="card-element" class="form-label">Credit or Debit Card</label>
                            <div id="card-element" class="form-control py-3"></div>
                            <div id="card-errors" class="text-danger mt-2"></div>
                            <!-- Hidden Inputs -->
                            <input type="hidden" name="stripeToken" id="stripe-token-id">
                        </div>


                </div>

                <div class="nestique-order-summary-column">
                    <h3>Order Summary</h3>
                    @foreach ($cartItems as $item)
                        <div class="nestique-summary-item">
                            <img src="{{ asset($item->model->thumbnail) }}" alt="{{ $item->name }}">
                            <div class="nestique-summary-item-details">
                                <h4>{{ $item->name }}</h4>
                                <p>Qty: {{ $item->qty }}</p>
                            </div>
                            <div class="nestique-summary-item-price">
                                ${{ number_format($item->price, 2) }}</div>
                        </div>
                    @endforeach
                    <div class="nestique-form-group">
                        <label for="coupon">Coupon Code</label>
                        <input type="text" id="coupon" name="coupon_code" placeholder="COUPON CODE"
                            value="{{ session('applied_coupon') ? session('applied_coupon')['code'] : '' }}"
                            form="checkout-form">
                        @if (session('applied_coupon'))
                            <span class="coupon-success">Coupon applied: {{ session('applied_coupon')['code'] }}

                                (-${{ number_format(session('applied_coupon')['discount'], 2) }})</span>
                        @endif
                        @if (session('error'))
                            <span class="coupon-error">{{ session('error') }}</span>
                        @endif
                    </div>
                    <div class="nestique-form-separator"></div>
                    <div class="nestique-summary-line">
                        <span>Subtotal</span>
                        <span id="subtotal-price">${{ number_format(str_replace(',', '', $subtotal), 2) }}</span>
                    </div>
                    <div class="nestique-summary-line shipping">
                        <span>Shipping</span>
                        <span id="shipping-price">${{ number_format($shippingMethods->first()->price ?? 0.0, 2) }}</span>
                    </div>
                    <div class="nestique-summary-line total">
                        <span>Total</span>
                        <span
                            id="total-price">${{ number_format(str_replace(',', '', $subtotal) + ($shippingMethods->first()->price ?? 0.0), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('cart.show') }}" class="primary-btn px-3">
                            <span class="fas fa-arrow-left"></span>
                            Return to Cart
                        </a>
                        <button type="submit" class="secondary-btn px-5" id="checkout-button" form="checkout-form">
                            Place Order
                            <span class="fas fa-arrow-right"></span>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const STRIPE_PUBLISHABLE_KEY = "{{ env('STRIPE_KEY') }}";


        const checkoutForm = document.getElementById('checkout-form');
        const checkoutButton = document.getElementById('checkout-button');
        const cardErrors = document.getElementById('card-errors');
        const onlinePaymentDetails = document.getElementById('online-payment-details');
        const originalButtonText = checkoutButton.innerHTML;

        // Stripe Init: Card Element তৈরি ও মাউন্ট করা
        const stripe = Stripe(STRIPE_PUBLISHABLE_KEY);
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        // কার্ড ইনপুট Error হ্যান্ডেল করা
        cardElement.on('change', function(event) {
            cardErrors.textContent = event.error ? event.error.message : '';
        });

        // ===============================================
        // 💡 ফর্ম অ্যাকশন এবং UI লজিক - এখন এটি সব হ্যান্ডেল করবে
        // ===============================================

        function updatePaymentLogic() {
            // বর্তমানে নির্বাচিত পেমেন্ট মেথডটি খুঁজে বের করা
            const selectedMethod = document.querySelector('input[name="payment-method"]:checked').value;

            if (selectedMethod === 'online') {
                // Stripe-এর জন্য অ্যাকশন সেট করা এবং ডিটেইলস দেখানো
                checkoutForm.action = "{{ route('stripe.payment') }}";
                onlinePaymentDetails.style.display = 'block';
            } else if (selectedMethod === 'cod') {
                // COD-এর জন্য অ্যাকশন সেট করা এবং Stripe ডিটেইলস লুকানো
                checkoutForm.action = "{{ route('order') }}";
                onlinePaymentDetails.style.display = 'none';
            }
        }

        // পেজ লোডের সময় প্রাথমিক অ্যাকশন সেট করুন (যদি 'online' checked থাকে)
        document.addEventListener('DOMContentLoaded', updatePaymentLogic);

        // রেডিও বাটনে ক্লিক/চেঞ্জ হলে অ্যাকশন আপডেট করুন
        document.querySelectorAll('input[name="payment-method"]').forEach(input => {
            input.addEventListener('change', updatePaymentLogic);
        });

        // ===============================================
        // 🚀 ফর্ম সাবমিট হ্যান্ডেলার - 'selectedPaymentMethod' ফিক্সড!
        // ===============================================

        checkoutForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            checkoutButton.disabled = true;
            checkoutButton.innerHTML = 'Processing... <i class="fas fa-spinner fa-spin"></i>';

            // 🟢 ফিক্স: এখন ভ্যারিয়েবলটি ডিক্লেয়ার করা হয়েছে!
            const selectedPaymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

            if (selectedPaymentMethod === 'online') {
                // STRIPE পেমেন্টের লজিক 
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
                    document.getElementById('stripe-token-id').value = token.id;
                    checkoutForm.submit();
                }
            } else if (selectedPaymentMethod === 'cod') {
                checkoutForm.submit();
            }
        });
    </script>
@endsection
