@extends('frontend.layouts.app')
@section('css')
    <style>
        .nestique-about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
        }

        .nestique-about-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .nestique-about-header h1 {
            font-family: var(--secondary-font);
            font-size: 3.5rem;
            color: var(--color-accent);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .nestique-about-header p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
            color: var(--color-dark);
        }

        .nestique-about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .nestique-about-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .nestique-about-text h2 {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 20px;
            position: relative;
        }

        .nestique-about-text h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--color-secondary);
        }

        .nestique-about-text p {
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .nestique-mission-vision {
            padding: 60px 0;
            text-align: center;
            background-color: var(--color-primary);
            margin: 60px 0;
            border-radius: 8px;
        }

        .nestique-mission-vision h2 {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-secondary);
            margin-bottom: 20px;
        }

        .nestique-mission-vision p {
            font-size: 1.1rem;
            max-width: 900px;
            margin: 0 auto 30px auto;
        }

        /* Mission Cards and Slider */
        .nestique-mission-slider {
            margin-top: 40px;
            padding: 0 40px;
            /* Add padding for arrows */
        }

        .nestique-mission-card {
            background-color: var(--color-light);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: left;
            transition: transform 0.3s ease;
            margin: 0 10px;
            /* Add margin for spacing between cards in the slider */
        }

        .nestique-mission-card:hover {
            transform: translateY(-5px);
        }

        .nestique-mission-card h3 {
            font-family: var(--primary-font);
            font-size: 1.2rem;
            color: var(--color-accent);
            margin-bottom: 10px;
        }

        .nestique-mission-card p {
            font-size: 0.95rem;
            color: var(--color-dark);
        }

        .nestique-cta {
            text-align: center;
            padding: 80px 20px;
            background-color: var(--color-primary);
            margin-top: 60px;
        }

        .nestique-cta h2 {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 20px;
        }

        .nestique-cta a {
            display: inline-block;
            background-color: var(--color-secondary);
            color: var(--color-light);
            padding: 15px 40px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nestique-cta a:hover {
            background-color: var(--color-accent);
        }

        /* Testimonials Section */
        .nestique-testimonials-section {
            text-align: center;
            padding: 80px 20px;
        }

        .nestique-testimonials-section h2 {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .nestique-testimonials-section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: var(--color-secondary);
        }

        /* Slick Carousel Custom Styling */
        .slick-prev:before,
        .slick-next:before {
            color: var(--color-accent) !important;
            font-size: 30px !important;
        }

        .slick-prev,
        .slick-next {
            z-index: 10;
        }

        .slick-prev {
            left: -25px;
        }

        .slick-next {
            right: -25px;
        }

        .nestique-testimonial-card {
            background-color: var(--color-primary);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 0 10px;
            /* Add some margin for the carousel items */
        }

        .nestique-testimonial-quote {
            font-family: var(--secondary-font);
            font-size: 1.2rem;
            font-style: italic;
            color: var(--color-dark);
            margin-bottom: 20px;
        }

        .nestique-testimonial-author {
            font-weight: 600;
            color: var(--color-accent);
            font-size: 1rem;
        }

        @media (max-width: 992px) {
            .nestique-about-content {
                grid-template-columns: 1fr;
            }

            .nestique-about-image {
                order: 2;
            }

            .nestique-about-text {
                order: 1;
            }

            /* Slick on smaller screens */
            .nestique-mission-slider .slick-prev {
                left: -15px;
            }

            .nestique-mission-slider .slick-next {
                right: -15px;
            }
        }

        @media (max-width: 768px) {
            .nestique-about-header h1 {
                font-size: 2.5rem;
            }

            .nestique-about-text h2,
            .nestique-mission-vision h2,
            .nestique-cta h2,
            .nestique-testimonials-section h2 {
                font-size: 2rem;
            }

            .nestique-about-container {
                padding: 60px 15px;
            }

            /* Adjust Slick on smaller screens */
            .slick-prev {
                left: 0;
            }

            .slick-next {
                right: 0;
            }
        }
    </style>
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
@endsection

@section('content')
    <div class="nestique-about-container">
        <div class="nestique-about-header">
            <h1>Our Story</h1>
            <p>Welcome to Nestique, a haven for those who believe that a home is more than just a place to live—it's a
                curated collection of moments and objects that tell your unique story. We are dedicated to bringing
                elegance and warmth into every corner of your life.</p>
        </div>

        <div class="nestique-about-content">
            <div class="nestique-about-image">
                <!-- Placeholder for a beautiful lifestyle image. Replace with a real image URL. -->
                <img src="https://placehold.co/800x600/ac8e51/ffffff?text=Nestique+Lifestyle"
                    alt="A beautifully decorated living space">
            </div>
            <div class="nestique-about-text">
                <h2>The Nestique Philosophy</h2>
                <p>
                    Nestique was founded on the belief that true luxury lies in simplicity and thoughtful design. Our
                    journey began with a passion for discovering unique pieces that blend timeless craftsmanship with
                    modern aesthetics. From cozy textiles to handcrafted furniture, every item in our collection is
                    chosen for its quality, beauty, and ability to transform a house into a home. We work with artisans
                    and designers who share our commitment to excellence and sustainability, ensuring that each product
                    has a story worth telling.
                </p>
                <p>
                    We believe that creating a beautiful space should be an inspiring and effortless experience. Our
                    goal is to provide you with a carefully curated selection of home decor, kitchenware, and lifestyle
                    goods that resonate with your personal style. We're here to help you build a nest that reflects who
                    you are—a sanctuary of comfort, elegance, and peace.
                </p>
            </div>
        </div>

        <div class="nestique-mission-vision">
            <h2>Our Mission & Values</h2>
            <p>
                At Nestique, our mission is to empower you to create a home that is both beautiful and deeply personal.
                We are guided by three core values:
            </p>
            <div class="nestique-mission-slider">
                <div class="nestique-mission-card">
                    <h3>Curated Quality</h3>
                    <p>We meticulously select every item for its exceptional craftsmanship, premium materials, and enduring
                        design, ensuring you receive only the best.</p>
                </div>
                <div class="nestique-mission-card">
                    <h3>Sustainable Sourcing</h3>
                    <p>We are committed to partnering with ethical creators and using eco-friendly materials, minimizing our
                        impact on the planet with every choice we make.</p>
                </div>
                <div class="nestique-mission-card">
                    <h3>Inspired Living</h3>
                    <p>We believe that your home should be a source of joy and inspiration. Our products are designed to
                        elevate your everyday experiences.</p>
                </div>
            </div>
        </div>

        <div class="nestique-testimonials-section">
            <h2>What Our Customers Say</h2>
            <div class="nestique-testimonials-slider">
                <div class="nestique-testimonial-card">
                    <p class="nestique-testimonial-quote">"Nestique's collection is simply breathtaking. The quality is
                        unmatched, and every piece feels so intentional. My home has never felt more complete."</p>
                    <p class="nestique-testimonial-author">— Sarah L.</p>
                </div>
                <div class="nestique-testimonial-card">
                    <p class="nestique-testimonial-quote">"I was searching for unique home decor and stumbled upon Nestique.
                        Their products are exquisite, and the customer service was fantastic. Highly recommend!"</p>
                    <p class="nestique-testimonial-author">— Michael P.</p>
                </div>
                <div class="nestique-testimonial-card">
                    <p class="nestique-testimonial-quote">"The craftsmanship of the furniture is incredible. It’s clear that
                        Nestique values quality and timeless design. A true gem of a brand."</p>
                    <p class="nestique-testimonial-author">— Jessica H.</p>
                </div>
                <div class="nestique-testimonial-card">
                    <p class="nestique-testimonial-quote">"I'm so impressed with the quality and attention to detail.
                        Nestique has completely transformed my living room into a cozy sanctuary."</p>
                    <p class="nestique-testimonial-author">— Emily R.</p>
                </div>
                <div class="nestique-testimonial-card">
                    <p class="nestique-testimonial-quote">"Beautiful products and a wonderful experience from start to
                        finish. I will definitely be a returning customer!"</p>
                    <p class="nestique-testimonial-author">— John D.</p>
                </div>
            </div>
        </div>

        <div class="nestique-cta">
            <h2>Ready to start your story?</h2>
            <p>Explore our latest collections and find the perfect pieces to make your home uniquely yours.</p>
            <a href="{{ route('shop') }}">Explore Collections</a>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            // Testimonials Slider
            $('.nestique-testimonials-slider').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });

            // Mission & Values Slider
            $('.nestique-mission-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection
