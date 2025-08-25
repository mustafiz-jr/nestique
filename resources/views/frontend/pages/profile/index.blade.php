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
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #927542;
            /* A slightly darker shade for hover */
        }

        .card {
            border-radius: 1rem;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #ced4da;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
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

                    <form method="POST" action="/profile/update">
                        @csrf
                        @method('PATCH')

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
                            <button type="submit" class="btn btn-custom rounded-pill">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4 d-flex flex-column gap-4">

                <!-- Change Password Card -->
                <div class="card p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="h5 fw-bold mb-0">Change Password</h2>
                    </div>

                    <form method="POST" action="/password/update">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3">
                            <!-- Current Password -->
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control" required>
                                @error('current_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="col-12">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    required>
                                @error('new_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-12">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-custom rounded-pill w-100">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Information Card -->
                <div class="card p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="h5 fw-bold mb-0">Account Information</h2>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <p class="text-muted mb-0">Member Since</p>
                            <p class="fw-bold mb-0">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>

                        <div class="col-12">
                            <p class="text-muted mb-0">Email Verified</p>
                            <p class="fw-bold mb-0">
                                @if ($user->hasVerifiedEmail())
                                    <span class="text-success">✔ Verified</span>
                                @else
                                    <span class="text-warning">▲ Not Verified</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-12">
                            <p class="text-muted mb-0">Role</p>
                            <p class="fw-bold mb-0">
                                @if ($user->role)
                                    {{ $user->role->name }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div class="col-12">
                            <a href="#" class="primary-btn">Customer Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
