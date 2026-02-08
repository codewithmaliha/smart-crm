<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart CRM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .auth-bg {
                background: radial-gradient(circle at top right, #dbeafe, transparent),
                            radial-gradient(circle at bottom left, #e0e7ff, transparent);
                background-color: #f8fafc;
            }
        </style>
    </head>
    <body class="antialiased text-secondary-900 bg-secondary-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-card sm:rounded-3xl border border-white/40 shadow-2xl">
                <div class="flex flex-col items-center mb-8">
                    <a href="/">
                        <x-application-logo class="w-auto h-12" />
                    </a>
                    <h2 class="mt-6 text-2xl font-bold text-secondary-900">Welcome Back</h2>
                    <p class="mt-2 text-sm text-secondary-500 text-center px-4">Enter your credentials to access your Smart CRM account</p>
                </div>
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-secondary-500 text-sm">
                &copy; {{ date('Y') }} Smart CRM. All rights reserved.
            </div>
        </div>
    </body>
</html>

