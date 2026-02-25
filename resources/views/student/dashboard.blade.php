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

        <!-- AI Recommended Matches -->
        @if( (!request('search') && !request('global_search') && !request('university_id')) && (isset($recommendedCourses) && $recommendedCourses->count() > 0) )
        <div class="space-y-6 pt-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl shadow-sm border border-indigo-50">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-secondary-900 tracking-tight">AI Recommended For You</h3>
                        <p class="text-secondary-500 text-xs font-bold mt-1">Based on your preferences and previous applications</p>
                    </div>
                </div>
                @if(isset($user))
                    <button type="button" onclick="document.getElementById('preferences-modal').classList.remove('hidden')" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-xl transition-colors ring-1 ring-inset ring-indigo-200">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Configure Preferences
                    </button>
                @endif
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recommendedCourses as $course)
                    <div class="bg-fuchsia-50 rounded-[2rem] shadow-lg shadow-fuchsia-200/40 overflow-hidden group border border-fuchsia-100 hover:border-fuchsia-300 transition-all duration-500 flex flex-col hover:-translate-y-2 relative">
                        <!-- AI Badge Badge -->
                        <div class="absolute top-4 left-4 z-30">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-fuchsia-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-fuchsia-500 shadow-lg border border-white"></span>
                            </span>
                        </div>
                            
                        <!-- Card Header -->
                        <div class="h-40 relative overflow-hidden bg-secondary-900 block">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-500 to-rose-500 opacity-75 group-hover:scale-110 transition-transform duration-700"></div>
                            
                            <div class="absolute top-4 right-4 z-20">
                                <span class="bg-white/20 backdrop-blur-md text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full border border-white/30">
                                    {{ $course->level }}
                                </span>
                            </div>

                            <div class="absolute bottom-5 left-6 right-6 z-20">
                                <h3 class="text-white text-lg font-bold tracking-tight mb-1 truncate group-hover:text-fuchsia-200 transition-colors" title="{{ $course->name }}">{{ Str::limit($course->name, 35) }}</h3>
                                <p class="text-fuchsia-100 text-xs font-semibold flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    {{ Str::limit($course->university->name, 30) }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 pt-5 flex-1 flex flex-col justify-between bg-gradient-to-b from-white to-fuchsia-50/50">
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="space-y-0.5">
                                    <p class="text-[10px] font-extrabold text-secondary-400 uppercase tracking-widest">Intake</p>
                                    <p class="text-sm font-bold text-secondary-800">{{ $course->intake }}</p>
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-[10px] font-extrabold text-secondary-400 uppercase tracking-widest">Duration</p>
                                    <p class="text-sm font-bold text-secondary-800">{{ $course->duration }}</p>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-fuchsia-100/60 flex justify-between items-center mb-5">
                                    <p class="text-[10px] font-extrabold text-fuchsia-600 uppercase tracking-widest">Fee</p>
                                    <p class="text-xl font-black text-fuchsia-700">${{ number_format($course->tuition_fee) }}</p>
                            </div>

                            <a href="{{ route('student.apply', $course) }}" class="w-full bg-gradient-to-r from-fuchsia-600 to-rose-500 hover:from-fuchsia-700 hover:to-rose-600 text-white shadow-fuchsia-500/30 hover:shadow-fuchsia-500/50 py-3.5 rounded-xl text-sm font-bold tracking-wide shadow-lg block text-center transition-all">
                                Apply Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="h-px w-full bg-gradient-to-r from-transparent via-secondary-200 to-transparent mt-12 mb-8"></div>
        </div>
        @endif

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

    @if(isset($user))
    <!-- Edit Preferences Modal Container -->
    <div id="preferences-modal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-secondary-900/60 transition-opacity backdrop-blur-sm" onclick="document.getElementById('preferences-modal').classList.add('hidden')"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal panel -->
            <div class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl shadow-indigo-900/20 transition-all sm:my-8 sm:w-full sm:max-w-lg border border-secondary-100">
                <div class="bg-indigo-50/50 px-6 py-6 border-b border-indigo-100/50 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                         <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-indigo-100 text-indigo-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900" id="modal-title">Edit AI Preferences</h3>
                    </div>
                    <button type="button" onclick="document.getElementById('preferences-modal').classList.add('hidden')" class="text-secondary-400 hover:text-secondary-600 bg-white hover:bg-secondary-50 p-2 rounded-full transition-colors focus:outline-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <div class="p-8">
                    <p class="text-sm text-secondary-500 mb-6">Update your preferences below. Our AI engine will instantly tailor your course dashboard to match your new settings.</p>
                    
                    <form action="{{ route('student.preferences.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-secondary-500 uppercase tracking-widest mb-2">Preferred Level</label>
                            <select name="level" class="w-full text-base border-secondary-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 py-3 px-4">
                                <option value="">Any Level</option>
                                <option value="Undergraduate" {{ isset($user->preferences['level']) && $user->preferences['level'] == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                <option value="Postgraduate" {{ isset($user->preferences['level']) && $user->preferences['level'] == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                                <option value="Diploma" {{ isset($user->preferences['level']) && $user->preferences['level'] == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-secondary-500 uppercase tracking-widest mb-2">Preferred Intake</label>
                            <select name="intake" class="w-full text-base border-secondary-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 py-3 px-4">
                                <option value="">Any Intake</option>
                                <option value="Fall 2026" {{ isset($user->preferences['intake']) && $user->preferences['intake'] == 'Fall 2026' ? 'selected' : '' }}>Fall 2026</option>
                                <option value="Spring 2027" {{ isset($user->preferences['intake']) && $user->preferences['intake'] == 'Spring 2027' ? 'selected' : '' }}>Spring 2027</option>
                                <option value="Summer 2027" {{ isset($user->preferences['intake']) && $user->preferences['intake'] == 'Summer 2027' ? 'selected' : '' }}>Summer 2027</option>
                            </select>
                        </div>
                        <div class="mt-8 flex gap-3">
                            <button type="button" onclick="document.getElementById('preferences-modal').classList.add('hidden')" class="flex-1 bg-white hover:bg-secondary-50 text-secondary-700 border border-secondary-200 rounded-xl py-3 text-sm font-bold transition-all">Cancel</button>
                            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl py-3 text-sm font-bold shadow-lg shadow-indigo-600/20 transition-all">
                                Save & Update AI
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

