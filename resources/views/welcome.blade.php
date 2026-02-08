<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Smart CRM') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Smart CRM
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow">
            <div class="relative overflow-hidden pt-16 pb-32 space-y-24">
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                        <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                                <span class="block">Simplify Student</span>
                                <span class="block text-blue-600">Recruitment Process</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                manage applications, track visa status, and streamline admissions with our intelligent CRM platform designed for modern universities and agencies.
                            </p>
                            <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 shadow-xl shadow-blue-600/30 transition transform hover:-translate-y-1">
                                        Start Your Application
                                    </a>
                                @endif
                                <p class="mt-3 text-sm text-gray-500">No credit card required • Instant access</p>
                            </div>
                        </div>
                        <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                            <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md overflow-hidden animate-fade-in-up">
                                <div class="relative block w-full bg-white rounded-lg shadow-xl overflow-hidden">
                                     <!-- Placeholder for a dashboard screenshot/illustration using CSS shapes -->
                                     <div class="bg-gray-50 p-6 h-80 flex flex-col justify-center items-center space-y-4">
                                        <div class="w-full h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="w-3/4 h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="w-5/6 h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="flex space-x-4 w-full justify-center pt-8">
                                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xl">85%</div>
                                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold text-xl">92%</div>
                                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold text-xl">150+</div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="bg-white py-16 sm:py-24 lg:py-32">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Features</h2>
                            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                Everything you need to manage admissions
                            </p>
                        </div>

                        <div class="mt-10">
                            <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                            <!-- Heroicon name: globe-alt -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Track Applications</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">
                                        Monitor student applications in real-time from submission to enrollment.
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <!-- Heroicon name: scale -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">University Management</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">
                                        Manage partner universities, courses, and intake periods efficiently.
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                                            <!-- Heroicon name: lightning-bolt -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Visa Processing</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">
                                        Streamline visa documentation and status updates for international students.
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-xl font-bold text-gray-100">Smart CRM</span>
                        <p class="text-gray-400 text-sm mt-1">© {{ date('Y') }} All rights reserved.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white">Privacy</a>
                        <a href="#" class="text-gray-400 hover:text-white">Terms</a>
                        <a href="#" class="text-gray-400 hover:text-white">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
