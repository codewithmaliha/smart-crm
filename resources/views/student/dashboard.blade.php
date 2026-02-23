<x-app-layout>
    @section('title', 'Course Discovery')

    <div class="space-y-8">
        <!-- explorer header (Modified for logic) -->
        <div class="relative overflow-hidden bg-primary-600 rounded-3xl p-8 md:p-12 text-white shadow-2xl">
            <div class="relative z-10 max-w-2xl">
                @if($selectedUniversity)
                    <div class="mb-4">
                        <a href="{{ route('student.courses.index') }}" class="inline-flex items-center gap-2 text-primary-100 hover:text-white transition-colors text-sm font-bold bg-white/10 px-4 py-2 rounded-xl backdrop-blur-md border border-white/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Show All Universities
                        </a>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4 leading-tight">Courses at {{ $selectedUniversity->name }}</h2>
                    <p class="text-primary-100 text-lg font-medium mb-8">All available academic programs from our partner in {{ $selectedUniversity->country }}.</p>
                @else
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-4 leading-tight">Find Your Dreams at Top Universities</h2>
                    <p class="text-primary-100 text-lg font-medium mb-8">Browse thousands of world-class courses and start your international journey today.</p>
                @endif
                
                <!-- Search Bar -->
                <form action="{{ route('student.courses.index') }}" method="GET" class="relative group">
                    @if(request('university_id'))
                        <input type="hidden" name="university_id" value="{{ request('university_id') }}">
                    @endif
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-primary-300 group-focus-within:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for courses, majors, or cities..." 
                        class="block w-full pl-12 pr-4 py-4 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-primary-200 focus:outline-none focus:ring-4 focus:ring-white/10 focus:bg-white/20 transition-all backdrop-blur-sm shadow-xl">
                </form>
            </div>
            <!-- Decorative elements -->
            <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 left-1/2 w-96 h-96 bg-primary-400/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Course Results -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-secondary-900 tracking-tight">
                    {{ $selectedUniversity ? 'Programs at ' . $selectedUniversity->name : 'Available Academic Courses' }}
                </h3>
            </div>

            @if($courses->isEmpty())
                 <div class="text-center py-20 glass-card rounded-3xl border border-secondary-100">
                    <div class="w-20 h-20 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-6 text-secondary-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.247 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-secondary-900 mb-2">No Courses Available</h3>
                    <p class="text-secondary-500">
                        {{ $selectedUniversity ? 'This university currently has no active programs listed.' : 'We couldn\'t find any courses matching your request.' }}
                    </p>
                    @if($selectedUniversity)
                        <a href="{{ route('student.courses.index') }}" class="text-primary-600 font-extrabold text-sm hover:underline mt-4 inline-block tracking-tight">Explore Other Institutions &rarr;</a>
                    @endif
                 </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 overflow-hidden group border border-secondary-50 hover:border-primary-100 transition-all duration-500 flex flex-col hover:translate-y-[-8px]">
                            <!-- Card Header -->
                            <div class="h-48 relative overflow-hidden bg-secondary-900">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                                <!-- Background Image (Placeholder Gradient) -->
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-primary-800 opacity-60 group-hover:scale-110 transition-transform duration-700"></div>
                                
                                <div class="absolute top-6 right-6 z-20">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full border border-white/30">
                                        {{ $course->level }}
                                    </span>
                                </div>

                                <div class="absolute bottom-6 left-8 z-20 pr-6">
                                    <h3 class="text-white text-xl font-bold tracking-tight mb-1 group-hover:text-primary-100 transition-colors">{{ $course->name }}</h3>
                                    <p class="text-primary-200 text-xs font-semibold flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                        {{ $course->university->name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-8 pt-6 flex-1 flex flex-col justify-between">
                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Intake</p>
                                        <p class="text-sm font-bold text-secondary-800">{{ $course->intake }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Duration</p>
                                        <p class="text-sm font-bold text-secondary-800">{{ $course->duration }}</p>
                                    </div>
                                    <div class="col-span-2 pt-2 border-t border-secondary-50 flex justify-between items-center">
                                         <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Tuition Fee</p>
                                         <p class="text-xl font-extrabold text-primary-600">${{ number_format($course->tuition_fee) }}</p>
                                    </div>
                                </div>

                                <a href="{{ route('student.apply', $course) }}" class="w-full btn-primary py-4 text-sm font-bold tracking-wide shadow-primary-600/30 hover:shadow-primary-600/50 block text-center">
                                    Apply for Admission
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

