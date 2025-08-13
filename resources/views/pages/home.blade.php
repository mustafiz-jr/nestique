@extends('layouts.app')
@section('css')
    <style>
        .category-card {
            border: 1px solid var(--color-dark);
            padding: 15px;
            height: 170px !important;
            width: 170px !important;
            display: flex !important;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            text-decoration: none;
            margin: 0px 5px;
        }

        .category-icon-circle {
            height: 60px;
            width: 60px;
        }

        .category-icon {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .category-title {
            color: var(--color-dark);
            font-weight: 600;
        }

        .category-card:hover {
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            border: 1px solid var(--color-secondary);
        }

        .category-card:hover .category-title {
            color: var(--color-secondary);
        }
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
            <div class="col-md-8 banner"><img src="{{ asset('assets/frontend/images/banner_men.jpg') }}" alt="banner_1">
                <h2 class="banner-title" style="color:#FF4F0F; ">Men</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-4 banner"><img src="{{ asset('assets/frontend/images/banner_kid.png') }}" alt="banner_1">
                <h2 class="banner-title" style="color:#FFA673; ">Kids</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-4 banner"><img src="{{ asset('assets/frontend/images/banner_women.jpeg') }}" alt="banner_1">
                <h2 class="banner-title" style="color:#FFA673">Women</h2>
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
            <div class="col-md-8 banner"><img src="{{ asset('assets/frontend/images/banner_dis.jpg') }}" alt="banner_1">
                <a href="" class="banner_shop_btn">Shop Now</a>
            </div>
        </div>

        <!-- Category Carousel -->
        <div class="row container m-auto my-5 ">
            <h2 class="mb-3">Top Categories</h2>
            <div class="w-25 title-border"></div>
            <div class="col-md-12">
                <div class="category_carousel py-3">
                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/pant_category.png') }}" alt="Category"
                                class="category-icon">
                        </div>
                        <p class="category-title">Jeans</p>
                    </a>
                    <!-- Men -->
                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/polo-shirt.png') }}" alt="T-Shirts"
                                class="category-icon">
                        </div>
                        <p class="category-title">T-Shirts & Polos</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/shirt.png') }}" alt="Shirts" class="category-icon">
                        </div>
                        <p class="category-title">Shirts</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/trouser.png') }}" alt="Jeans"
                                class="category-icon">
                        </div>
                        <p class="category-title">Jeans & Trousers</p>
                    </a>

                    <!-- Women -->
                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/dresses.png') }}" alt="Dresses"
                                class="category-icon">
                        </div>
                        <p class="category-title">Dresses</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/saaree.png') }}" alt="Sarees"
                                class="category-icon">
                        </div>
                        <p class="category-title">Sarees</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/kurta.png') }}" alt="Kurtis"
                                class="category-icon">
                        </div>
                        <p class="category-title">Kurtis & Tunics</p>
                    </a>

                    <!-- Kids -->
                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/boy_cloth.png') }}" alt="Boys' Clothing"
                                class="category-icon">
                        </div>
                        <p class="category-title">Boys' Clothing</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/girl_cloth.png') }}" alt="Girls' Clothing"
                                class="category-icon">
                        </div>
                        <p class="category-title">Girls' Clothing</p>
                    </a>

                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/shoes.png') }}" alt="Kids Footwear"
                                class="category-icon">
                        </div>
                        <p class="category-title"> Footwear</p>
                    </a>

                    <!-- Accessories -->
                    <a href="" class="category-card">
                        <div class="category-icon-circle">
                            <img src="{{ asset('assets/frontend/images/bags.png') }}" alt="Bags"
                                class="category-icon">
                        </div>
                        <p class="category-title">Bags & Backpacks</p>
                    </a>

                </div>
            </div>
        </div>

        <div class="container my-5">
            <h2 class="my-3">Hot Deals</h2>
            <div class="w-25 title-border"></div>
            <div class="row g-3">
                @include('components.product')
                @include('components.product')
                @include('components.product')
                @include('components.product')
            </div>
        </div>
        <br>
        <div class="container my-5">
            <h2 class="my-3">New Arrival</h2>
            <div class="w-25 title-border"></div>
            <div class="row g-3">
                @include('components.product')
                @include('components.product')
                @include('components.product')
                @include('components.product')
            </div>
        </div>
        <br>
        <div class="container my-5">
            <h2 class="my-3">Best Selling Products</h2>
            <div class="w-25 title-border"></div>
            <div class="row g-3">
                @include('components.product')
                @include('components.product')
                @include('components.product')
                @include('components.product')
            </div>
        </div>

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
