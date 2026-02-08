<x-app-layout>
    @section('title', 'Refine Curriculum Details')

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-8 rounded-[2rem] shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-5">
                <div class="p-4 bg-primary-100 text-primary-600 rounded-2xl shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-secondary-900 tracking-tight">Modify Course Structure</h2>
                    <p class="text-secondary-500 font-medium">Update program specifications for {{ $course->name }}</p>
                </div>
            </div>
            <a href="{{ route('admin.courses.index') }}" class="text-sm font-bold text-secondary-400 hover:text-primary-600 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to List
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-50 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- University Selection -->
                        <div class="col-span-full space-y-2">
                            <label for="university_id" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Hosting University</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </span>
                                <select name="university_id" id="university_id" required
                                    class="block w-full pl-12 pr-10 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all text-sm font-medium appearance-none">
                                    @foreach($universities as $university)
                                        <option value="{{ $university->id }}" {{ $course->university_id == $university->id ? 'selected' : '' }}>
                                            {{ $university->name }} ({{ $university->country }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-secondary-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Course Name -->
                        <div class="col-span-full space-y-2">
                            <label for="name" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Program Title</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                </span>
                                <input type="text" name="name" id="name" value="{{ $course->name }}" required
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. MSc in Computer Science">
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="space-y-2">
                            <label for="level" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Academic Level</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" /></svg>
                                </span>
                                <input type="text" name="level" id="level" value="{{ $course->level }}" required
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. Undergraduate, Masters">
                            </div>
                        </div>

                        <!-- Intake -->
                        <div class="space-y-2">
                            <label for="intake" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Intake Window</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2V12a2 2 0 002 2z" /></svg>
                                </span>
                                <input type="text" name="intake" id="intake" value="{{ $course->intake }}" required
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. September 2025">
                            </div>
                        </div>

                        <!-- Tuition Fee -->
                        <div class="space-y-2">
                            <label for="tuition_fee" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Annual Tuition Fee ($)</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </span>
                                <input type="number" step="0.01" name="tuition_fee" id="tuition_fee" value="{{ $course->tuition_fee }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. 15000">
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="space-y-2">
                            <label for="duration" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Program Duration</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </span>
                                <input type="text" name="duration" id="duration" value="{{ $course->duration }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. 3 Years full-time">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-secondary-50 flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="btn-primary py-4 px-10 text-sm font-bold tracking-wide shadow-primary-600/30 hover:shadow-primary-600/50">
                            Update Curriculum
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="py-4 px-10 text-sm font-bold text-secondary-500 hover:bg-secondary-50 rounded-2xl transition-all text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

