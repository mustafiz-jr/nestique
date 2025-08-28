<style>
    /* product card css start */
    .product-card {
        position: relative;
        overflow: hidden;
        border-radius: 3px;
        height: 60vh;
        padding: 5px;
        width: 300px;
    }

    .product-image {
        height: 50%;
        position: relative;
        overflow: hidden;
    }

    .product-title {
        color: var(--color-accent);
    }

    .product-card:hover .product-title {
        color: var(--color-secondary);
        text-decoration: underline;
    }

    .price {
        color: var(--color-secondary)
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    /* Quick view button */


    .product-content {
        height: 50%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        padding: 15px;
    }

    .product-footer {
        display: flex;
        gap: 10px;
        border-top: 1px solid #eee;
        padding-top: 10px;
        margin-top: 10px;
    }

    .cart-btn {
        background: var(--color-accent);
        font-weight: bold;
        color: var(--color-light);
    }

    .cart-btn:hover {
        background: var(--color-secondary);
        color: var(--color-dark)
    }

    .wish-btn {
        background: var(--color-secondary);
        font-weight: bold;
        color: var(--color-light);
    }

    .wish-btn:hover {
        background: var(--color-accent);
        color: var(--color-tertiary);
    }

    .rating {
        color: var(--color-tertiary)
    }

    .discount {
        color: var(--color-accent);
    }

    /* product card css end */
</style>
<div class="card product-card">
    <!-- Image -->
    <div class="product-image">
        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }} img">

    </div>

    <!-- Content -->
    <div class="product-content">
        <div>
            {{-- @dd($product) --}}
            <div class="d-flex justify-content-between">
                <small class="text-muted ">{{ $product->category->name }}</small>
                <small class="text-muted ">{{ $product->brand->name }}</small>
            </div>
            <a href="{{ route('product_details', $product->id) }}" class="text-decoration-none">
                <h5 class="mt-1 product-title">{{ $product->name }}</h5>
            </a>
            <div class="mt-2">
                <span class="text-muted text-decoration-line-through">$11.27</span>
                <span class="fw-bold price ms-2">${{ $product->price }}<span class="mx-2 discount">(-15%)</span></span>
            </div>
            <div class="mt-2">
                <span class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <i class="fa-regular fa-star"></i>
                </span>
            </div>
        </div>

        <!-- Footer buttons -->
        <div class="product-footer d-flex justify-content-between">
            @guest
                <div class="w-50">
                    <span id="userIcon" class="user-icon-link" onclick="handleUserIconClick(event)" data-modal="login">
                        <button id="cart_add" onclick="count_cart()" class="btn secondary-btn w-100">Add to
                            Cart</button>
                    </span>
                </div>
            @endguest

            @auth
                <div class="w-50">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf

                        <!-- পণ্যের ID লুকানো ইনপুট ফিল্ড হিসেবে পাঠানো হচ্ছে -->
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="hidden" name="quantity" value="1" min="1"
                            max="{{ $product->stock_quantity }}">

                        <button type="submit" id="cart_add" onclick="count_cart()" class="btn secondary-btn w-100">Add to
                            Cart</button>
                    </form>
                </div>
            @endauth

            <div class="w-50">
                <a href="{{ route('product_details', $product->id) }}" class="btn primary-btn w-100"
                    title="quick-view">Quick view</a>
            </div>
        </div>
    </div>
</div>
