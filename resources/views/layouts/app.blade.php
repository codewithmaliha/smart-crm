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
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .sidebar-gradient {
                background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            }
        </style>
    </head>
    <body class="antialiased bg-secondary-50 text-secondary-900">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Top Navigation -->
                @include('layouts.navigation')

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    @isset($header)
                        <div class="bg-white border-b border-secondary-100 shadow-sm px-6 py-6 sm:px-8 lg:px-12">
                            <div class="max-w-7xl">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset

                    <div class="px-6 py-6 sm:px-8 lg:px-12 container mx-auto">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span class="text-sm font-semibold">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl flex items-center gap-3 animate-fade-in shadow-sm">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span class="text-sm font-semibold">{{ session('error') }}</span>
                            </div>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>

