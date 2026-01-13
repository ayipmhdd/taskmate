<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskMate - Transform Your Productivity</title>
    <meta name="description"
        content="TaskMate helps teams and individuals manage tasks efficiently with powerful features, real-time collaboration, and intelligent insights.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|space-grotesk:700" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
            scroll-behavior: smooth;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #FDFDFC;
            color: #1f2937;
        }

        /* --- FRAME LOGIC --- */
        .page-frame-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 9999;
        }

        .frame-border {
            position: absolute;
            background: white;
        }

        .frame-border-left {
            top: 70px;
            left: 0;
            bottom: 0;
            width: 20px;
        }

        .frame-border-right {
            top: 70px;
            right: 0;
            bottom: 0;
            width: 20px;
        }

        .frame-border-bottom {
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            opacity: 0;
        }

        .frame-border-bottom.visible {
            opacity: 1;
        }

        .page-border {
            position: fixed;
            top: 70px;
            left: 20px;
            right: 20px;
            bottom: 0;
            border-left: 2px solid #1b1b18;
            border-right: 2px solid #1b1b18;
            border-top: 2px solid #1b1b18;
            border-bottom: none;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            pointer-events: none;
            z-index: 10000;
            transition: none !important;
        }

        .page-border.at-footer {
            bottom: 20px;
            border-bottom: 2px solid #1b1b18;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10001;
            height: 70px;
        }

        .nav-container {
            max-width: 100%;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 900;
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 0.625rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
            font-size: 0.9375rem;
            cursor: pointer;
        }

        .btn-login {
            color: #4b5563;
            position: relative;
        }

        .btn-login:hover {
            color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
        }

        /* --- CONTENT WRAPPER --- */
        .content-wrapper {
            max-width: 100%;
            margin: 0 auto;
            padding-top: 70px;
            padding-left: 0;
            padding-right: 0;
            position: relative;
        }

        /* --- HERO SECTION --- */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 7rem 2rem;
            border-radius: 0;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.4;
        }

        .hero-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -1.5px;
        }

        .hero-content h1 .highlight {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2.5rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-white {
            background: white;
            color: #667eea;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }

        /* Task Preview */
        .task-preview {
            background: white;
            border-radius: 1.25rem;
            padding: 2.5rem;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(1deg);
            }
        }

        .task-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }

        .task-preview-title {
            font-weight: 700;
            font-size: 1.125rem;
            color: #1f2937;
        }

        .task-count {
            background: #667eea;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .task-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 0.875rem;
            border-left: 4px solid;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .task-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .task-item.completed {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-color: #10b981;
        }

        .task-item.pending {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #3b82f6;
        }

        .task-item.upcoming {
            background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
            border-color: #8b5cf6;
        }

        .task-checkbox {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .task-item.completed .task-checkbox {
            background: #10b981;
            border-color: #10b981;
            position: relative;
        }

        .task-item.completed .task-checkbox::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .task-text {
            flex: 1;
            font-weight: 500;
            color: #374151;
        }

        .task-item.completed .task-text {
            text-decoration: line-through;
            opacity: 0.7;
        }

        /* --- STATS SECTION --- */
        .stats {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            padding: 4rem 2rem;
            border-radius: 24px;
            margin-bottom: 4rem;
        }

        .stats-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        /* --- FEATURES SECTION --- */
        .features {
            padding: 5rem 2rem;
            background: white;
            border-radius: 24px;
            margin-bottom: 4rem;
        }

        .features-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 4rem;
        }

        .features-header h2 {
            font-size: 3rem;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #1f2937 0%, #667eea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .features-header p {
            font-size: 1.125rem;
            color: #6b7280;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .feature-card {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            padding: 2.5rem;
            border-radius: 1.25rem;
            border: 2px solid #e5e7eb;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.25);
            background: white;
            border-color: #667eea;
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .feature-card h3 {
            font-size: 1.375rem;
            font-weight: 700;
            margin-bottom: 0.875rem;
            color: #1f2937;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.7;
            font-size: 0.9375rem;
        }

        /* --- TESTIMONIALS SECTION --- */
        .testimonials {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 24px;
            margin-bottom: 4rem;
        }

        .testimonials-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .testimonials-header h2 {
            font-size: 3rem;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: white;
            padding: 2.5rem;
            border-radius: 1.25rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .testimonial-stars {
            color: #fbbf24;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .testimonial-text {
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
        }

        .author-info h4 {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .author-info p {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* --- CTA SECTION --- */
        .cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 6rem 2rem;
            border-radius: 0;
            text-align: center;
            color: white;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        .cta-container {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 3.5rem;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .cta p {
            font-size: 1.375rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        /* --- FOOTER --- */
        .footer {
            background: #FDFDFC;
            color: #1f2937;
            padding: 4rem 40px 2rem;
            position: relative;
            z-index: 10001;
            margin-top: 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
            max-width: 1280px;
        }

        .footer-brand h3 {
            font-size: 1.75rem;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .footer-brand p {
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.125rem;
        }

        .social-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-3px);
        }

        .footer-section h4 {
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: #1f2937;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.75rem;
        }

        .footer-section a {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }

        .footer-section a:hover {
            color: #667eea;
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 2px solid #e5e7eb;
            padding-top: 2rem;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .hero-content h1 {
                font-size: 3rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid,
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .features-header h2,
            .testimonials-header h2,
            .cta h2 {
                font-size: 2rem;
            }

            .stats-grid,
            .features-grid,
            .testimonials-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .content-wrapper,
            .footer {
                padding-left: 25px;
                padding-right: 25px;
            }

            .nav-container {
                padding: 0 20px;
            }

            .hero,
            .stats,
            .features,
            .testimonials,
            .cta {
                padding: 3rem 1.5rem;
            }
        }

        /* Scroll animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>
</head>

<body>
    <div class="page-frame-container">
        <div class="frame-border frame-border-left"></div>
        <div class="frame-border frame-border-right"></div>
        <div class="frame-border frame-border-bottom"></div>
    </div>
    <div class="page-border"></div>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">TaskMate</div>

            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <div class="content-wrapper">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <h1>Transform Your<br><span class="highlight">Productivity</span></h1>
                    <p>Empower your team with intelligent task management, real-time collaboration, and actionable
                        insights that drive results.</p>
                    <div class="hero-buttons">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-white">Start Free Today</a>
                        @endif
                        <a href="#features" class="btn btn-outline">Explore Features</a>
                    </div>
                </div>
                <div class="task-preview">
                    <div class="task-preview-header">
                        <span class="task-preview-title">Today's Tasks</span>
                        <span class="task-count">3 tasks</span>
                    </div>
                    <div class="task-item completed">
                        <div class="task-checkbox"></div>
                        <span class="task-text">Complete project proposal</span>
                    </div>
                    <div class="task-item pending">
                        <div class="task-checkbox"></div>
                        <span class="task-text">Review team feedback</span>
                    </div>
                    <div class="task-item upcoming">
                        <div class="task-checkbox"></div>
                        <span class="task-text">Prepare presentation slides</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">2M+</div>
                    <div class="stat-label">Tasks Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4.9/5</div>
                    <div class="stat-label">User Rating</div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features">
            <div class="features-header">
                <h2>Everything You Need</h2>
                <p>Powerful features designed to help you and your team stay organized, focused, and productive.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">✨</div>
                    <h3>Smart Task Management</h3>
                    <p>Create, organize, and prioritize tasks with intelligent categorization and custom workflows
                        tailored to your needs.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Real-Time Collaboration</h3>
                    <p>Work seamlessly with your team. Share tasks, assign responsibilities, and track progress
                        together
                        in real-time.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Advanced Analytics</h3>
                    <p>Gain deep insights into productivity patterns with comprehensive reports, charts, and
                        performance
                        metrics.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔔</div>
                    <h3>Intelligent Reminders</h3>
                    <p>Never miss a deadline with smart notifications that adapt to your schedule and work patterns.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Goal Tracking</h3>
                    <p>Set and monitor goals with visual progress indicators and milestone celebrations to keep you
                        motivated.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Enterprise Security</h3>
                    <p>Bank-level encryption and security protocols ensure your data is always protected and
                        private.
                    </p>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials">
            <div class="testimonials-header">
                <h2>Loved by Teams Worldwide</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"TaskMate transformed how our team collaborates. We've increased
                        productivity by 40% in just 3 months!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">SM</div>
                        <div class="author-info">
                            <h4>Sarah Mitchell</h4>
                            <p>Product Manager, TechCorp</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"The best task management tool I've used. Intuitive, powerful, and
                        actually helps me get things done."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">JD</div>
                        <div class="author-info">
                            <h4>James Davidson</h4>
                            <p>Freelance Designer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p class="testimonial-text">"Finally, a tool that adapts to our workflow instead of forcing us
                        to
                        adapt. Game changer for our startup!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">MR</div>
                        <div class="author-info">
                            <h4>Maria Rodriguez</h4>
                            <p>CEO, InnovateLab</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Boost Your Productivity?</h2>
            <p>Join thousands of teams and individuals who are already achieving more with TaskMate. Start your
                free
                trial today—no credit card required.</p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-white">Get Started Free</a>
            @endif
        </div>
    </section>

    <footer id="main-footer" class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>TaskMate</h3>
                <p>Empowering teams and individuals to achieve more through intelligent task management and
                    collaboration.</p>
                <div class="social-links">
                    <a href="#" class="social-link">𝕏</a>
                    <a href="#" class="social-link">in</a>
                    <a href="#" class="social-link">f</a>
                    <a href="#" class="social-link">📧</a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Product</h4>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Integrations</a></li>
                    <li><a href="#">Changelog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} TaskMate. All rights reserved. Built with ❤️ for productivity enthusiasts.
            </p>
        </div>
    </footer>

    <script>
        // Frame border animation
        function updateFrame() {
            const footer = document.getElementById('main-footer');
            const pageBorder = document.querySelector('.page-border');
            const bottomFrame = document.querySelector('.frame-border-bottom');

            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            if (footerRect.top < windowHeight) {
                const gap = windowHeight - footerRect.top;

                pageBorder.classList.add('at-footer');
                bottomFrame.classList.add('visible');

                pageBorder.style.bottom = (gap + 20) + 'px';
                bottomFrame.style.height = (gap + 20) + 'px';
            } else {
                pageBorder.classList.remove('at-footer');
                bottomFrame.classList.remove('visible');
                pageBorder.style.bottom = '0px';
                bottomFrame.style.height = '20px';
            }

            requestAnimationFrame(updateFrame);
        }

        requestAnimationFrame(updateFrame);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
