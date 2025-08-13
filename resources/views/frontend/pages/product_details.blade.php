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
            <div class="col-md-6">
                <img id="mainProductImage" class="main-image mb-3"
                    src="https://fabrilife.com/products/64bbded722dda-square.png?v=20" alt="polo shirt" data-bs-toggle="modal"
                    data-bs-target="#imageModal" onclick="openModal(this.src)">

                <div class="row g-2 product-gallery">
                    <div class="col-3">
                        <img src="https://fabrilife.com/products/64944f852b247-square.jpg?v=20" class="img-fluid"
                            onclick="changeMainImage(this.src)">
                    </div>
                    <div class="col-3">
                        <img src="https://fabrilife.com/products/632c5f39def34-square.jpg?v=20" class="img-fluid"
                            onclick="changeMainImage(this.src)">
                    </div>
                    <div class="col-3">
                        <img src="https://fabrilife.com/products/632c5f39def34-square.jpg?v=20" class="img-fluid"
                            onclick="changeMainImage(this.src)">
                    </div>
                    <div class="col-3">
                        <img src="https://fabrilife.com/products/655705370a351-square.jpg?v=20" class="img-fluid"
                            onclick="changeMainImage(this.src)">
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="col-md-6">
                <small class="text-muted text-uppercase">Polo shirt</small>
                <h2 class="mt-2">Premium Designer Edition Double PK Cotton Polo</h2>

                <!-- Rating -->
                <div class="rating mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="far fa-star"></i>
                    <small class="text-muted ms-2">4.5 / 5 (120 reviews)</small>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <span class="old-price">$11.27</span>
                    <span class="price ms-2">$9.80</span>
                    <span class="badge ms-2">-15% OFF</span>
                </div>

                <!-- Short Description -->
                <p>
                    This Polo t-shirt is made with single jersey fabric which features premium 100% combed compact organic
                    cotton. The t-shirt has a soft touch which makes it very comfortable for day-long usage.
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
                <div class="d-flex gap-3 mb-4">
                    <button class="btn secondary-btn flex-fill"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                    <button class="btn primary-btn flex-fill"><i class="far fa-heart"></i> Wishlist</button>
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
                            <strong>Premium Single Jersey Polo T-shirt</strong><br>
                            This Polo t-shirt is made with single jersey fabric which features premium 100% combed compact
                            organic cotton. The t-shirt has a soft touch which makes it very comfortable for day-long usage
                        </p>
                    </div>
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <ul>
                            <li>Organic Ringspun Combed Compact Cotton</li>
                            <li>100% Cotton</li>
                            <li>Reactive Dye, enzyme, and silicon washed</li>
                            <li>Preshrunk to minimize shrinkage</li>
                            <li>Design panels all are fabric and Cut & Stich</li>
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
