<x-app-layout>
    @section('title', 'Curriculum Management')

    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-100 text-primary-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-secondary-900 tracking-tight">Courses</h2>
                </div>
            </div>

            <div class="flex items-center gap-4 flex-1 max-w-xl">
                <form action="{{ route('admin.courses.index') }}" method="GET" class="relative flex-1 group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, level or university..." class="w-full bg-secondary-50 border-secondary-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" />
                </form>
                <a href="{{ route('admin.courses.create') }}" class="btn-primary py-2 px-6 flex items-center gap-2 text-xs font-bold whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                    New Course
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 shadow-sm animate-fade-in">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/50 overflow-hidden border border-secondary-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary-50">
                    <thead class="bg-secondary-50/50">
                        <tr>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Course Name</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">University</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Academic Level</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Intake Window</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary-50">
                        @forelse($courses as $course)
                            <tr class="hover:bg-secondary-50/30 transition-colors group">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="text-sm font-extrabold text-secondary-900 tracking-tight group-hover:text-primary-600 transition-colors">{{ $course->name }}</div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="p-1.5 bg-secondary-100 rounded-lg text-secondary-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                        </div>
                                        <div class="text-sm font-bold text-secondary-700">{{ $course->university->name }}</div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-primary-50 text-primary-600 rounded-full text-[10px] font-bold uppercase tracking-wider border border-primary-100">
                                        {{ $course->level }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm font-bold text-secondary-500">
                                    {{ $course->intake }}
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="p-2 text-secondary-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all" title="Edit Curriculum Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-secondary-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Remove Program">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-secondary-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                    <p class="text-secondary-500 font-bold">No courses are currently listed</p>
                                    <a href="{{ route('admin.courses.create') }}" class="text-primary-600 font-extrabold text-sm hover:underline mt-2 inline-block">Create Your First Course &rarr;</a>
                                </td>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
