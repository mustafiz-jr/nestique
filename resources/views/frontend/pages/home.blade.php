@extends('frontend.layouts.app')
@section('css')
    <style>
        /* Category Carousel */
        .category_carousel {
            padding: 20px 0;
        }

        .swiper-slide {
            background: transparent !important;
        }

        .category-card {
            display: block;
            text-align: center;
            text-decoration: none;
            color: var(--color-dark);
            padding: 10px;
            background: transparent;
            border-radius: 50%;
            height: 150px !important;
            width: 150px !important;
        }

        .category-card:hover {
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }

        .category-icon-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            /* background: var(--color-primary); */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .category-title {
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
        }

        .category-card:hover .category-title {
            color: var(--color-accent);
        }

        .swiper-slide::after {
            background: transparent !important;
        }
    </style>
@endsection


@section('content')
    <section>
        <div>
            @include('frontend.components.carousel')
        </div>
        <!-- Category Carousel -->
        <div class="row container m-auto my-5">
            <h2 class="mb-3">Top Categories</h2>
            <div class="w-25 title-border"></div>
            <div class="col-md-12 position-relative">
                <div class="category_carousel swiper">
                    <div class="swiper-wrapper">
                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/pant_category.png') }}" alt="Category"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Jeans</p>
                        </a>
                        <!-- Men -->
                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/polo-shirt.png') }}" alt="T-Shirts"
                                    class="category-icon">
                            </div>
                            <p class="category-title">T-Shirts & Polos</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/shirt.png') }}" alt="Shirts"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Shirts</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/trouser.png') }}" alt="Jeans"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Jeans & Trousers</p>
                        </a>

                        <!-- Women -->
                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/dresses.png') }}" alt="Dresses"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Dresses</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/saaree.png') }}" alt="Sarees"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Sarees</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/kurta.png') }}" alt="Kurtis"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Kurtis & Tunics</p>
                        </a>

                        <!-- Kids -->
                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/boy_cloth.png') }}" alt="Boys' Clothing"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Boys' Clothing</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/girl_cloth.png') }}" alt="Girls' Clothing"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Girls' Clothing</p>
                        </a>

                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/shoes.png') }}" alt="Kids Footwear"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Footwear</p>
                        </a>

                        <!-- Accessories -->
                        <a href="" class="category-card swiper-slide">
                            <div class="category-icon-circle">
                                <img src="{{ asset('assets/frontend/images/bags.png') }}" alt="Bags"
                                    class="category-icon">
                            </div>
                            <p class="category-title">Bags & Backpacks</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <h2 class="my-3">Hot Deals</h2>
            <div class="w-25 title-border"></div>
            <div class="d-flex gap-4 g-3">
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
            </div>
        </div>
        <br>
        <div class="container my-5">
            <h2 class="my-3">New Arrival</h2>
            <div class="w-25 title-border"></div>
            <div class="d-flex gap-4 g-3">
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
            </div>
        </div>
        <br>
        <div class="container my-5">
            <h2 class="my-3">Best Selling Products</h2>
            <div class="w-25 title-border"></div>
            <div class="d-flex gap-4 g-3">
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
                @include('frontend.components.product')
            </div>
        </div>
        <br>
        <div class="container card p-3  ">
            @include('frontend.components.policy')
        </div>
        <br>

    </section>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Category Carousel
            new Swiper('.category_carousel', {
                slidesPerView: 6,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    576: {
                        slidesPerView: 3,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 15
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>
@endsection
