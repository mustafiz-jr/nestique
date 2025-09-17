@extends('frontend.layouts.app')

@section('css')
    <style>
        /* All your CSS styles */
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
    </style>
@endsection

@section('content')
    <div class="nestique-checkout-page">
        <div class="nestique-checkout-container">
            <h1 class="nestique-checkout-header">Checkout</h1>
            <div class="nestique-checkout-layout">
                <div class="nestique-checkout-form-column">
                    <h2>Shipping Address</h2>
                    <form action="{{ route('order') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="nestique-form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email"
                                value="{{ $customer->email }}" required>
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
                                    placeholder="name" required>
                            </div>
                            <div>
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" value="{{ $customer->address }}"
                                    placeholder="Address" required>
                            </div>
                        </div>
                        <div class="nestique-form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="{{ $customer->city }}"
                                placeholder="City" required>
                        </div>
                        <div class="nestique-form-group form-row">
                            <div>
                                <label for="zip-code">Zip Code</label>
                                <input type="text" id="zip-code" name="zip" value="{{ $customer->zip }}"
                                    placeholder="Zip Code" required>
                            </div>
                            <div>
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ $customer->phone }}"
                                    placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="gap-1 fw-bold d-flex">
                            <input type="checkbox" id="save-info" name="save-info">
                            <label class="save-info" for="save-info">Save this information for next time</label>
                        </div>
                        <div class="nestique-form-separator"></div>
                        <h2>Shipping Method</h2>
                        <div class="nestique-form-group nestique-shipping-options">
                            @foreach ($shippingMethods as $method)
                                <div class="radio-option {{ $loop->first ? 'selected' : '' }}">
                                    <input type="radio" id="shipping-{{ $method->id }}" name="shipping-method"
                                        value="{{ $method->name }}" data-price="{{ $method->price }}"
                                        {{ $loop->first ? 'checked' : '' }}>
                                    <div class="details">
                                        <label for="shipping-{{ $method->id }}"
                                            class="h5">{{ $method->name }}</label>
                                        <p>{{ $method->duration }}</p>
                                    </div>
                                    <div class="price">${{ number_format($method->price, 2) }}</div>
                                </div>
                            @endforeach
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
                            <div class="nestique-summary-item-price">${{ number_format($item->price, 2) }}</div>
                        </div>
                    @endforeach
                    <div class="nestique-form-group form-row">
                        <label for="coupon">coupon</label>
                        <input type="text" id="coupon" placeholder="COUPON">
                    </div>
                    <div class="nestique-form-separator"></div>
                    <div class="nestique-summary-line">
                        <span>Subtotal</span>
                        <span id="subtotal-price">${{ number_format(str_replace(',', '', $subtotal), 2) }}</span>
                    </div>
                    <div class="nestique-summary-line shipping">
                        <span>Shipping</span>
                        <span id="shipping-price">${{ number_format($shippingMethods->first()->price, 2) }}</span>
                    </div>
                    <div class="nestique-summary-line total">
                        <span>Total</span>
                        <span
                            id="total-price">${{ number_format(str_replace(',', '', $subtotal) + ($shippingMethods->first()->price ?? 0.0), 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.show') }}" class="primary-btn px-3">
                            <span class="fas fa-arrow-left"></span>
                            Return to Cart
                        </a>
                        <button type="submit" class="secondary-btn px-5" id="checkout-button">
                            Place Order
                            <span class="fas fa-arrow-right"></span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle payment details based on payment method
            const onlinePayment = document.getElementById('payment-online');
            const codPayment = document.getElementById('payment-cod');
            const paymentDetails = document.getElementById('online-payment-details');

            function togglePaymentDetails() {
                if (onlinePayment.checked) {
                    paymentDetails.style.display = 'block';
                    // Make card fields required for online payment
                    document.getElementById('card-number').setAttribute('required', 'true');
                    document.getElementById('exp-date').setAttribute('required', 'true');
                    document.getElementById('cvv').setAttribute('required', 'true');
                } else {
                    paymentDetails.style.display = 'none';
                    // Remove required attribute for COD
                    document.getElementById('card-number').removeAttribute('required');
                    document.getElementById('exp-date').removeAttribute('required');
                    document.getElementById('cvv').removeAttribute('required');
                }
            }

            onlinePayment.addEventListener('change', togglePaymentDetails);
            codPayment.addEventListener('change', togglePaymentDetails);

            // Initialize on page load
            togglePaymentDetails();

            // Shipping method selection
            const shippingOptions = document.querySelectorAll('.nestique-shipping-options .radio-option');
            shippingOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    shippingOptions.forEach(opt => opt.classList.remove('selected'));
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    // Check the radio button
                    this.querySelector('input[type="radio"]').checked = true;
                });
            });

            // Payment method selection
            const paymentOptions = document.querySelectorAll('.nestique-payment-options .radio-option');
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    // Check the radio button
                    this.querySelector('input[type="radio"]').checked = true;
                    // Toggle payment details
                    togglePaymentDetails();
                });
            });

            // Form validation
            const form = document.getElementById('checkout-form');
            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Basic validation for required fields
                const requiredFields = [{
                        id: 'email',
                        error: 'email-error'
                    },
                    {
                        id: 'name',
                        error: 'name-error'
                    },
                    {
                        id: 'address',
                        error: 'address-error'
                    },
                    {
                        id: 'city',
                        error: 'city-error'
                    },
                    {
                        id: 'zip-code',
                        error: 'zip-error'
                    },
                    {
                        id: 'phone',
                        error: 'phone-error'
                    }
                ];

                requiredFields.forEach(field => {
                    const input = document.getElementById(field.id);
                    const error = document.getElementById(field.error);

                    if (!input.value.trim()) {
                        error.style.display = 'block';
                        isValid = false;
                    } else {
                        error.style.display = 'none';
                    }
                });

                // Additional validation for online payment
                if (onlinePayment.checked) {
                    const cardNumber = document.getElementById('card-number');
                    const expDate = document.getElementById('exp-date');
                    const cvv = document.getElementById('cvv');

                    if (!cardNumber.value.trim()) {
                        document.getElementById('card-error').style.display = 'block';
                        isValid = false;
                    } else {
                        document.getElementById('card-error').style.display = 'none';
                    }

                    if (!expDate.value.trim()) {
                        document.getElementById('exp-error').style.display = 'block';
                        isValid = false;
                    } else {
                        document.getElementById('exp-error').style.display = 'none';
                    }

                    if (!cvv.value.trim()) {
                        document.getElementById('cvv-error').style.display = 'block';
                        isValid = false;
                    } else {
                        document.getElementById('cvv-error').style.display = 'none';
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to the first error
                    const firstError = document.querySelector('.error-message[style="display: block"]');
                    if (firstError) {
                        firstError.closest('.nestique-form-group').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        });
    </script>
@endsection
