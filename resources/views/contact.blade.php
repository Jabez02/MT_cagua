<x-front-layout>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #059669;
            --success-light: #10b981;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --border-radius-sm: 0.375rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
            --spacing-3xl: 4rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-family-heading: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            --font-family-body: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Import Inter font for professional typography */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        .contact-page {
            background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
            min-height: 100vh;
            font-family: var(--font-family-body);
            line-height: 1.7;
            color: var(--text-primary);
        }

        .contact-container {
            padding: var(--spacing-3xl) 0;
        }

        /* Typography Hierarchy */
        .page-title {
            font-family: var(--font-family-heading);
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-primary);
            text-align: center;
            margin-bottom: var(--spacing-2xl);
            position: relative;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 4rem;
            height: 0.25rem;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            border-radius: 2px;
        }

        .section-title {
            font-family: var(--font-family-heading);
            font-size: 1.875rem;
            font-weight: 700;
            line-height: 1.3;
            color: var(--text-primary);
            margin-bottom: var(--spacing-lg);
            position: relative;
            padding-left: var(--spacing-md);
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 0.25rem;
            height: 2rem;
            background: linear-gradient(180deg, var(--primary-color), var(--primary-light));
            border-radius: 2px;
        }

        .subsection-title {
            font-family: var(--font-family-heading);
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
            color: var(--text-primary);
            margin-bottom: var(--spacing-md);
        }

        .body-text {
            font-size: 1.125rem;
            line-height: 1.7;
            color: var(--text-secondary);
            margin-bottom: var(--spacing-lg);
        }

        /* Enhanced Cards */
        .content-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            padding: var(--spacing-2xl);
            margin-bottom: var(--spacing-2xl);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0.25rem;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light), var(--success-color));
        }

        .content-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* Contact Information */
        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            padding: var(--spacing-md);
            background: rgba(59, 130, 246, 0.05);
            border-radius: var(--border-radius-lg);
            border-left: 0.25rem solid var(--primary-color);
            transition: var(--transition);
        }

        .contact-info-item:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: translateX(0.25rem);
        }

        .contact-info-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            flex-shrink: 0;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: var(--border-radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
            box-shadow: var(--shadow-md);
        }

        .contact-info-text {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Enhanced Form Styling */
        .contact-form {
            background: var(--card-bg);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            padding: var(--spacing-2xl);
            position: relative;
            overflow: hidden;
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0.25rem;
            background: linear-gradient(90deg, var(--success-color), var(--primary-color), var(--primary-light));
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-label {
            font-family: var(--font-family-heading);
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--spacing-sm);
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: var(--spacing-md) var(--spacing-lg);
            font-size: 1rem;
            line-height: 1.5;
            color: var(--text-primary);
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-lg);
            transition: var(--transition);
            font-family: var(--font-family-body);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background: white;
        }

        .form-control:hover {
            border-color: var(--primary-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        /* Enhanced Button */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
            color: white;
            padding: var(--spacing-md) var(--spacing-2xl);
            font-size: 1rem;
            font-weight: 600;
            font-family: var(--font-family-heading);
            border-radius: var(--border-radius-lg);
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        /* FAQ Accordion */
        .faq-accordion {
            background: var(--card-bg);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            overflow: hidden;
            position: relative;
        }

        .faq-accordion::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0.25rem;
            background: linear-gradient(90deg, var(--warning-color), var(--primary-color), var(--success-color));
        }

        .accordion-item {
            border: none;
            border-bottom: 1px solid var(--border-color);
        }

        .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-header {
            margin: 0;
        }

        .accordion-button {
            background: transparent;
            border: none;
            padding: var(--spacing-lg) var(--spacing-xl);
            font-family: var(--font-family-heading);
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            text-align: left;
            width: 100%;
            transition: var(--transition);
            position: relative;
        }

        .accordion-button:hover {
            background: rgba(59, 130, 246, 0.05);
            color: var(--primary-color);
        }

        .accordion-button:focus {
            outline: none;
            box-shadow: inset 0 0 0 2px var(--primary-color);
        }

        .accordion-button:not(.collapsed) {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        .accordion-button::after {
            content: '';
            position: absolute;
            right: var(--spacing-xl);
            top: 50%;
            transform: translateY(-50%);
            width: 1.5rem;
            height: 1.5rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 1.25rem;
            transition: var(--transition);
            border-radius: var(--border-radius);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232563eb'%3e%3cpath fill-rule='evenodd' d='M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z'/%3e%3c/svg%3e");
            transform: translateY(-50%) rotate(0deg);
            background-color: rgba(59, 130, 246, 0.15);
        }

        .accordion-body {
            padding: 0 var(--spacing-xl) var(--spacing-lg) var(--spacing-xl);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-secondary);
        }

        /* Grid Layout */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-2xl);
            margin-bottom: var(--spacing-2xl);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                padding: var(--spacing-xl) 0;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }

            .content-card,
            .contact-form {
                padding: var(--spacing-lg);
                margin-bottom: var(--spacing-lg);
            }

            .contact-info-item {
                padding: var(--spacing-sm);
            }

            .contact-icon {
                width: 2rem;
                height: 2rem;
                font-size: 1rem;
            }

            /* FAQ Accordion Mobile Optimizations */
            .faq-accordion {
                margin: var(--spacing-lg) 0;
                border-radius: var(--border-radius-lg);
            }

            .accordion-button {
                padding: var(--spacing-md) var(--spacing-lg);
                font-size: 0.95rem;
                line-height: 1.4;
                text-align: left;
                word-wrap: break-word;
                hyphens: auto;
            }

            .accordion-button::after {
                width: 1rem;
                height: 1rem;
                background-size: 0.875rem;
                right: var(--spacing-sm);
                flex-shrink: 0;
            }

            .accordion-body {
                padding: var(--spacing-md) var(--spacing-lg) var(--spacing-lg) var(--spacing-lg);
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .section-title {
                font-size: 1.5rem;
                margin-bottom: var(--spacing-md);
                padding-left: var(--spacing-sm);
            }

            .section-title::before {
                width: 0.2rem;
                height: 1.5rem;
                top: 0.3rem;
            }
        }

        /* Extra Small Mobile Devices */
        @media (max-width: 480px) {
            .page-title {
                font-size: clamp(2rem, 8vw, 2.5rem);
                margin-bottom: var(--spacing-lg);
            }

            .faq-accordion {
                margin: var(--spacing-md) 0;
                border-radius: var(--border-radius-md);
            }

            .accordion-button {
                padding: var(--spacing-sm) var(--spacing-md);
                font-size: 0.95rem;
                line-height: 1.3;
                min-height: 3rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .accordion-button::after {
                right: var(--spacing-md);
                font-size: 1.1rem;
                position: static;
                transform: none;
                margin-left: var(--spacing-sm);
            }

            .accordion-button:not(.collapsed)::after {
                transform: none;
            }

            .accordion-body {
                padding: 0 var(--spacing-md) var(--spacing-sm) var(--spacing-md);
                font-size: 0.85rem;
                line-height: 1.4;
            }

            .section-title {
                font-size: 1.25rem;
                margin-bottom: var(--spacing-sm);
                padding-left: var(--spacing-xs);
            }

            .section-title::before {
                width: 0.15rem;
                height: 1.25rem;
                top: 0.2rem;
            }

            .contact-container {
                padding: var(--spacing-lg) 0;
            }

            .content-card,
            .contact-form {
                padding: var(--spacing-md);
                margin-bottom: var(--spacing-md);
            }
        }

        /* Large Mobile Devices and Small Tablets */
        @media (min-width: 481px) and (max-width: 768px) {
            .accordion-button {
                font-size: 1.05rem;
                padding: var(--spacing-lg) var(--spacing-xl);
            }

            .accordion-body {
                font-size: 0.95rem;
                padding: 0 var(--spacing-xl) var(--spacing-lg) var(--spacing-xl);
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .accordion-button {
                min-height: 3.5rem;
                padding: var(--spacing-lg);
                touch-action: manipulation;
            }

            .accordion-button:hover {
                background: transparent;
            }

            .accordion-button:active {
                background: rgba(59, 130, 246, 0.1);
                transform: scale(0.98);
            }

            .faq-accordion {
                box-shadow: var(--shadow-md);
            }
        }

        /* Accessibility Improvements */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus States for Accessibility */
        .content-card:focus-within,
        .contact-form:focus-within,
        .faq-accordion:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        .contact-info-item:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
            border-radius: var(--border-radius-lg);
        }
    </style>

    <div class="contact-page">
        <div class="container contact-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1 class="page-title">{{ $contactSettings['contact_title'] ?? 'Contact Us' }}</h1>

                    <div class="contact-grid">
                        <div class="content-card">
                            <h2 class="section-title">{{ $contactSettings['get_in_touch_title'] ?? 'Get in Touch' }}</h2>
                            
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="subsection-title">Office Address</h3>
                                    <p class="contact-info-text">
                                        {{ $contactSettings['office_address'] ?? 'Gonzaga, Cagayan Valley, Philippines' }}
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="subsection-title">Phone Number</h3>
                                    <p class="contact-info-text">
                                        <a href="tel:{{ $contactSettings['phone_number'] ?? '+63 912 345 6789' }}" class="text-decoration-none" style="color: inherit;">
                                            {{ $contactSettings['phone_number'] ?? '+63 912 345 6789' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="subsection-title">Email Address</h3>
                                    <p class="contact-info-text">
                                        <a href="mailto:{{ $contactSettings['email_address'] ?? 'info@mtcagua.com' }}" class="text-decoration-none" style="color: inherit;">
                                            {{ $contactSettings['email_address'] ?? 'info@mtcagua.com' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-clock" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="subsection-title">Business Hours</h3>
                                    <p class="contact-info-text">
                                        {{ $contactSettings['weekday_hours'] ?? 'Monday - Friday: 8:00 AM - 5:00 PM' }}
                                    </p>
                                    <p class="contact-info-text">
                                        {{ $contactSettings['weekend_hours'] ?? 'Saturday - Sunday: 9:00 AM - 3:00 PM' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="contact-form">
                            <h2 class="section-title">{{ $contactSettings['send_message_title'] ?? 'Send us a Message' }}</h2>
                            
                            <form action="#" method="POST" role="form" aria-label="Contact form">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required 
                                           placeholder="Enter your full name" aria-describedby="name-help">
                                    <div id="name-help" class="sr-only">Please enter your full name</div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required 
                                           placeholder="Enter your email address" aria-describedby="email-help">
                                    <div id="email-help" class="sr-only">Please enter a valid email address</div>
                                </div>

                                <div class="form-group">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required 
                                           placeholder="Enter the subject of your message" aria-describedby="subject-help">
                                    <div id="subject-help" class="sr-only">Please enter the subject of your message</div>
                                </div>

                                <div class="form-group">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" required 
                                              placeholder="Enter your message here..." aria-describedby="message-help"></textarea>
                                    <div id="message-help" class="sr-only">Please enter your message</div>
                                </div>

                                <button type="submit" class="btn-primary" aria-label="Send message">
                                    <i class="bi bi-send me-2" aria-hidden="true"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="faq-accordion">
                        <div style="padding: var(--spacing-xl) var(--spacing-xl) 0;">
                            <h2 class="section-title">{{ $contactSettings['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
                        </div>
                        
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                        {{ $contactSettings['faq1_question'] ?? 'How do I book a hike?' }}
                                    </button>
                                </h3>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $contactSettings['faq1_answer'] ?? 'You can book a hike through our website by selecting your preferred trail and date. Create an account or log in to complete your booking.' }}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                        {{ $contactSettings['faq2_question'] ?? 'What should I bring for the hike?' }}
                                    </button>
                                </h3>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $contactSettings['faq2_answer'] ?? 'Essential items include proper hiking shoes, weather-appropriate clothing, water, snacks, and any personal medications. A detailed list will be provided upon booking.' }}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                        {{ $contactSettings['faq3_question'] ?? 'What is your cancellation policy?' }}
                                    </button>
                                </h3>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $contactSettings['faq3_answer'] ?? 'Cancellations made 48 hours before the scheduled hike are eligible for a full refund. Please refer to our booking terms for more details.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>