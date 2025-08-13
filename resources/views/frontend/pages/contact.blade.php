@extends('frontend.layouts.app')
@section('css')
    <style>
        .contact-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 80px 40px;
            border-top: 1px solid rgba(172, 142, 81, 0.2);
            border-bottom: 1px solid rgba(172, 142, 81, 0.2);
        }

        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-header h1 {
            font-family: var(--secondary-font);
            font-size: 3rem;
            color: var(--color-accent);
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .contact-header p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            color: var(--color-dark);
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-info {
            padding: 50px;
            background-color: var(--color-light);
            border: 1px solid rgba(172, 142, 81, 0.1);
        }

        .contact-info h2 {
            font-family: var(--secondary-font);
            color: var(--color-accent);
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 500;
            position: relative;
        }

        .contact-info h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--color-secondary);
        }

        .info-item {
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
        }

        .info-icon {
            color: var(--color-secondary);
            font-size: 1.2rem;
            margin-right: 15px;
            margin-top: 4px;
        }

        .info-text h3 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            font-weight: 500;
            color: var(--color-accent);
        }

        .info-text p,
        .info-text a {
            margin: 0;
            color: var(--color-dark);
            text-decoration: none;
            transition: color 0.3s;
        }

        .info-text a:hover {
            color: var(--color-secondary);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .social-link {
            color: var(--color-secondary);
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .social-link:hover {
            color: var(--color-accent);
        }

        .contact-form {
            padding: 50px;
            background-color: var(--color-light);
            border: 1px solid rgba(172, 142, 81, 0.1);
        }

        .contact-form h2 {
            font-family: var(--secondary-font);
            color: var(--color-accent);
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 500;
            position: relative;
        }

        .contact-form h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--color-secondary);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-accent);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border-radius: 0px;
            border: none;
            border-bottom: 1px solid var(--color-secondary);
            background-color: var(--color-light);
            font-family: var(--primary-font);
            font-size: 1rem;
            transition: border 0.3s;
            color: var(--color-dark);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-bottom: 1.59px solid var(--color-accent);
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--color-secondary);
            color: var(--color-light);
            border: none;
            padding: 14px 35px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            background-color: var(--color-accent);
        }

        .contact-map {
            margin-top: 60px;
            border-top: 1px solid rgba(172, 142, 81, 0.2);
            padding-top: 60px;
        }

        .map-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .map-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .map-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .map-header h2 {
            font-family: var(--secondary-font);
            color: var(--color-accent);
            font-size: 2rem;
            font-weight: 600;
        }

        @media (max-width: 1024px) {
            .contact-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                padding: 60px 20px;
            }

            .contact-info,
            .contact-form {
                padding: 30px;
            }

            .contact-header h1 {
                font-size: 2.2rem;
            }

            .submit-btn {
                padding: 10px 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="contact-container">
        <div class="contact-header">
            <h1>Contact Nestique</h1>
            <p>For inquiries about our collections, styling consultations, or collaborations, our team is delighted to
                assist you.</p>
        </div>

        <div class="contact-content">
            <div class="contact-info">
                <h2>Atelier Information</h2>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Boutique Location</h3>
                        <p>451 Fashion Avenue<br>New York, NY 10022</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Contact</h3>
                        <p><a href="tel:+12125550199">+1 (212) 555-0199</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <h3>Email</h3>
                        <p><a href="mailto:concierge@nestique.com">concierge@nestique.com</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-text">
                        <h3>Hours</h3>
                        <p>Monday–Friday: 10am–7pm<br>Saturday: 11am–6pm</p>
                    </div>
                </div>

                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="contact-form">
                <h2>Personal Consultation</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Request Consultation</button>
                </form>
            </div>
        </div>

        <div class="contact-map">
            <div class="map-header">
                <h2>Find Our Boutique</h2>
            </div>
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.3871279313437!2d-73.97405238459461!3d40.75797397932822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258f12a149c95%3A0xf6f3f05d9e5a6f8b!2s451%20Fashion%20Ave%2C%20New%20York%2C%20NY%2010022%2C%20USA!5e0!3m2!1sen!2sbd!4v1628101416979!5m2!1sen!2sbd"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
@endsection
