@extends('layouts.app')
@section('css')
    <style>




    </style>
@endsection


@section('content')
    <section>
        <!-- Banner Slider -->
        {{-- <div class="head-slider ">
            <div><img src="{{ asset('assets/frontend/images/sports_banner_1.jpg') }}" alt="sports_banner_1"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_2.jpg') }}" alt="sports_banner_2"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_3.jpg') }}" alt="sports_banner_3"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_4.jpg') }}" alt="sports_banner_4"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_5.jpg') }}" alt="sports_banner_5"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_6.jpg') }}" alt="sports_banner_6"></div>
            <div><img src="{{ asset('assets/frontend/images/sports_banner_7.jpg') }}" alt="sports_banner_7"></div>
        </div> --}}
        <div class="row head-grid g-0">
            <div class="col-md-8 banner"><img src="{{ asset('assets/frontend/images/sports_banner_1.jpg') }}"
                    alt="sports_banner_1">
                <h2 class="banner-title" style="color:#FF4F0F; ">Fitness</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-4 banner"><img src="{{ asset('assets/frontend/images/sports_banner_6.jpg') }}"
                    alt="sports_banner_1">
                <h2 class="banner-title" style="color:#FFA673; ">Adventure</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-4 banner"><img src="{{ asset('assets/frontend/images/sports_banner_5.jpg') }}"
                    alt="sports_banner_1">
                <h2 class="banner-title" style="color:#FFA673">Yoga</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-8 banner"><img src="https://i.pinimg.com/736x/c3/57/13/c35713fc6cd4f8d62efd4d6b451f9e1b.jpg"
                    alt="sports_banner_1">
                <h2 class="banner-title" style="color: #FF4F0F">Offers</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
        </div>

        <!-- Category Carousel -->
        <div class="row container m-auto my-5 ">
            <h2 class="mb-3">Top Categories</h2>
            <div class="w-25 title-border"></div>
            <div class="col-md-12">
                <div class="category_carousel">
                    <a href="" class="category_card">
                        <img src="https://images.pexels.com/photos/1229356/pexels-photo-1229356.jpeg?cs=srgb&dl=pexels-anush-1229356.jpg&fm=jpg"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Fitness</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5USPMdecyoGwK5xRslyfflEyNYcav2G23_w&s"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Sportswear</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://plus.unsplash.com/premium_photo-1682435561654-20d84cef00eb?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Footwear</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://t4.ftcdn.net/jpg/00/04/43/79/360_F_4437974_DbE4NRiaoRtUeivMyfPoXZFNdCnYmjPq.jpg"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Sports</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://t3.ftcdn.net/jpg/03/17/25/70/360_F_317257068_riIf6w8jDqCjAVcgcYWPbLNSmD2Dp3nX.jpg"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Yoga</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://images.unsplash.com/photo-1568736333626-be878c584b98?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YWR2ZW50dXJlJTIwdHJhdmVsfGVufDB8fDB8fHww"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Adventure</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://www.kidsworldfun.com/blog/wp-content/uploads/2023/03/Outdoor-Footbal-Game.jpg"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Outdoor</h2>
                        </div>
                    </a>
                    <a href="" class="category_card">
                        <img src="https://img.freepik.com/free-photo/top-view-composition-with-neatly-arranged-organized-sport-items_23-2150275221.jpg"
                            alt="Category Image">
                        <div class="category_content">
                            <h2>Accessories</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="container my-5">
            <h2 class="my-3">Hot Deals</h2>
            <div class="w-25 title-border"></div>
            <div class="row">
                <a href="{{ route('product_details') }}" class="col-md-3 text-decoration-none">
                    <div class="card product-card">
                        <!-- Image -->
                        <div class="product-image">
                            <img src="https://sportsandfitness.com.bd/wp-content/uploads/2024/12/2.5kg-hex-dumbbell.webp"
                                alt="Product">
                            <div class="quick-view" title="quick-view"><i class="fa-solid fa-eye px-1"></i></div>
                        </div>

                        <!-- Content -->
                        <div class="product-content">
                            <div>
                                <small class="text-muted ">Fitness</small>
                                <h5 class="mt-1 product-title">Hex Dumbbell(2.5kg-25kg)</h5>
                                <div class="mt-2">
                                    <span class="text-muted text-decoration-line-through">$120</span>
                                    <span class="fw-bold price ms-2">$99<span class="mx-2 discount">(-17%)</span></span>
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
                                <button class="btn secondary-btn w-50">Add to Cart</button>
                                <button class="btn primary-btn w-50">♡ Wishlist</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <div class="container my-5">
            <h2 class="my-3">Best Selling Products</h2>
            <div class="w-25 title-border"></div>
            <div class="row">
                <a href="{{ route('product_details') }}" class="col-md-3 text-decoration-none">
                    <div class="card product-card">
                        <!-- Image -->
                        <div class="product-image">
                            <img src="https://sportsandfitness.com.bd/wp-content/uploads/2024/12/2.5kg-hex-dumbbell.webp"
                                alt="Product">
                            <div class="quick-view" title="quick-view"><i class="fa-solid fa-eye px-1"></i></div>
                        </div>

                        <!-- Content -->
                        <div class="product-content">
                            <div>
                                <small class="text-muted ">Fitness</small>
                                <h5 class="mt-1 product-title">Hex Dumbbell(2.5kg-25kg)</h5>
                                <div class="mt-2">
                                    <span class="text-muted text-decoration-line-through">$120</span>
                                    <span class="fw-bold price ms-2">$99<span class="mx-2 discount">(-17%)</span></span>
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
                                <button class="btn secondary-btn w-50">Add to Cart</button>
                                <button class="btn primary-btn w-50">♡ Wishlist</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <br>
        <div class="container my-5">
            <h2 class="my-3">Sports Products</h2>
            <div class="w-25 title-border"></div>
            <div class="row">
                <a href="{{ route('product_details') }}" class="col-md-3 text-decoration-none">
                    <div class="card product-card">
                        <!-- Image -->
                        <div class="product-image">
                            <img src="https://sportsandfitness.com.bd/wp-content/uploads/2024/12/2.5kg-hex-dumbbell.webp"
                                alt="Product">
                            <div class="quick-view" title="quick-view"><i class="fa-solid fa-eye px-1"></i></div>
                        </div>

                        <!-- Content -->
                        <div class="product-content">
                            <div>
                                <small class="text-muted ">Fitness</small>
                                <h5 class="mt-1 product-title">Hex Dumbbell(2.5kg-25kg)</h5>
                                <div class="mt-2">
                                    <span class="text-muted text-decoration-line-through">$120</span>
                                    <span class="fw-bold price ms-2">$99<span class="mx-2 discount">(-17%)</span></span>
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
                                <button class="btn secondary-btn w-50">Add to Cart</button>
                                <button class="btn primary-btn w-50">♡ Wishlist</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <br>
        <div class="container my-5">
            <h2 class="my-3">Fitness Products</h2>
            <div class="w-25 title-border"></div>
            <div class="row">
                <a href="{{ route('product_details') }}" class="col-md-3 text-decoration-none">
                    <div class="card product-card">
                        <!-- Image -->
                        <div class="product-image">
                            <img src="https://sportsandfitness.com.bd/wp-content/uploads/2024/12/2.5kg-hex-dumbbell.webp"
                                alt="Product">
                            <div class="quick-view" title="quick-view"><i class="fa-solid fa-eye px-1"></i></div>
                        </div>

                        <!-- Content -->
                        <div class="product-content">
                            <div>
                                <small class="text-muted ">Fitness</small>
                                <h5 class="mt-1 product-title">Hex Dumbbell(2.5kg-25kg)</h5>
                                <div class="mt-2">
                                    <span class="text-muted text-decoration-line-through">$120</span>
                                    <span class="fw-bold price ms-2">$99<span class="mx-2 discount">(-17%)</span></span>
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
                                <button class="btn secondary-btn w-50">Add to Cart</button>
                                <button class="btn primary-btn w-50">♡ Wishlist</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{--  --}}
    </section>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            // Banner Slick
            $('.head-slider').slick({
                centerMode: true,
                centerPadding: '10px',
                slidesToShow: 1,
                autoplay: true,
                arrows: false,
                autoplaySpeed: 3000,
                dots: true,
                speed: 800,
                infinite: true,
            });
        });

        $(document).ready(function() {
            $('.category_carousel').slick({
                centerMode: false,
                centerPadding: '20px',
                slidesToShow: 6,
                autoplay: false, // Auto scroll বন্ধ
                infinite: false, // শেষ হলে থেমে যাবে
                arrows: false,
                dots: false,
                draggable: true, // Mouse দিয়ে drag করা যাবে
                swipe: true, // Touch swipe করা যাবে
                touchMove: true, // টাচে মুভ হবে
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        });
    </script>
@endsection
