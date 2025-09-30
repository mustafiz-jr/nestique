@extends('frontend.layouts.app')

@section('css')
    <style>
        .card-custom {
            border-top: 8px solid var(--color-tertiary);
            border-radius: 0.5rem;
        }

        .box-shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .btn-brand-secondary {
            background-color: var(--color-secondary);
            color: var(--color-light);
            border: none;
            border-radius: 50rem;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-brand-secondary:hover {
            background-color: var(--color-tertiary);
            color: var(--color-light);
        }

        .btn-brand-accent {
            background-color: var(--color-accent);
            color: var(--color-light);
            border: none;
            border-radius: 50rem;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-brand-accent:hover {
            background-color: #354e5b;
            color: var(--color-light);
        }

        .fa-check-circle {
            color: var(--color-secondary);
        }

        .font-secondary {
            color: var(--color-accent);
        }

        .font-primary {
            color: var(--color-accent);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <!-- Thank You Header Section -->
        <div class="my-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card bg-white p-4 p-md-5 text-center mb-4 card-custom shadow-lg">
            <div class="d-flex flex-column align-items-center mb-3">
                <i class="fa-solid fa-check-circle  display-3 mb-4"></i>
                <h1 class="font-secondary fw-bold mb-2">Thank You for Your Order!</h1>
                <p class="h5 font-primary text-gray-700">
                    Your order has been placed successfully and is being processed.
                </p>
                <p class="text-center">
                    <br>
                    <a class="secondary-btn" href="{{ route('shop') }}">Explore More Collections</a>
                </p>
            </div>
        </div>

        <!-- Main Order Details Row -->
        {{-- <div class="row g-4">
            <!-- Order Details & Addresses Column -->
            <div class="col-lg-8">
                <!-- Order Details Card -->
                <div class="card bg-white p-4 shadow-sm mb-4">
                    <h2 class="card-title h5 font-weight-bold text-accent border-bottom pb-2 mb-4">Order Details</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h3 class="h6 font-weight-bold text-gray-800">Order Information</h3>
                            <p class="small text-gray-600 mb-0">Order Number: <strong class="text-dark">#123456789</strong>
                            </p>
                            <p class="small text-gray-600 mb-0">Order Date: <strong class="text-dark">August 24,
                                    2024</strong></p>
                            <p class="small text-gray-600 mb-0">Status: <strong class="text-tertiary">Processing</strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 font-weight-bold text-gray-800">Payment Information</h3>
                            <p class="small text-gray-600 mb-0">Payment Method: <strong class="text-dark">Visa</strong></p>
                            <p class="small text-gray-600 mb-0">Payment Status: <strong class="text-tertiary">Paid</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Billing & Shipping Addresses Card -->
                <div class="card bg-white p-4 shadow-sm mb-4">
                    <h2 class="card-title h5 font-weight-bold text-accent border-bottom pb-2 mb-4">Addresses</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h3 class="h6 font-weight-bold text-gray-800 mb-2">Billing Address</h3>
                            <p class="small text-gray-600 mb-0">John Doe</p>
                            <p class="small text-gray-600 mb-0">johndoe@example.com</p>
                            <p class="small text-gray-600 mb-0">+1 (555) 123-4567</p>
                            <p class="small text-gray-600 mb-0">123 Main Street, Springfield, IL 62704</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 font-weight-bold text-gray-800 mb-2">Shipping Address</h3>
                            <p class="small text-gray-600 mb-0">John Doe</p>
                            <p class="small text-gray-600 mb-0">456 Oak Avenue, Springfield, IL 62704</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-start flex-wrap gap-2">
                    <a href="#" class="btn btn-brand-secondary">
                        View Order Details
                    </a>
                    <a href="#" class="btn btn-brand-accent">
                        Download Invoice
                    </a>
                </div>
            </div>

            <!-- Right Column for Summary & Items -->
            <div class="col-lg-4">
                <!-- Order Summary Card -->
                <div class="card bg-white p-4 shadow-sm mb-4">
                    <h2 class="card-title h5 font-weight-bold text-accent border-bottom pb-2 mb-4">Order Summary</h2>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-gray-700">Subtotal</span>
                        <span class="small font-weight-bold text-dark">5,000.00 TK</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-gray-700">Shipping</span>
                        <span class="small font-weight-bold text-dark">80.00 TK</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-gray-700">Tax</span>
                        <span class="small font-weight-bold text-dark">500.00 TK</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                        <span class="font-weight-bold text-dark h6">Total</span>
                        <span class="font-weight-bold text-dark h6">5,580.00 TK</span>
                    </div>
                </div>

                <!-- Order Items Card -->
                <div class="card bg-white p-4 shadow-sm">
                    <h2 class="card-title h5 font-weight-bold text-accent border-bottom pb-2 mb-4">Order Items</h2>
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/60x60/ac8e51/ffffff?text=Product" alt="Product Image"
                                class="rounded-3 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <p class="font-weight-semibold text-dark mb-0">Blue Men's T-Shirt</p>
                                <p class="small text-gray-600 mb-0">SKU: T-101</p>
                            </div>
                        </div>
                        <div class="text-end small">
                            <p class="text-dark mb-0">1,500.00 TK</p>
                            <p class="text-gray-500 mb-0">Qty: 1</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/60x60/415e72/ffffff?text=Product" alt="Product Image"
                                class="rounded-3 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <p class="font-weight-semibold text-dark mb-0">Stylish Women's Jeans</p>
                                <p class="small text-gray-600 mb-0">SKU: J-202</p>
                            </div>
                        </div>
                        <div class="text-end small">
                            <p class="text-dark mb-0">3,500.00 TK</p>
                            <p class="text-gray-500 mb-0">Qty: 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('js')
    {{-- You can add any page-specific JavaScript here if needed --}}
@endsection
