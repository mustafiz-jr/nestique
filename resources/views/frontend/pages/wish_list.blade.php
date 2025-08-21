@extends('frontend.layouts.app')
@section('css')
    <style>
        /* Main Container */
        .nestique-wishlist-page {
            padding: 40px 20px;
            background-color: var(--color-light);
        }

        .nestique-wishlist-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .nestique-wishlist-header {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 40px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Main Layout */
        .nestique-wishlist-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        /* Wishlist Items Column */
        .nestique-wishlist-items-column {
            background-color: var(--color-primary);
            padding: 30px;
            border-radius: 12px;
        }

        /* Individual Wishlist Item */
        .nestique-wishlist-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .nestique-wishlist-item:last-child {
            border-bottom: none;
        }

        .nestique-wishlist-item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        .nestique-wishlist-item-details {
            flex-grow: 1;
        }

        .nestique-wishlist-item-details h4 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .nestique-wishlist-item-details p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        .nestique-wishlist-item-price {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--color-dark);
            margin-top: 10px;
        }

        .nestique-wishlist-item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nestique-remove-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            padding: 8px 12px;
            transition: color 0.2s ease;
        }



        .nestique-remove-btn {
            color: #d9534f;
            font-size: 1.2rem;
        }

        .nestique-remove-btn:hover {
            color: #c9302c;
        }

        /* Wishlist Summary/Actions Column */
        .nestique-wishlist-actions-column {
            background-color: var(--color-primary);
            padding: 30px;
            border-radius: 12px;
            height: fit-content;
            text-align: center;
        }

        .nestique-wishlist-actions-column h3 {
            font-family: var(--primary-font);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 25px;
        }

        .nestique-wishlist-actions-column p {
            color: #666;
            margin-bottom: 25px;
        }

        .nestique-share-btn {
            display: block;
            width: 100%;
            text-align: center;
            background-color: var(--color-secondary);
            color: var(--color-light);
            padding: 15px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: background-color 0.2s ease;
        }

        .nestique-share-btn:hover {
            background-color: #9b7e41;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .nestique-wishlist-layout {
                grid-template-columns: 1fr;
            }

            .nestique-wishlist-header {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .nestique-wishlist-item {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding-right: 20px;
            }

            .nestique-wishlist-item-image {
                margin-bottom: 15px;
            }

            .nestique-wishlist-item-actions {
                width: 100%;
                justify-content: space-between;
                margin-top: 15px;
            }

            .nestique-wishlist-header {
                font-size: 1.8rem;
                text-align: center;
            }

            .nestique-wishlist-page {
                padding: 20px 10px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="nestique-wishlist-page">
        <div class="nestique-wishlist-container">
            <h1 class="nestique-wishlist-header">Nestique Wishlist</h1>
            <div class="nestique-wishlist-layout">
                <div class="nestique-wishlist-items-column">
                    {{-- Loop through your wishlist items here. This is an example with static data. --}}

                    {{-- Wishlist Item 1 --}}
                    <div class="nestique-wishlist-item">
                        <img src="https://placehold.co/100x100/ac8e51/ffffff?text=Hat" alt="Brown Leather Wallet"
                            class="nestique-wishlist-item-image">
                        <div class="nestique-wishlist-item-details">
                            <h4>Brown Leather Wallet</h4>
                            <p>Handmade, Italian Leather</p>
                            <div class="nestique-wishlist-item-price">$120</div>
                        </div>
                        <div class="nestique-wishlist-item-actions">
                            <button class="btn primary-btn">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="nestique-remove-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Wishlist Item 2 --}}
                    <div class="nestique-wishlist-item">
                        <img src="https://placehold.co/100x100/415E72/ffffff?text=Jacket" alt="Denim Jacket"
                            class="nestique-wishlist-item-image">
                        <div class="nestique-wishlist-item-details">
                            <h4>Classic Denim Jacket</h4>
                            <p>Size: Medium, Color: Indigo</p>
                            <div class="nestique-wishlist-item-price">$85</div>
                        </div>
                        <div class="nestique-wishlist-item-actions">
                            <button class="btn primary-btn">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="nestique-remove-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Wishlist Item 3 --}}
                    <div class="nestique-wishlist-item">
                        <img src="https://placehold.co/100x100/222222/ffffff?text=Shoes" alt="Running Shoes"
                            class="nestique-wishlist-item-image">
                        <div class="nestique-wishlist-item-details">
                            <h4>Ultra-Light Running Shoes</h4>
                            <p>Size: 10, Color: Black</p>
                            <div class="nestique-wishlist-item-price">$150</div>
                        </div>
                        <div class="nestique-wishlist-item-actions">
                            <button class="btn primary-btn">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="nestique-remove-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Wishlist Actions Column --}}
                <div class="nestique-wishlist-actions-column gap-3 d-flex flex-column">
                    <h3>Wishlist Actions</h3>
                    <p>Share your wishlist with friends and family or add all items to your cart at once.</p>
                    <a href="#" class="btn primary-btn">
                        <i class="fas fa-share-alt"></i> Share Wishlist
                    </a>
                    <a href="#" class="btn secondary-btn">
                        <i class="fas fa-shopping-bag"></i> Add All to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
