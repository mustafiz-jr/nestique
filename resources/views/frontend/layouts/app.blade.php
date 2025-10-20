    <?php
    $categories = App\Models\Category::all();
    $cartItems = Cart::content();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nestique</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/frontend/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/frontend/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/frontend/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/frontend/images/site.webmanifest') }}">
    {{-- bootstrap cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- font awsome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    @yield('css')

    <style>
        .catdd-links label {
            background: transparent;
            border: none;
            text-align: start;
            color: var(--color-accent);
            margin-top: 5px;
            padding: 2px;
            font-weight: 600;
        }

        .catdd-links label:hover {
            color: var(--color-secondary);
        }
    </style>
    </head>

    <body>
        <!-- Main Navbar -->
        <header class="navbar-container">
            <!-- Mobile Menu Button -->
            <button class="navbar-mobile__button" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#navbarOffcanvas">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-logo logo-font ps-3"><img
                    src="{{ asset('assets/frontend/images/logo.png') }}" style="height:40px;" alt=""></a>

            <form action="{{ route('shop') }}" method="GET">
                <!-- Search Section -->
                <div class="navbar-search">
                    <div class="navbar-search__catdd align-items-center d-flex dropdown">
                        <div class="catdd-wrapper">
                            <div class="catdd-button" id="catddToggle" aria-expanded="true"
                                aria-controls="catddDropdown" role="button" tabindex="0">
                                <i class="fas fa-th" aria-hidden="true"></i>
                                <span>Category</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="catdd-dropdown" id="catddDropdown" role="region"
                                aria-label="Category Dropdown">
                                <button class="catdd-close-btn" aria-label="Close category dropdown"
                                    style="display:none;">
                                    <i class="fas fa-times"></i> Close
                                </button>

                                <div class="catdd-links">
                                    @foreach ($categories as $category)
                                        <div>
                                            <label for="{{ $category->id }}">{{ $category->name }}</label>
                                            <input type="submit" id="{{ $category->id }}"
                                                value="{{ $category->slug }}" name="category"
                                                class="search_category_item d-none">
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>

                    <input type="text" class="navbar-search__input" name="search" value="{{ request('search') }}"
                        placeholder="I'm shopping for..." />
                    <button class="navbar-search__button" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
            </form>

            </div>

            <!-- Icons Section -->
            <div class="navbar-icons">
                <div class="navbar-icons__group">
                    <div class="navbar-icon">
                        <div class="dropdown">
                            <span class="dropdown-toggle language" type="" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-language"></i>
                            </span>
                            <ul class="dropdown-menu p-2 g-2">
                                <li>Bangla</li>
                                <li> English
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Cart Button with Offcanvas Trigger -->
                    <div class="navbar-icon" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                        @guest
                            <span id="userIcon" class="user-icon-link" onclick="handleUserIconClick(event)"
                                data-modal="login">
                                <span><i class="fas fa-shopping-bag"></i></span>
                                <span class="navbar-icon__badge cart_count" id="cart_count">0</span>
                            </span>
                        @endguest
                        @auth
                            <a href="{{ route('cart.show') }}"><i class="fas fa-shopping-bag"></i></a>
                            <span class="navbar-icon__badge cart_count" id="cart_count">{{ $cartItems->count() }}</span>
                        @endauth
                    </div>

                    <div class="navbar-icon login-dropdown">
                        @guest
                            <span id="userIcon" class="user-icon-link" onclick="handleUserIconClick(event)"
                                data-modal="login">
                                <i class="far fa-user"></i>
                            </span>
                        @endguest

                        @auth
                            <div class="dropdown">
                                <span class="dropdown-toggle" type="" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="far fa-user"></i>
                                </span>
                                <ul class="dropdown-menu p-3 gap-2">
                                    @if (auth()->user()->role->slug == 'admin')
                                        <li> <a class="text-decoration-none" href="/admin"><i
                                                    class="fa-regular fa-user mx-1"></i>Dashboard</a></li>
                                    @elseif(auth()->user()->role->slug == 'customer')
                                        <li> <a class="text-decoration-none" href="{{ route('profile.index') }}"><i
                                                    class="fa-regular fa-user mx-1"></i> Profile</a></li>
                                    @endif
                                    <li> <a class="text-decoration-none" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                class="fa-solid fa-right-from-bracket mx-1"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>

                    @guest
                        <div id="userModal" class="modal logged_out_modal">
                            <div class="modal-content">
                                <span class="close" onclick="handleModalClose()">&times;</span>
                                <div class="form-tabs">
                                    <button class="tab-btn active" data-tab="login">Login</button>
                                    <button class="tab-btn" data-tab="register">Register</button>
                                </div>
                                <div id="login-form" class="form-content active">
                                    <h2>Login to Your Account</h2>
                                    <form class="auth-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="login-email">Email</label>
                                            <input type="email" id="login-email" name="email"
                                                placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="login-password">Password</label>
                                            <input type="password" id="login-password" name="password"
                                                placeholder="Enter your password" required>
                                        </div>
                                        <div class="form-group remember">
                                            <input type="checkbox" id="remember-me" name="remember">
                                            <label for="remember-me">Remember me</label>
                                        </div>
                                        <button type="submit" class="secondary-btn">Login</button>
                                        <div class="form-footer">
                                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot
                                                password?</a>
                                        </div>
                                    </form>
                                </div>
                                <div id="register-form" class="form-content">
                                    <h2>Create New Account</h2>
                                    <form class="auth-form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="register-name">Full Name</label>
                                            <input type="text" id="register-name" name="name"
                                                placeholder="Enter your full name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="register-email">Email</label>
                                            <input type="email" id="register-email" name="email"
                                                placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="register-password">Password</label>
                                            <input type="password" id="register-password" name="password"
                                                placeholder="Create a password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="register-confirm">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="register-confirm"
                                                placeholder="Confirm your password" required>
                                        </div>
                                        <div id="password-match-message"></div>
                                        <div class="form-group terms">
                                            <input type="checkbox" id="accept-terms" required>
                                            <label for="accept-terms">I agree to the <a href="#">Terms of
                                                    Service</a></label>
                                        </div>
                                        <input type="hidden" name="role_id" value="2">
                                        <button type="submit" class="secondary-btn">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </header>


        <!-- Navigation Links -->
        <nav class="navbar-links">
            <a href="{{ route('home') }}" class="navbar-link">Home</a>
            <a href="{{ route('shop') }}" class="navbar-link">Shop</a>
            <a href="{{ route('men_product') }}" class="navbar-link">Men</a>
            <a href="{{ route('women_product') }}" class="navbar-link">Women</a>
            <a href="{{ route('contact') }}" class="navbar-link">Contact Us</a>
            <a href="{{ route('about') }}" class="navbar-link">About Us</a>
            <a href="{{ route('offer') }}" class="navbar-link">Offer's</a>
        </nav>

        <!-- Mobile Offcanvas Menu -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarOffcanvas">
            <div class="offcanvas-header" style="background-color: var(--color-accent); color: var(--color-light);">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <a href="#" class="mobile-nav-link">Home</a>
                <a href="{{ route('shop') }}" class="mobile-nav-link">Shop</a>
                <a href="{{ route('men_product') }}" class="mobile-nav-link">Men</a>
                <a href="{{ route('women_product') }}" class="mobile-nav-link">Women</a>
                <a href="{{ route('contact') }}" class="mobile-nav-link">Contact Us</a>
                <a href="{{ route('about') }}" class="mobile-nav-link">About Us</a>
                <a href="{{ route('offer') }}" class="mobile-nav-link">Offer's</a>
            </div>
        </div>

        <!-- Cart Offcanvas -->
        {{-- <div class="offcanvas offcanvas-end offcanvas-cart" tabindex="-1" id="cartOffcanvas">
            <div class="offcanvas-header" style="background-color: var(--color-accent); color: var(--color-light);">
                <h5 class="offcanvas-title">Your Cart <span class="cart_count">(0)</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Cart Items -->
                <div class="cart-item">
                    <img src="https://blissclothingbd.com/wp-content/uploads/2025/02/khaki-1-3-scaled.jpg" alt="Product"
                        class="cart-item-img">
                    <div class="cart-item-details">
                        <div class="cart-item-title">Baggy Full Pant</div>
                        <div>Size: 38/40 | Color: Brown</div>
                        <div class="cart-item-price">$8.17</div>
                        <div>Qty: 1</div>
                    </div>
                </div>

                <div class="cart-item">
                    <img src="https://blissclothingbd.com/wp-content/uploads/2025/01/jacket-1-2-768x960.jpg"
                        alt="Product" class="cart-item-img">
                    <div class="cart-item-details">
                        <div class="cart-item-title">Two Way Zipper Cord Winter Jacket</div>
                        <div>Color: B & W</div>
                        <div class="cart-item-price">$8.89</div>
                        <div>Qty: 2</div>
                    </div>
                </div>

                <!-- Cart Total -->
                <div class="cart-total">
                    Subtotal: $17
                </div>

                <!-- Cart Buttons -->
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('checkout') }}" class="primary-btn">Checkout</a>
                    <a href="{{ route('cart.show') }}" class="secondary-btn">View Cart</a>
                </div>
            </div>
        </div> --}}
        {{-- nav bar end --}}


        @yield('content')


        {{-- footer start --}}
        <footer class="site-footer">
            <div class="footer-container container">
                <div class="footer-column about">
                    <h3 class="footer-title">About Us</h3>
                    <p class="footer-text">Nestique is your ultimate destination for chic, timeless, and trend-forward
                        fashion.
                        From everyday essentials to statement pieces, we curate styles that define your personality.
                        Step into Nestique and discover a world where elegance meets comfort.</p>
                </div>
                <div class="footer-column links">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-list">
                        <li><a class="footer-link" href="{{ route('home') }}">Home</a></li>
                        <li><a class="footer-link" href="{{ route('shop') }}">Shop</a></li>
                        <li><a class="footer-link" href="{{ route('men_product') }}">Men</a></li>
                        <li><a class="footer-link" href="{{ route('women_product') }}">Women</a></li>
                        <li><a class="footer-link" href="{{ route('offer') }}">Mega Offer</a></li>
                    </ul>
                </div>
                <div class="footer-column contact">
                    <h3 class="footer-title">Contact</h3>
                    <p class="footer-text">Email: info@nestique.com</p>
                    <p class="footer-text">Phone: +123 456 7890</p>
                    <p class="footer-text">Address: 123 Nestique Ave, City, Country</p>
                </div>
                <div class="footer-column social">
                    <h3 class="footer-title">Follow Us</h3>
                    <div class="social-icons d-flex gap-4">
                        <a class="footer-link" href="#"><i class="fs-4 fab fa-facebook-f"></i></a>
                        <a class="footer-link" href="#"><i class="fs-4 fab fa-instagram"></i></a>
                        <a class="footer-link" href="#"><i class="fs-4 fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="payment containers my-4 ps-sm-0 ps-5">
                <h4 class="ps-5">Pay with</h4>
                <div class="d-flex gap-1 flex-wrap g-1 justify-content-start ps-4">
                    <!-- Nagad -->
                    <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" alt="Nagad Logo"
                        width="100">

                    <!-- bKash -->
                    <img src="https://static.vecteezy.com/system/resources/previews/039/340/798/non_2x/bkash-logo-free-vector.jpg"
                        alt="bKash Logo" width="100">

                    <!-- Rocket (Dutch-Bangla Bank Mobile Banking) -->
                    <img src="https://images.seeklogo.com/logo-png/31/2/dutch-bangla-rocket-logo-png_seeklogo-317692.png"
                        alt="Rocket Logo" width="100">

                    <!-- Visa -->
                    <img src="https://e7.pngegg.com/pngimages/363/177/png-clipart-visa-mastercard-logo-visa-mastercard-computer-icons-visa-text-payment-thumbnail.png"
                        alt="Visa Logo" width="100">

                    <!-- PayPal -->
                    <img src="https://www.citypng.com/public/uploads/preview/transparent-hd-paypal-logo-701751694777788ilpzr3lary.png"
                        alt="PayPal Logo" width="100">

                    <!-- Islami Bank Bangladesh -->
                    <img src="https://images.seeklogo.com/logo-png/52/2/islami-bank-bangladesh-logo-png_seeklogo-522591.png"
                        alt="Islami Bank Logo" width="100">

                    <!-- Dutch-Bangla Bank -->
                    <img src="https://bdnewsnet.com/wp-content/uploads/2020/01/Dutch-Bangla-bank-logo.jpg"
                        alt="Dutch-Bangla Bank Logo" width="100">

                    <!-- BRAC Bank -->
                    <img src="https://corporate.bdjobs.com/logos/25059_4.png" alt="BRAC Bank Logo" width="100">

                    <!-- Bank Asia -->
                    <img src="https://play-lh.googleusercontent.com/8ieMWJqcvgNCjQjQH70uot-eNV5pJiepG1JwVnhUTVe6dJqmUIDtptE9-sccfzHTwA"
                        alt="Bank Asia Logo" width="100">

                    <!-- Upay -->
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0zlVQVtpQEul9jse_onWcrzvcfNWsiJfBYw&s"
                        alt="Upay Logo" width="100">

                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copy">&copy; 2025 Nestique. All rights reserved by <span id="developer">Mustafizur
                        Rahman</span>.</p>
            </div>
        </footer>

        {{-- footer end --}}

        {{-- stripe js cdn --}}
        <script src="https://js.stripe.com/v3/"></script>

        {{-- jquery cdn --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        {{-- bootstrap cdn --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Slick JS -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- custom js -->
        <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
        @yield('js')

    </body>

    </html>
