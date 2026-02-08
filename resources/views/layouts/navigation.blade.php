<nav x-data="{ open: false }" class="bg-white border-b border-secondary-100 h-20 flex items-center shadow-sm sticky top-0 z-10 px-6 sm:px-8">
    <div class="flex justify-between w-full items-center">
        <!-- Breadcrumb / Page Title (Dynamic) -->
        <div class="flex items-center gap-4">
            <button @click="open = !open" class="md:hidden p-2 rounded-xl text-secondary-500 hover:bg-secondary-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
            <div class="hidden sm:block">
                <h1 class="text-lg font-bold text-secondary-900 tracking-tight">
                    @yield('title', 'Dashboard')
                </h1>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-4">
            <!-- Search Bar (Context Aware) -->
            <div class="hidden lg:flex relative">
                @php
                    $searchRoute = match(Auth::user()->role) {
                        'admin' => route('admin.universities.index'),
                        'staff' => route('staff.dashboard'),
                        'student' => route('student.courses.index'),
                        default => '#'
                    };
                @endphp
                <form action="{{ $searchRoute }}" method="GET" class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" name="global_search" value="{{ request('global_search') }}" placeholder="Search {{ Auth::user()->role === 'student' ? 'courses' : (Auth::user()->role === 'staff' ? 'applications' : 'universities') }}..." class="bg-secondary-50/50 border-secondary-100 rounded-xl pl-9 pr-4 py-2 text-sm focus:ring-primary-500/20 focus:border-primary-500 transition-all w-64" />
                </form>
            </div>

            <div class="h-8 w-px bg-secondary-100 mx-2 hidden sm:block"></div>

            <!-- Profile Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center gap-3 p-1 rounded-xl hover:bg-secondary-50 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-700 font-bold border-2 border-white shadow-sm group-hover:bg-primary-600 group-hover:text-white transition-all">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-bold text-secondary-900 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-secondary-400 font-semibold uppercase tracking-wider">{{ Auth::user()->role }}</p>
                        </div>
                        <svg class="w-4 h-4 text-secondary-400 group-hover:text-secondary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-secondary-50">
                        <p class="text-xs text-secondary-400 font-semibold uppercase tracking-wider mb-1">Account Options</p>
                        <p class="text-sm font-bold text-secondary-800 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 py-3 px-4 text-secondary-600 hover:text-primary-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span>{{ __('My Profile') }}</span>
                    </x-dropdown-link>

                    <div class="border-t border-secondary-50"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="flex items-center gap-2 py-3 px-4 text-rose-600 hover:bg-rose-50"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            <span>{{ __('Sign Out') }}</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

