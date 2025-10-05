@extends('frontend.layouts.app')

@section('css')
    <style>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
@endsection

@section('content')
    <div class="nestique-cart-page">
        <div class="nestique-cart-container">
            <h1 class="nestique-cart-header">Nestique Cart</h1>

            @if (session('success'))
                <div class="alert" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="nestique-cart-layout">
                <div class="nestique-cart-items-column">
                    @if ($cartItems->isEmpty())
                        <div style="text-align: center; padding: 50px;">
                            <p>Empty Cart</p>
                            <a href="{{ route('home') }}"
                                style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: var(--color-accent); color: white; text-decoration: none; border-radius: 5px;">Go
                                TO shop</a>
                        </div>
                    @else
                        @foreach ($cartItems as $item)
                            <div class="nestique-cart-item">
                                {{-- @dd($item->id->thumbnail) --}}
                                <img src="{{ asset('storage/' . $item->id->thumbnail) }}" alt="{{ $item->name }}"
                                    class="nestique-cart-item-image">
                                <div class="nestique-cart-item-details">
                                    <h4>{{ $item->name }}</h4>
                                    @if ($item->options->has('size'))
                                        <p>Size: {{ $item->options->size }}</p>
                                    @endif
                                    @if ($item->options->has('color'))
                                        <p>Color: {{ $item->options->color }}</p>
                                    @endif
                                    <div class="nestique-cart-item-price">{{ number_format((float) $item->price, 2) }} TK
                                    </div>
                                </div>
                                <div class="nestique-cart-item-actions">
                                    <form action="{{ route('cart.update') }}" method="POST"
                                        style="display: flex; align-items: center;">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                        <div class="nestique-quantity-control">
                                            <button type="submit" name="quantity" value="{{ $item->qty - 1 }}"
                                                class="nestique-quantity-btn">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input class="nestique-quantity-input" type="number" name="quantity_display"
                                                value="{{ $item->qty }}" min="1" readonly>
                                            <button type="submit" name="quantity" value="{{ $item->qty + 1 }}"
                                                class="nestique-quantity-btn">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <form action="{{ route('cart.remove') }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                        <button type="submit" class="nestique-remove-btn"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if (!$cartItems->isEmpty())
                    <div class="nestique-order-summary-column">
                        <h3>Order Summary</h3>
                        <div class="nestique-summary-line">
                            <span>Sub Total</span>
                            <span>{{ Cart::subtotal(2, '.', '') }} TK</span>
                        </div>
                        <div class="nestique-summary-line">
                            <span>Tax</span>
                            <span>{{ Cart::tax(2, '.', '') }} TK</span>
                        </div>
                        <div class="nestique-summary-line total">
                            <span>Total</span>
                            <span>{{ Cart::total(2, '.', '') }} TK</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="nestique-checkout-btn">
                            Checkout
                            <span class="fas fa-arrow-right"></span>
                        </a>

                        <form action="{{ route('cart.clear') }}" method="POST"
                            style="margin-top: 20px; text-align: center;">
                            @csrf
                            <button type="submit"
                                style="background: none; border: none; color: #dc3545; text-decoration: underline; cursor: pointer;">Clear
                                Cart</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
