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
    .quick-view {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--color-accent);
        color: var(--color-light);
        padding: 10px;
        font-size: 18px;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }

    .product-card:hover .quick-view {
        opacity: 1;
    }

    .quick-view:hover {
        color: var(--color-accent);
        background: var(--color-secondary)
    }

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
        <img src="{{ asset('assets/frontend/images/product_image.jpg') }}" alt="{{ $product->name }} img">
        <a href="{{ route('product_details', $product->id) }}" class="quick-view" title="quick-view"><i
                class="fa-solid fa-eye px-1"></i></a>
    </div>

    <!-- Content -->
    <div class="product-content">
        <div>
            {{-- @dd($product) --}}
            <small class="text-muted ">{{ $product->category->name }}</small>
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
        <div class="product-footer">
            <button id="cart_add" onclick="count_cart()" class="btn secondary-btn w-50">Add to Cart</button>
            <button class="btn primary-btn w-50">♡ Wishlist</button>
        </div>
    </div>
</div>
