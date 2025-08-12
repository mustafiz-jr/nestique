<!DOCTYPE html>
<html lang="en">

<head>
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

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    @yield('css')
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
                src="{{ asset('assets/frontend/images/logo.png') }}" style="height: 100px;" alt=""></a>

        <!-- Search Section -->
        <div class="navbar-search">
            <div class="navbar-search__catdd align-items-center d-flex dropdown">
                <div class="catdd-wrapper">
                    <div class="catdd-button" id="catddToggle" aria-expanded="true" aria-controls="catddDropdown"
                        role="button" tabindex="0">
                        <i class="fas fa-th" aria-hidden="true"></i>
                        <span>Category</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="catdd-dropdown" id="catddDropdown" role="region" aria-label="Category Dropdown">
                        <button class="catdd-close-btn" aria-label="Close category dropdown" style="display:none;">
                            <i class="fas fa-times"></i> Close
                        </button>

                        <!-- Men -->
                        <h4 tabindex="0"><span>Men</span> <i class="fas fa-chevron-right" aria-hidden="true"></i></h4>
                        <div class="catdd-links">
                            <a href="#">T-Shirts & Polos</a>
                            <a href="#">Shirts</a>
                            <a href="#">Jeans & Trousers</a>
                            <a href="#">Jackets & Coats</a>
                            <a href="#">Ethnic Wear</a>
                        </div>

                        <!-- Women -->
                        <h4 tabindex="0"><span>Women</span> <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </h4>
                        <div class="catdd-links">
                            <a href="#">Tops & Blouses</a>
                            <a href="#">Dresses</a>
                            <a href="#">Sarees</a>
                            <a href="#">Salwar Kameez</a>
                            <a href="#">Kurtis & Tunics</a>
                        </div>

                        <!-- Kids -->
                        <h4 tabindex="0"><span>Kids</span> <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </h4>
                        <div class="catdd-links">
                            <a href="#">Boys' Clothing</a>
                            <a href="#">Girls' Clothing</a>
                            <a href="#">Footwear</a>
                            <a href="#">Ethnic Wear</a>
                            <a href="#">School Accessories</a>
                        </div>

                        <!-- Accessories -->
                        <h4 tabindex="0"><span>Accessories</span> <i class="fas fa-chevron-right"
                                aria-hidden="true"></i></h4>
                        <div class="catdd-links">
                            <a href="#">Bags & Backpacks</a>
                            <a href="#">Watches</a>
                            <a href="#">Sunglasses</a>
                            <a href="#">Jewelry</a>
                            <a href="#">Belts & Wallets</a>
                        </div>
                    </div>
                </div>
            </div>


            <input type="text" class="navbar-search__input" placeholder="I'm shopping for..." />
            <button class="navbar-search__button">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Icons Section -->
        <div class="navbar-icons">
            <div class="navbar-icons__group">
                <div class="navbar-icon">
                    <span><i class="far fa-heart"></i></span>
                    <span class="navbar-icon__badge">0</span>
                </div>

                <!-- Cart Button with Offcanvas Trigger -->
                <div class="navbar-icon" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                    <span><i class="fas fa-shopping-bag"></i></span>
                    <span class="navbar-icon__badge">3</span>
                </div>

                <!-- Login Dropdown -->
                <div class="navbar-icon login-dropdown">
                    <span><i class="far fa-user"></i></span>
                    <small class="navbar-icon__text">Account</small>
                    <div class="login-dropdown-content">
                        <a href="#" class="login-dropdown-link">Login</a>
                        <a href="#" class="login-dropdown-link">Register</a>
                        <a href="#" class="login-dropdown-link">My Account</a>
                        <a href="#" class="login-dropdown-link">Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Links -->
    <nav class="navbar-links">
        <a href="{{ route('home') }}" class="navbar-link">Home</a>
        <a href="#" class="navbar-link">Shop</a>
        <a href="#" class="navbar-link">Men</a>
        <a href="#" class="navbar-link">Women</a>
        <a href="#" class="navbar-link">Contact Us</a>
        <a href="#" class="navbar-link">About Us</a>
        <a href="#" class="navbar-link">Offer's</a>
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
            <a href="#" class="mobile-nav-link">Shop</a>
            <a href="#" class="mobile-nav-link">Men</a>
            <a href="#" class="mobile-nav-link">Women</a>
            <a href="#" class="mobile-nav-link">Contact Us</a>
            <a href="#" class="mobile-nav-link">About Us</a>
            <a href="#" class="mobile-nav-link">Offer's</a>
        </div>
    </div>

    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end offcanvas-cart" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header" style="background-color: var(--color-accent); color: var(--color-light);">
            <h5 class="offcanvas-title">Your Cart (3)</h5>
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
                <button class="primary-btn">Checkout</button>
                <button class="secondary-btn">View Cart</button>
            </div>
        </div>
    </div>
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
                    <li><a class="footer-link" href="#">Home</a></li>
                    <li><a class="footer-link" href="#">Shop</a></li>
                    <li><a class="footer-link" href="#">Men</a></li>
                    <li><a class="footer-link" href="#">Women</a></li>
                    <li><a class="footer-link" href="#">Mega Offer</a></li>
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
        <div class="payments my-2">
            <h4>Pay with</h4>
            <div class="d-flex gap-1">
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


    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- bootstrap cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- custom js -->
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    @yield('js')
</body>

</html>
