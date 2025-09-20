@extends('frontend.layouts.app')

@section('css')
    <style>
        .bg-light-brown {
            background-color: #f8f6f2;
        }

        .btn-custom {
            background-color: var(--color-secondary);
            color: var(--color-light);
            border: none;
        }

        .btn-custom:hover {
            background-color: var(--color-accent);
            color: var(--color-tertiary);
        }

        .card {
            border-radius: 0.3rem;
            border: 1px solid #e0e0e0;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #ced4da;
        }

        /* my ORDERS STYLES */
        .my-orders-container {
            font-family: var(--primary-font);
            padding: 20px;
        }

        .my-orders-header {
            font-size: 1.5rem;
            color: var(--color-dark);
            margin: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .order-card {
            background-color: var(--color-light);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .order-card-header {
            padding: 15px 20px;
            background-color: var(--color-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-card-header .order-details p {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
        }

        .order-card-header .order-details strong {
            color: var(--color-dark);
        }

        .order-status {
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: bold;
            border-radius: 20px;
            color: white;
        }

        .status-shipped {
            background-color: var(--color-tertiary);
            color: var(--color-dark);
        }

        .order-card-body {
            padding: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
        }

        .order-item:not(:last-child) {
            margin-bottom: 15px;
        }

        .order-item img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            margin-right: 15px;
            object-fit: cover;
        }

        .order-item-details h4 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            color: var(--color-dark);
        }

        .order-item-details p {
            margin: 0;
            font-size: 0.9rem;
            color: #777;
        }

        .order-card-footer {
            padding: 15px 20px;
            background-color: var(--color-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e0e0e0;
        }

        .order-total {
            font-weight: bold;
            font-size: 1.1rem;
            color: var(--color-dark);
        }

        .btn-order-action {
            background-color: var(--color-secondary);
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-order-action.secondary {
            background-color: var(--color-accent);
        }

        .btn-order-action:hover {
            background-color: #634a42;
        }

        .btn-order-action.secondary:hover {
            background-color: #5a6268;
        }

        /* Order Table Styles */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .orders-table th {
            background-color: var(--color-primary);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--color-dark);
            border-bottom: 2px solid #e0e0e0;
        }

        .orders-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .orders-table tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .order-status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .view-details-btn {
            background-color: transparent;
            color: var(--color-secondary);
            border: 1px solid var(--color-secondary);
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .view-details-btn:hover {
            background-color: var(--color-secondary);
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="me-3" width="32" height="32" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>

                <div>
                    <h1 class="h3 fw-bold mb-0">Edit Profile</h1>
                    <p class="text-muted mb-0">Update your personal information and account settings.</p>
                </div>
            </div>
            <a href="{{ url('/home') }}" class="btn btn-outline-secondary rounded-pill bg-light-brown text-dark">
                &larr; Back to Shop
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="row g-4">

            <!-- Personal Information Card -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="h5 fw-bold mb-0">Personal Information</h2>
                    </div>
                    <form id="update-profile-form" method="POST" action="{{ route('profile.update', Auth::user()) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" value="{{ old('id', $user->id) }}">
                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                    class="form-control">
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" id="country"
                                    value="{{ old('country', $user->country) }}" class="form-control">
                                @error('country')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" rows="3" class="form-control">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                                    class="form-control">
                                @error('city')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State/Province -->
                            <div class="col-md-4">
                                <label for="state" class="form-label">State/Province</label>
                                <input type="text" name="state" id="state"
                                    value="{{ old('state', $user->state) }}" class="form-control">
                                @error('state')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ZIP/Postal Code -->
                            <div class="col-md-4">
                                <label for="zip" class="form-label">ZIP/Postal Code</label>
                                <input type="text" name="zip" id="zip" value="{{ old('zip', $user->zip) }}"
                                    class="form-control">
                                @error('zip')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" form="update-profile-form" class="btn btn-custom rounded-pill">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4 d-flex flex-column gap-4">
                <div class="card p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="h5 fw-bold mb-0">Change Password</h2>
                    </div>

                    <form method="POST" id="update_password_form" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('POST')

                        <div class="row g-3">
                            <!-- Current Password -->
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control" required autocomplete="current-password">
                                @error('current_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="col-12">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 w-50">
                            <button type="submit" form="update_password_form" class="btn btn-custom rounded-pill ">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- my Orders Section -->
        <div class="row my-5">
            <div class="my-orders-container">
                <h3 class="my-orders-header">My Orders</h3>

                @if ($orders && count($orders) > 0)
                    <table class="orders-table table table-hover">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Date</th>
                                <th>Product Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $totalQuantity = $order->orderItems->sum('quantity');

                                    $totalAmount = $order->orderItems->sum('total');
                                @endphp
                                <tr>
                                    <td class="fs-6">#{{ $order->order_number }}</td>
                                    <td class="fs-6">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                    </td>
                                    <td class="fs-6">{{ $totalQuantity }}</td> <!-- Use the calculated variable -->
                                    <td class="fs-6">${{ number_format($totalAmount, 2) }}</td>
                                    <!-- Use the calculated variable -->
                                    <td class="fs-6">
                                        <span class="order-status-badge status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="fs-6">
                                        <a href="{{ route('invoice', $order->id) }}" class="primary-btn">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">You haven't placed any orders yet.</p>
                        <a href="{{ url('/home') }}" class="btn btn-custom mt-2">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
