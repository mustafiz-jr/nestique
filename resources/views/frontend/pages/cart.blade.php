@extends('frontend.layouts.app')
@section('css')
    <style>
        :root {
            --color-primary: #F5F5F5;
            --color-secondary: #ac8e51;
            --color-accent: #415E72;
            --color-tertiary: #FFA673;
            --color-dark: #222222;
            --color-light: #FFFFFF;


            --primary-font: "Inter", sans-serif;
            --secondary-font: "Playfair Display", serif;
            --logo-font: "Mr Dafoe", cursive;
        }



        /* Main Container */
        .nestique-cart-page {
            padding: 40px 20px;
            background-color: var(--color-light);
        }

        .nestique-cart-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .nestique-cart-header {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-dark);
            margin-bottom: 40px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Main Layout */
        .nestique-cart-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        /* Cart Items Column */
        .nestique-cart-items-column {
            background-color: var(--color-primary);
            padding: 30px;
            border-radius: 12px;
        }

        /* Individual Cart Item */
        .nestique-cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .nestique-cart-item:last-child {
            border-bottom: none;
        }

        .nestique-cart-item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        .nestique-cart-item-details {
            flex-grow: 1;
        }

        .nestique-cart-item-details h4 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .nestique-cart-item-details p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .nestique-cart-item-price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--color-dark);
            margin-top: 10px;
        }

        .nestique-cart-item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nestique-quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 50px;
            overflow: hidden;
            background-color: var(--color-light);
        }

        .nestique-quantity-btn {
            background: none;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 1rem;
            color: var(--color-accent);
            transition: background-color 0.2s ease;
        }

        .nestique-quantity-btn:hover {
            background-color: #ddd;
        }

        .nestique-quantity-input {
            width: 30px;
            text-align: center;
            border: none;
            background: none;
            font-family: var(--primary-font);
            -moz-appearance: textfield;
        }

        .nestique-quantity-input::-webkit-outer-spin-button,
        .nestique-quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .nestique-remove-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #d9534f;
            font-size: 1.2rem;
            transition: color 0.2s ease;
        }

        .nestique-remove-btn:hover {
            color: #c9302c;
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

        .nestique-summary-line.discount span:last-child {
            color: #d9534f;
        }

        .nestique-promo-form {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        .nestique-promo-input {
            flex-grow: 1;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-family: var(--primary-font);
            font-size: 1rem;
        }

        .nestique-promo-input::placeholder {
            color: #aaa;
        }

        .nestique-promo-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            background-color: var(--color-dark);
            color: var(--color-light);
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .nestique-promo-btn:hover {
            background-color: #444;
        }

        .nestique-checkout-btn {
            display: block;
            width: 100%;
            text-align: center;
            background-color: var(--color-accent);
            color: var(--color-light);
            padding: 15px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 30px;
            transition: background-color 0.2s ease;
        }

        .nestique-checkout-btn:hover {
            background-color: var(--color-secondary);
        }

        .nestique-checkout-btn span {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        .nestique-checkout-btn:hover span {
            margin-left: 15px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .nestique-cart-layout {
                grid-template-columns: 1fr;
            }

            .nestique-cart-header {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .nestique-cart-item {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding-right: 20px;
            }

            .nestique-cart-item-image {
                margin-bottom: 15px;
            }

            .nestique-cart-item-actions {
                width: 100%;
                justify-content: space-between;
                margin-top: 15px;
            }

            .nestique-cart-header {
                font-size: 1.8rem;
                text-align: center;
            }

            .nestique-cart-page {
                padding: 20px 10px;
            }
        }
    </style>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
@endsection

@section('content')
    <div class="nestique-cart-page">
        <div class="nestique-cart-container">
            <h1 class="nestique-cart-header">Nestique Cart</h1>
            <div class="nestique-cart-layout">
                <div class="nestique-cart-items-column">
                    <!-- Cart Item 1 -->
                    <div class="nestique-cart-item">
                        <img src="https://placehold.co/100x100/ac8e51/ffffff?text=Hat" alt="Gradient Graphic T-shirt"
                            class="nestique-cart-item-image">
                        <div class="nestique-cart-item-details">
                            <h4>Gradient Graphic T-shirt</h4>
                            <p>Size: Large</p>
                            <p>Color: White</p>
                            <div class="nestique-cart-item-price">$145</div>
                        </div>
                        <div class="nestique-cart-item-actions">
                            <div class="nestique-quantity-control">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                        class="fas fa-minus"></i></button>
                                <input class="nestique-quantity-input" type="number" value="1" min="1">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                            <button class="nestique-remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <!-- Cart Item 2 -->
                    <div class="nestique-cart-item">
                        <img src="https://placehold.co/100x100/415E72/ffffff?text=Shirt" alt="Checkered Shirt"
                            class="nestique-cart-item-image">
                        <div class="nestique-cart-item-details">
                            <h4>Checkered Shirt</h4>
                            <p>Size: Medium</p>
                            <p>Color: Red</p>
                            <div class="nestique-cart-item-price">$180</div>
                        </div>
                        <div class="nestique-cart-item-actions">
                            <div class="nestique-quantity-control">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                        class="fas fa-minus"></i></button>
                                <input class="nestique-quantity-input" type="number" value="1" min="1">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                            <button class="nestique-remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <!-- Cart Item 3 -->
                    <div class="nestique-cart-item">
                        <img src="https://placehold.co/100x100/222222/ffffff?text=Jeans" alt="Skinny Fit Jeans"
                            class="nestique-cart-item-image">
                        <div class="nestique-cart-item-details">
                            <h4>Skinny Fit Jeans</h4>
                            <p>Size: Large</p>
                            <p>Color: Blue</p>
                            <div class="nestique-cart-item-price">$240</div>
                        </div>
                        <div class="nestique-cart-item-actions">
                            <div class="nestique-quantity-control">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                        class="fas fa-minus"></i></button>
                                <input class="nestique-quantity-input" type="number" value="1" min="1">
                                <button class="nestique-quantity-btn"
                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                            <button class="nestique-remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Column -->
                <div class="nestique-order-summary-column">
                    <h3>Order Summary</h3>
                    <div class="nestique-summary-line">
                        <span>Subtotal</span>
                        <span>$565</span>
                    </div>
                    <div class="nestique-summary-line discount">
                        <span>Discount (-20%)</span>
                        <span>-$113</span>
                    </div>
                    <div class="nestique-summary-line">
                        <span>Delivery Fee</span>
                        <span>$15</span>
                    </div>
                    <div class="nestique-summary-line total">
                        <span>Total</span>
                        <span>$467</span>
                    </div>

                    <form class="nestique-promo-form">
                        <input type="text" class="nestique-promo-input" placeholder="Add promo code">
                        <button type="submit" class="nestique-promo-btn">Apply</button>
                    </form>

                    <a href="{{ route('checkout') }}" class="nestique-checkout-btn">
                        Go to Checkout
                        <span class="fas fa-arrow-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
