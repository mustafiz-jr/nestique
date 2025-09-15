    <style>
        .swiper-container {
            width: 100%;
            height: 80vh;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .swiper-slide {
            position: relative;
            overflow: hidden;
            background: var(--color-dark);
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            opacity: 0.9;
        }

        .slide-content {
            position: absolute;
            bottom: 10%;
            left: 8%;
            width: 84%;
            z-index: 2;
            text-align: left;
        }

        .slide-title {
            font-family: var(--secondary-font);
            font-size: 2.5rem;
            font-weight: 500;
            color: var(--color-dark);
            margin-bottom: 1rem;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.1s;
        }

        .slide-subtitle {
            font-family: var(--primary-font);
            font-size: 1rem;
            color: var(--color-dark);
            margin-bottom: 2rem;
            max-width: 500px;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.2s;
        }

        .shop-now-btn {
            display: inline-flex;
            align-items: center;
            padding: 14px 32px;
            background-color: var(--color-accent);
            color: var(--color-light);
            font-family: var(--primary-font);
            font-weight: 500;
            text-decoration: none;
            border-radius: 2px;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.85rem;
            position: relative;
            overflow: hidden;
            border: none;
        }

        .shop-now-btn::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-accent);
            transition: width 0.4s ease;
        }

        .shop-now-btn:hover {
            background-color: var(--color-secondary);
            color: var(--color-light);
        }

        .shop-now-btn:hover::before {
            width: 100%;
        }

        .shop-now-btn::after {
            content: '→';
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .shop-now-btn:hover::after {
            transform: translateX(4px);
            color: var(--color-light);
        }

        .swiper-slide:hover .slide-title,
        .swiper-slide:hover .slide-subtitle,
        .swiper-slide:hover .shop-now-btn {
            transform: translateY(0);
            opacity: 1;
        }

        .swiper-slide::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(to top, rgba(34, 34, 34, 0.9) 0%, rgba(34, 34, 34, 0) 100%);
            z-index: 1;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--color-light);
            background: var(--color-accent);
            width: 60px;
            height: 60px;
            border-radius: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--color-secondary);
            color: var(--color-tertiary);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .swiper-pagination-bullet {
            background: var(--color-light);
            opacity: 0.6;
            width: 10px;
            height: 10px;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: var(--color-secondary);
            opacity: 1;
            width: 30px;
            border-radius: 4px;
        }
    </style>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('assets/frontend/images/banner_men.jpg') }}" alt="Men's Fashion">
                <div class="slide-content">
                    <h2 class="slide-title">Men's Fashion</h2>
                    <p class="slide-subtitle">Elevate Your Wardrobe with Timeless Looks</p>
                    <a href="#" class="shop-now-btn">Shop Now</a>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/frontend/images/banner_women.jpeg') }}" alt="Women's Fashion">
                <div class="slide-content">
                    <h2 class="slide-title">Women's Fashion</h2>
                    <p class="slide-subtitle">Style that moves with you.
                        Comfort, confidence, and cool vibes</p>
                    <a href="#" class="shop-now-btn">Shop Now</a>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/frontend/images/banner_dis.jpg') }}" alt="Signature Style">
                <div class="slide-content">
                    <h2 class="slide-title">Style Steals Are On</h2>
                    <p class="slide-subtitle">Shop the trend. Save in style.
                        Up to 50% off fashion must-haves!</p>
                    <a href="#" class="shop-now-btn">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                slidesPerView: 1,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                on: {
                    init: function() {
                        document.querySelector('.swiper-slide-active .slide-title').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .slide-title').style.opacity = '1';
                        document.querySelector('.swiper-slide-active .slide-subtitle').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .slide-subtitle').style.opacity =
                            '1';
                        document.querySelector('.swiper-slide-active .shop-now-btn').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .shop-now-btn').style.opacity =
                            '1';
                    },
                    slideChangeTransitionStart: function() {
                        const slides = document.querySelectorAll('.swiper-slide');
                        slides.forEach(slide => {
                            slide.querySelector('.slide-title').style.transform =
                                'translateY(30px)';
                            slide.querySelector('.slide-title').style.opacity = '0';
                            slide.querySelector('.slide-subtitle').style.transform =
                                'translateY(30px)';
                            slide.querySelector('.slide-subtitle').style.opacity = '0';
                            slide.querySelector('.shop-now-btn').style.transform =
                                'translateY(30px)';
                            slide.querySelector('.shop-now-btn').style.opacity = '0';
                        });
                    },
                    slideChangeTransitionEnd: function() {
                        document.querySelector('.swiper-slide-active .slide-title').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .slide-title').style.opacity = '1';
                        document.querySelector('.swiper-slide-active .slide-subtitle').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .slide-subtitle').style.opacity =
                            '1';
                        document.querySelector('.swiper-slide-active .shop-now-btn').style.transform =
                            'translateY(0)';
                        document.querySelector('.swiper-slide-active .shop-now-btn').style.opacity =
                            '1';
                    }
                }
            });
        });
    </script>
