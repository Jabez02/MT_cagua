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

        .about-page {
            background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
            min-height: 100vh;
            font-family: var(--font-family-body);
            line-height: 1.7;
            color: var(--text-primary);
        }

        .about-container {
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

        .feature-title {
            font-family: var(--font-family-heading);
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
            color: var(--text-primary);
            margin-bottom: var(--spacing-sm);
        }

        .body-text {
            font-size: 1.125rem;
            line-height: 1.7;
            color: var(--text-secondary);
            margin-bottom: var(--spacing-lg);
        }

        .feature-text {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-muted);
            margin-bottom: 0;
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

        /* Feature Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-xl);
            margin-top: var(--spacing-xl);
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-lg);
            padding: var(--spacing-lg);
            background: rgba(255, 255, 255, 0.7);
            border-radius: var(--border-radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: var(--transition);
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            flex-shrink: 0;
            width: 3.5rem;
            height: 3.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: var(--border-radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        /* Commitment List */
        .commitment-list {
            list-style: none;
            padding: 0;
            margin: var(--spacing-lg) 0 0 0;
        }

        .commitment-item {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
            padding: var(--spacing-md) 0;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            transition: var(--transition);
        }

        .commitment-item:last-child {
            border-bottom: none;
        }

        .commitment-item:hover {
            background: rgba(59, 130, 246, 0.05);
            border-radius: var(--border-radius-md);
            padding-left: var(--spacing-md);
            padding-right: var(--spacing-md);
        }

        .commitment-icon {
            flex-shrink: 0;
            width: 1.5rem;
            height: 1.5rem;
            background: var(--success-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
            margin-top: 0.125rem;
        }

        .commitment-text {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about-container {
                padding: var(--spacing-xl) 0;
            }

            .content-card {
                padding: var(--spacing-lg);
                margin-bottom: var(--spacing-lg);
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }

            .feature-item {
                padding: var(--spacing-md);
            }

            .feature-icon {
                width: 3rem;
                height: 3rem;
                font-size: 1.25rem;
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
        .content-card:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        .feature-item:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <div class="about-page">
        <div class="container about-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1 class="page-title">{{ $aboutSettings['about_title'] ?? 'About Mt. Cagua' }}</h1>
                    
                    <div class="content-card">
                        <h2 class="section-title">{{ $aboutSettings['our_story_title'] ?? 'Our Story' }}</h2>
                        <p class="body-text">{!! $aboutSettings['our_story_paragraph_1'] ?? 'Mt. Cagua, located in Gonzaga, Cagayan Valley, is one of the most remarkable hiking destinations in the Philippines. Rising 1,113 meters above sea level, it offers breathtaking views of the Pacific Ocean and the surrounding landscape.' !!}</p>
                        <p class="body-text">{!! $aboutSettings['our_story_paragraph_2'] ?? 'Our mission is to provide safe and memorable hiking experiences while promoting environmental conservation and supporting local communities.' !!}</p>
                    </div>

                    <div class="content-card">
                        <h2 class="section-title">{{ $aboutSettings['why_choose_us_title'] ?? 'Why Choose Us?' }}</h2>
                        <div class="features-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title">{{ $aboutSettings['feature_1_title'] ?? 'Safety First' }}</h3>
                                    <p class="feature-text">{!! $aboutSettings['feature_1_description'] ?? 'Experienced guides and well-maintained trails ensure your safety throughout the journey.' !!}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-people" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title">{{ $aboutSettings['feature_2_title'] ?? 'Expert Guides' }}</h3>
                                    <p class="feature-text">{!! $aboutSettings['feature_2_description'] ?? 'Our professional guides are certified and knowledgeable about the mountain\'s terrain and history.' !!}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-heart" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title">{{ $aboutSettings['feature_3_title'] ?? 'Community Support' }}</h3>
                                    <p class="feature-text">{!! $aboutSettings['feature_3_description'] ?? 'We work closely with local communities to promote sustainable tourism and economic growth.' !!}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-tree" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title">{{ $aboutSettings['feature_4_title'] ?? 'Environmental Care' }}</h3>
                                    <p class="feature-text">{!! $aboutSettings['feature_4_description'] ?? 'We practice and promote responsible hiking to preserve the mountain\'s natural beauty.' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-card">
                        <h2 class="section-title">{{ $aboutSettings['commitment_title'] ?? 'Our Commitment' }}</h2>
                        <p class="body-text">{{ $aboutSettings['commitment_intro'] ?? 'We are committed to:' }}</p>
                        <ul class="commitment-list">
                            <li class="commitment-item">
                                <div class="commitment-icon">
                                    <i class="bi bi-check" aria-hidden="true"></i>
                                </div>
                                <p class="commitment-text">{!! $aboutSettings['commitment_1'] ?? 'Providing safe and enjoyable hiking experiences' !!}</p>
                            </li>
                            <li class="commitment-item">
                                <div class="commitment-icon">
                                    <i class="bi bi-check" aria-hidden="true"></i>
                                </div>
                                <p class="commitment-text">{!! $aboutSettings['commitment_2'] ?? 'Protecting and preserving the mountain environment' !!}</p>
                            </li>
                            <li class="commitment-item">
                                <div class="commitment-icon">
                                    <i class="bi bi-check" aria-hidden="true"></i>
                                </div>
                                <p class="commitment-text">{!! $aboutSettings['commitment_3'] ?? 'Supporting local communities through sustainable tourism' !!}</p>
                            </li>
                            <li class="commitment-item">
                                <div class="commitment-icon">
                                    <i class="bi bi-check" aria-hidden="true"></i>
                                </div>
                                <p class="commitment-text">{!! $aboutSettings['commitment_4'] ?? 'Educating visitors about environmental conservation' !!}</p>
                            </li>
                            <li class="commitment-item">
                                <div class="commitment-icon">
                                    <i class="bi bi-check" aria-hidden="true"></i>
                                </div>
                                <p class="commitment-text">{!! $aboutSettings['commitment_5'] ?? 'Maintaining high standards of service and safety' !!}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>