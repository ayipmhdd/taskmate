<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskMate - Transform Your Productivity</title>
    <meta name="description"
        content="TaskMate helps teams and individuals manage tasks efficiently with powerful features, real-time collaboration, and intelligent insights.">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/TaskMate.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|space-grotesk:700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Minimal custom CSS for animations and special effects */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(1deg);
            }
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

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-pulse-custom {
            animation: pulse 8s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="h-full font-['Inter',sans-serif] overflow-x-hidden bg-[#FDFDFC] text-gray-800 m-0 p-0 box-border overflow-y-scroll [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

    <!-- Page Frame Container -->
    <div class="fixed top-0 left-0 right-0 bottom-0 pointer-events-none z-[9999]">
        <!-- Left Frame Border -->
        <div class="absolute top-[70px] left-0 bottom-0 w-5 bg-white"></div>

        <!-- Right Frame Border -->
        <div class="absolute top-[70px] right-0 bottom-0 w-5 bg-white"></div>

        <!-- Bottom Frame Border -->
        <div class="frame-border-bottom absolute bottom-0 left-0 right-0 h-5 bg-white opacity-0 transition-opacity">
        </div>
    </div>

    <!-- Page Border -->
    <div
        class="page-border fixed top-[70px] left-5 right-5 bottom-0 border-l-2 border-r-2 border-t-2 border-[#1b1b18] rounded-tl-[20px] rounded-tr-[20px] pointer-events-none z-[10000] transition-none">
    </div>

    <!-- Navbar -->
    <x-navbar>
        @if (Route::has('login'))
            @auth
                <x-button variant="primary" :href="route('dashboard')">
                    Dashboard
                </x-button>
            @else
                <x-button variant="login" :href="route('login')">
                    Log in
                </x-button>

                @if (Route::has('register'))
                    <x-button variant="primary" :href="route('register')">
                        Get Started
                    </x-button>
                @endif
            @endauth
        @endif
    </x-navbar>

    <!-- Content Wrapper -->
    <div class="max-w-full mx-auto pt-[70px] px-0 relative">

        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-[#667eea] to-[#764ba2] py-28 px-8 rounded-none mb-0 before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[url('data:image/svg+xml,%3Csvg%20width=%2760%27%20height=%2760%27%20viewBox=%270%200%2060%2060%27%20xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cg%20fill=%27none%27%20fill-rule=%27evenodd%27%3E%3Cg%20fill=%27%23ffffff%27%20fill-opacity=%270.05%27%3E%3Cpath%20d=%27M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%27/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] before:opacity-40">
            <div class="relative z-[1] max-w-[1280px] mx-auto grid grid-cols-2 gap-20 items-center">
                <!-- Hero Content -->
                <div>
                    <h1
                        class="text-[64px] font-extrabold text-white leading-[1.1] mb-6 font-['Space_Grotesk',sans-serif] tracking-[-1.5px]">
                        Transform Your <span
                            class="bg-gradient-to-br from-[#fbbf24] to-[#f59e0b] bg-clip-text text-transparent">Productivity</span>
                    </h1>
                    <p class="text-xl text-white/95 mb-10 leading-[1.7]">
                        The ultimate task management platform designed for modern teams. Collaborate seamlessly, track
                        progress effortlessly, and achieve your goals faster than ever before.
                    </p>
                    <div class="flex gap-4 flex-wrap">
                        @if (Route::has('register'))
                            <x-button variant="white" :href="route('register')">
                                Start Free Trial
                            </x-button>
                        @endif
                        <x-button variant="outline" href="#features">
                            Explore Features
                        </x-button>
                    </div>
                </div>

                <!-- Task Preview Card -->
                <div class="bg-white rounded-[20px] p-10 shadow-[0_25px_60px_rgba(0,0,0,0.25)] animate-float">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b-2 border-gray-100">
                        <div class="font-bold text-[18px] text-gray-800">My Tasks</div>
                        <div class="bg-[#667eea] text-white px-3 py-1 rounded-2xl text-sm font-semibold">3</div>
                    </div>

                    <!-- Task Items -->
                    <div
                        class="flex items-center gap-4 p-5 rounded-xl mb-3.5 border-l-4 border-[#10b981] bg-gradient-to-br from-[#ecfdf5] to-[#d1fae5] transition-all duration-300 cursor-pointer hover:translate-x-[5px] hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)]">
                        <div
                            class="relative w-6 h-6 rounded-full bg-[#10b981] border-2 border-[#10b981] flex-shrink-0 transition-all duration-300 after:content-['✓'] after:absolute after:text-white after:text-sm after:top-1/2 after:left-1/2 after:-translate-x-1/2 after:-translate-y-1/2">
                        </div>
                        <span class="flex-1 font-medium text-gray-700 line-through opacity-70">Review project
                            proposal</span>
                    </div>

                    <div
                        class="flex items-center gap-4 p-5 rounded-xl mb-3.5 border-l-4 border-[#3b82f6] bg-gradient-to-br from-[#eff6ff] to-[#dbeafe] transition-all duration-300 cursor-pointer hover:translate-x-[5px] hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)]">
                        <div
                            class="w-6 h-6 rounded-full border-2 border-gray-300 flex-shrink-0 transition-all duration-300">
                        </div>
                        <span class="flex-1 font-medium text-gray-700">Update team dashboard</span>
                    </div>

                    <div
                        class="flex items-center gap-4 p-5 rounded-xl border-l-4 border-[#8b5cf6] bg-gradient-to-br from-[#f3e8ff] to-[#e9d5ff] transition-all duration-300 cursor-pointer hover:translate-x-[5px] hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)]">
                        <div
                            class="w-6 h-6 rounded-full border-2 border-gray-300 flex-shrink-0 transition-all duration-300">
                        </div>
                        <span class="flex-1 font-medium text-gray-700">Prepare presentation slides</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-gradient-to-br from-gray-800 to-gray-900 py-16 px-8 rounded-3xl mb-16">
            <div class="max-w-[1280px] mx-auto grid grid-cols-4 gap-12">
                <x-stat-item number="50K+" label="Active Users" />
                <x-stat-item number="2M+" label="Tasks Completed" />
                <x-stat-item number="99.9%" label="Uptime" />
                <x-stat-item number="4.9/5" label="User Rating" />
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 px-8 bg-white rounded-3xl mb-16">
            <div class="text-center max-w-[700px] mx-auto mb-16">
                <h2
                    class="text-5xl font-extrabold font-['Space_Grotesk',sans-serif] mb-4 bg-gradient-to-br from-gray-800 to-[#667eea] bg-clip-text text-transparent">
                    Everything You Need
                </h2>
                <p class="text-[18px] text-gray-500 leading-[1.7]">
                    Powerful features designed to help you and your team stay organized, focused, and productive.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-8 max-w-[1280px] mx-auto">
                <x-feature-card icon="✨" title="Smart Task Management"
                    description="Create, organize, and prioritize tasks with intelligent categorization and custom workflows tailored to your needs."
                    class="group" />

                <x-feature-card icon="⚡" title="Real-Time Collaboration"
                    description="Work seamlessly with your team. Share tasks, assign responsibilities, and track progress together in real-time."
                    class="group" />

                <x-feature-card icon="📊" title="Advanced Analytics"
                    description="Gain deep insights into productivity patterns with comprehensive reports, charts, and performance metrics."
                    class="group" />

                <x-feature-card icon="🔔" title="Intelligent Reminders"
                    description="Never miss a deadline with smart notifications that adapt to your schedule and work patterns."
                    class="group" />

                <x-feature-card icon="🎯" title="Goal Tracking"
                    description="Set and monitor goals with visual progress indicators and milestone celebrations to keep you motivated."
                    class="group" />

                <x-feature-card icon="🔒" title="Enterprise Security"
                    description="Bank-level encryption and security protocols ensure your data is always protected and private."
                    class="group" />
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 px-8 bg-gradient-to-br from-gray-50 to-white rounded-3xl mb-16">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold font-['Space_Grotesk',sans-serif] mb-4 text-gray-800">
                    Loved by Teams Worldwide
                </h2>
            </div>

            <div class="grid grid-cols-3 gap-8 max-w-[1280px] mx-auto">
                <x-testimonial-card :stars="5"
                    quote="TaskMate transformed how our team collaborates. We've increased productivity by 40% in just 3 months!"
                    authorName="Sarah Mitchell" authorRole="Product Manager, TechCorp" authorInitials="SM" />

                <x-testimonial-card :stars="5"
                    quote="The best task management tool I've used. Intuitive, powerful, and actually helps me get things done."
                    authorName="James Davidson" authorRole="Freelance Designer" authorInitials="JD" />

                <x-testimonial-card :stars="5"
                    quote="Finally, a tool that adapts to our workflow instead of forcing us to adapt. Game changer for our startup!"
                    authorName="Maria Rodriguez" authorRole="CEO, InnovateLab" authorInitials="MR" />
            </div>
        </section>
    </div>

    <!-- CTA Section -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-[#667eea] to-[#764ba2] py-24 px-8 rounded-none text-center text-white mb-0 before:content-[''] before:absolute before:-top-1/2 before:-right-1/2 before:w-[200%] before:h-[200%] before:bg-[radial-gradient(circle,rgba(255,255,255,0.1)_0%,transparent_70%)] before:animate-pulse-custom">
        <div class="relative z-[1] max-w-[800px] mx-auto">
            <h2 class="text-[56px] font-extrabold font-['Space_Grotesk',sans-serif] mb-6 leading-[1.2]">
                Ready to Boost Your Productivity?
            </h2>
            <p class="text-[22px] mb-10 opacity-95 leading-[1.6]">
                Join thousands of teams and individuals who are already achieving more with TaskMate. Start your free
                trial today—no credit card required.
            </p>
            @if (Route::has('register'))
                <x-button variant="white" :href="route('register')">
                    Get Started Free
                </x-button>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

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

                // Add bottom border and radius
                pageBorder.style.borderBottom = '2px solid #1b1b18';
                pageBorder.style.borderBottomLeftRadius = '20px';
                pageBorder.style.borderBottomRightRadius = '20px';
                bottomFrame.style.opacity = '1';
            } else {
                pageBorder.classList.remove('at-footer');
                bottomFrame.classList.remove('visible');
                pageBorder.style.bottom = '0px';
                bottomFrame.style.height = '20px';

                // Remove bottom border and radius
                pageBorder.style.borderBottom = 'none';
                pageBorder.style.borderBottomLeftRadius = '0';
                pageBorder.style.borderBottomRightRadius = '0';
                bottomFrame.style.opacity = '0';
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
