<x-app-layout>
    @section('title', 'My Application Journey')

    <div class="space-y-8">
        <!-- Explorer Header -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-100 text-primary-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-secondary-900 tracking-tight">Active Applications</h2>
                    <p class="text-sm font-medium text-secondary-500">Track your admission progress in real-time</p>
                </div>
            </div>
            <a href="{{ route('student.courses.index') }}" class="btn-primary py-2 px-6 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                Find More Courses
            </a>
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
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Course Information</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">University</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Date Applied</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Progress</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Application Status</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary-50">
                        @forelse($applications as $application)
                            <tr class="hover:bg-secondary-50/30 transition-colors group">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="text-sm font-extrabold text-secondary-900 tracking-tight group-hover:text-primary-600 transition-colors">{{ $application->course->name }}</div>
                                    <div class="text-[11px] font-bold text-secondary-400 uppercase tracking-widest">{{ $application->course->level }}</div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="p-1.5 bg-secondary-100 rounded-lg text-secondary-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                        </div>
                                        <div class="text-sm font-bold text-secondary-700">{{ $application->course->university->name }}</div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm font-bold text-secondary-500">
                                    {{ $application->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 bg-secondary-100 rounded-full h-1.5 overflow-hidden">
                                            @php
                                                $requiredCount = count($application->getRequiredDocuments());
                                                $progress = $requiredCount > 0 ? ($application->approved_documents_count / $requiredCount) * 100 : 0;
                                            @endphp
                                            <div class="bg-primary-500 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <span class="text-[10px] font-bold text-secondary-600">{{ $application->approved_documents_count }}/{{ $requiredCount }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    @php
                                        $statusStyles = [
                                            'Pending' => 'bg-amber-100 text-amber-700',
                                            'Document Review' => 'bg-blue-100 text-blue-700',
                                            'Submitted to Uni' => 'bg-indigo-100 text-indigo-700',
                                            'Offer Received' => 'bg-purple-100 text-purple-700',
                                            'Visa Process' => 'bg-rose-100 text-rose-700',
                                            'Enrolled' => 'bg-emerald-100 text-emerald-700',
                                            'Rejected' => 'bg-secondary-200 text-secondary-700',
                                        ];
                                        $style = $statusStyles[$application->status] ?? 'bg-secondary-100 text-secondary-500';
                                    @endphp
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $style }} shadow-sm">
                                        {{ $application->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right">
                                    <a href="{{ route('student.applications.show', $application) }}" class="btn-primary py-2 px-4 text-[10px] font-bold uppercase tracking-widest shadow-none">Track Status</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-secondary-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                    <p class="text-secondary-500 font-bold">You haven't submitted any applications yet</p>
                                    <a href="{{ route('student.courses.index') }}" class="text-primary-600 font-extrabold text-sm hover:underline mt-2 inline-block">Explore Courses &rarr;</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

