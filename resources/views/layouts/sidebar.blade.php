<aside class="w-72 sidebar-gradient hidden md:flex flex-col shadow-2xl z-20">
    <div class="h-20 flex items-center px-8 border-b border-white/5">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="p-2 bg-primary-500 rounded-lg group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                </svg>
            </div>
            <span class="text-xl font-bold text-white tracking-tight">Smart<span class="text-primary-400">CRM</span></span>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-4 custom-scrollbar">
        <nav class="space-y-1">
            <!-- Role Indicator -->
            <div class="px-4 mb-6">
                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                    <p class="text-[10px] uppercase tracking-widest text-secondary-400 font-bold mb-1">Signed in as</p>
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <span class="inline-flex items-center px-2 py-0.5 mt-2 rounded text-[10px] font-bold uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-amber-400/10 text-amber-400' : (Auth::user()->role === 'staff' ? 'bg-emerald-400/10 text-emerald-400' : 'bg-blue-400/10 text-blue-400') }}">
                        {{ Auth::user()->role }}
                    </span>
                </div>
            </div>

            <!-- Common Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-secondary-400 group-hover:text-white transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Overview</span>
            </a>

            <!-- Staff Universities Link -->
            @if(Auth::user()->role === 'staff')
                <a href="{{ route('staff.universities.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('staff.universities.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    <span class="font-medium">Universities</span>
                </a>
            @endif

            <!-- Admin specific -->
            @if(Auth::user()->role === 'admin')
                <div class="pt-6 pb-2 px-4">
                    <span class="text-[10px] font-bold text-secondary-500 uppercase tracking-widest">Administration</span>
                </div>
                <a href="{{ route('admin.universities.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.universities.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    <span class="font-medium">Universities</span>
                </a>
                <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.courses.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    <span class="font-medium">Courses</span>
                </a>
                <a href="{{ route('admin.staff.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.staff.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">Staff Members</span>
                </a>
            @endif

            <!-- Student specific -->
            @if(Auth::user()->role === 'student')
                <div class="pt-6 pb-2 px-4">
                    <span class="text-[10px] font-bold text-secondary-500 uppercase tracking-widest">Recruitment</span>
                </div>
                <a href="{{ route('student.universities.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('student.universities.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    <span class="font-medium">Browse Universities</span>
                </a>
                <a href="{{ route('student.courses.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('student.courses.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <span class="font-medium">Browse Courses</span>
                </a>
                <a href="{{ route('student.applications.index') }}" class="flex items-center px-4 py-3 text-secondary-300 hover:bg-white/5 hover:text-white rounded-xl transition-all duration-200 group {{ request()->routeIs('student.applications.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : '' }}">
                    <svg class="w-5 h-5 mr-3 text-secondary-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <span class="font-medium">My Applications</span>
                </a>
            @endif
        </nav>
    </div>

    <div class="p-4 bg-black/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-3 text-secondary-400 hover:bg-rose-500/10 hover:text-rose-400 rounded-xl transition-all duration-200 group">
                <svg class="w-5 h-5 mr-3 text-secondary-500 group-hover:text-rose-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-semibold">Sign Out</span>
            </button>
        </form>
    </div>
</aside>

