<x-app-layout>
    @section('title', 'Admin Overview')

    <div class="space-y-8">
        <!-- Welcome Section -->
        <div class="relative overflow-hidden bg-primary-600 rounded-3xl p-8 text-white shadow-2xl">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight mb-2">Welcome back, Admin!</h2>
                    <p class="text-primary-100 font-medium">Here's what's happening in your recruitment portal today.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.universities.create') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-bold py-3 px-6 rounded-2xl transition-all border border-white/20 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Add University
                    </a>
                    <a href="{{ route('admin.courses.create') }}" class="bg-white text-primary-600 hover:bg-primary-50 font-bold py-3 px-6 rounded-2xl transition-all shadow-lg flex items-center gap-2">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        Add Course
                    </a>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $adminStats = [
                    ['label' => 'Universities', 'value' => $stats['universities'], 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'primary'],
                    ['label' => 'Total Courses', 'value' => $stats['courses'], 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'indigo'],
                    ['label' => 'Applications', 'value' => $stats['applications'], 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'emerald'],
                    ['label' => 'Pending Review', 'value' => $stats['pending_applications'], 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'amber'],
                ];
            @endphp

            @foreach($adminStats as $stat)
                <div class="glass-card rounded-3xl p-6 hover:translate-y-[-5px] transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $stat['icon'] }}" /></svg>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-secondary-500 uppercase tracking-wider mb-1">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-extrabold text-secondary-900 leading-none">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- System Health Small Card -->
        <div class="p-4 bg-secondary-100 rounded-2xl flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-sm font-bold text-secondary-800 tracking-tight">System Status: All systems operational</span>
            </div>
            <p class="text-xs font-semibold text-secondary-500 uppercase tracking-widest">Database: Connected (MySQL)</p>
        </div>
    </div>
</x-app-layout>

