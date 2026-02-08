<x-app-layout>
    @section('title', 'Academic Partners')

    <div class="space-y-8">
        <!-- Explorer Header -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-8 rounded-[2rem] shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-5">
                <div class="p-4 bg-primary-100 text-primary-600 rounded-2xl shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-secondary-900 tracking-tight">University Partners</h2>
                    <p class="text-secondary-500 font-medium">Explore world-class academic institutions registered in our network.</p>
                </div>
            </div>

            <div class="flex flex-1 max-w-md w-full gap-4">
                <form action="{{ url()->current() }}" method="GET" class="relative flex-1 group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search universities..." class="w-full bg-secondary-50 border-secondary-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" />
                </form>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.universities.create') }}" class="btn-primary py-2 px-6 text-xs font-bold tracking-wide shadow-primary-600/30 hover:shadow-primary-600/50 whitespace-nowrap">
                        Register
                    </a>
                @endif
            </div>
        </div>

        <!-- University Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($universities as $university)
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 overflow-hidden group border border-secondary-50 hover:border-primary-100 transition-all duration-500 flex flex-col hover:translate-y-[-8px]">
                    <!-- Card Header / Visual -->
                    <div class="h-40 relative overflow-hidden bg-secondary-900 flex items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-600/90 to-indigo-900/95 z-0 group-hover:scale-110 transition-transform duration-700"></div>
                        <div class="relative z-10 px-8 text-center">
                            <h3 class="text-white text-2xl font-black leading-tight tracking-tight drop-shadow-xl">
                                {{ $university->name }}
                            </h3>
                            <p class="text-primary-200 text-[10px] font-bold uppercase tracking-widest mt-2">
                                {{ $university->country }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-8 flex-1 flex flex-col justify-between">
                        <div class="space-y-4 mb-6">
                            <p class="text-secondary-500 text-sm font-medium line-clamp-3 leading-relaxed">
                                {{ $university->description ?: 'Explore academic excellence and global opportunities at ' . $university->name . '. Offering a wide range of specialized programs.' }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-secondary-50">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-primary-50 text-primary-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.247 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                    <span class="text-sm font-bold text-secondary-700">{{ $university->courses_count }} Available Programs</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            @if(Auth::user()->role === 'student')
                                <a href="{{ route('student.courses.index', ['university_id' => $university->id]) }}" class="flex-1 btn-primary py-3 text-[11px] font-bold uppercase tracking-widest">
                                    Explore Courses
                                </a>
                            @endif
                            
                            <a href="{{ $university->website ?: '#' }}" target="_blank" 
                                class="p-3 {{ Auth::user()->role === 'student' ? 'bg-secondary-50 text-secondary-500 hover:bg-secondary-100' : 'flex-1 bg-secondary-900 text-white hover:bg-black text-center' }} rounded-2xl transition-all text-[11px] font-bold uppercase tracking-widest">
                                Visit Site
                            </a>
                            
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.universities.edit', $university) }}" class="p-3 bg-primary-50 text-primary-600 hover:bg-primary-100 rounded-2xl transition-all animate-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center glass-card rounded-[2.5rem] border border-secondary-100 shadow-inner">
                    <div class="w-20 h-20 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-6 text-secondary-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary-900 mb-2">No Universities Registered</h3>
                    <p class="text-secondary-500">Wait for the administrator to add partner institutions.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
