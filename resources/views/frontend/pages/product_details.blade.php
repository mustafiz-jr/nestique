@extends('frontend.layouts.app')
@section('css')
    <style>
        .product-gallery img {
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .product-gallery img:hover {
            border-color: #ff5722;
        }

        .main-image {
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .badge {
            background: var(--color-accent);
            color: var(--color-light);
        }

        .price {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--color-secondary);
        }

        .old-price {
            text-decoration: line-through;
            color: #888;
            font-size: 1.2rem;
        }

        .rating i {
            color: var(--color-tertiary);
        }

        #mainProductImage {
            height: 60vh;
            width: 100%;
            object-fit: cover;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
            background: #fff;
        }

        .accent-btn {
            border: 1px solid var(--color-accent);
            color: var(--color-accent);
            background: transparent;
            font-weight: bolder;
        }

        /* Active tab color change */
        .nav-tabs .nav-link.active {
            color: var(--color-secondary) !important;
            background: var(--color-primary);
            /* border: 1px solid var(--color-accent); */
        }

        /* Optional: hover effect */
        .nav-tabs .nav-link:hover {
            color: #415E72;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row g-5">
            <!-- Left: Product Images -->
            {{-- @dd($product) --}}
            <div class="col-md-6">
                <img id="mainProductImage" class="main-image mb-3" src="{{ asset($product->thumbnail) }}" alt="polo shirt"
                    data-bs-toggle="modal" data-bs-target="#imageModal" onclick="openModal(this.src)">

                <div class="row g-2 product-gallery">
                    @foreach ($product->gallery as $item)
                        <div class="col-3">
                            <img src="{{ asset($item) }}" class="img-fluid" onclick="changeMainImage(this.src)">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="col-md-6">
                <small class="text-muted text-uppercase">{{ $product->category->name }}</small>
                <h2 class="mt-2">{{ $product->name }}</h2>

                <!-- Rating -->
                <div class="rating mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="far fa-star"></i>
                    <small class="text-muted ms-2">4.5 / 5 ({{ $product->views }} views)</small>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <span class="old-price">$11.27</span>
                    <span class="price ms-2">${{ $product->price }}</span>
                    <span class="badge ms-2">-15% OFF</span>
                </div>

                <!-- Short Description -->
                <p>
                    {!! $product->description !!}
                </p>

                <!-- Quantity Selector -->
                <div class="mb-3 d-flex align-items-center" style="max-width: 150px;">
                    <label for="quantity" class="form-label fw-bold me-3 mb-0">Quantity</label>
                    <button type="button" id="decrement" class="py-1 px-2 rounded-1 accent-btn">-</button>
                    <input type="text" id="quantity" class="form-control text-center mx-2" value="1" min="1"
                        style="max-width: 80px;min-width: 60px;">
                    <button type="button" id="increment" class="p-1  px-2 rounded-1 accent-btn">+</button>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between gap-1 mb-4">
                    <div class="w-50">
                        @guest
                            <div class="w-100">
                                <span id="userIcon" class="user-icon-link" onclick="handleUserIconClick(event)"
                                    data-modal="login">
                                    <button id="cart_add" onclick="count_cart()" class="btn secondary-btn w-100">Add to
                                        Cart</button>
                                </span>
                            </div>
                        @endguest

                        @auth
                            <div class="w-100">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf

                                    <!-- পণ্যের ID লুকানো ইনপুট ফিল্ড হিসেবে পাঠানো হচ্ছে -->
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <input type="hidden" name="quantity" value="1" min="1"
                                        max="{{ $product->stock_quantity }}">

                                    <button type="submit" id="cart_add" onclick="count_cart()"
                                        class="btn secondary-btn w-100">Add to
                                        Cart</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                    {{-- 
                    <div class="w-50">
                        <button id="wishlist_btn" class="btn primary-btn w-100">
                            <i class="far fa-heart"></i>Wishlist
                        </button>
                    </div> --}}

                </div>
            </div>
        </div>

        <!-- Tabs for Description & Specs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active me-1" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description" type="button" role="tab">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button"
                            role="tab">
                            Specifications
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="productTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p>
                            <strong>{{ $product->name }}</strong><br>
                            {!! $product->description !!}
                        </p>
                    </div>
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <ul>
                            <li><span class="fw-bold">Height:</span> {{ $product->height }}CM</li>
                            <li><span class="fw-bold">Weight:</span> {{ $product->weight }}CM</li>
                            <li><span class="fw-bold">Width:</span> {{ $product->width }}CM</li>
                            <li><span class="fw-bold">Lenght:</span> {{ $product->length }}CM</li>
                            <li><span class="fw-bold">Tags:</span>
                                @foreach ($product->tags as $item)
                                    {{ $item }},
                                @endforeach
                            </li>
                            <li><span class="fw-bold">Options:</span>
                                @foreach ($product->options as $item)
                                    {{ $item }}
                                @endforeach
                            </li>
                            <li><span class="fw-bold">Variants:</span>
                                @foreach ($product->variants as $item)
                                    {{ $item }}
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Image Zoom -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid rounded" alt="Product Image">
                </div>
            </div>
        </div>
    </div>
    <div class="container card p-3 my-3">
        @include('frontend.components.policy')
    </div>
@endsection

@section('js')
    <script>
        function openModal(src) {
            document.getElementById("modalImage").src = src;
        }

        function changeMainImage(src) {
            document.getElementById("mainProductImage").src = src;
            document.getElementById("modalImage").src = src;
        }

        const description_tab = document.getElementById('description-tab')

        const quantityInput = document.getElementById('quantity');
        const incrementBtn = document.getElementById('increment');
        const decrementBtn = document.getElementById('decrement');

        incrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
        });

        decrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        quantityInput.addEventListener('input', () => {
            let val = parseInt(quantityInput.value);
            if (isNaN(val) || val < 1) {
                quantityInput.value = 1;
            } else {
                quantityInput.value = val;
            }
        });
    </script>
@endsection
