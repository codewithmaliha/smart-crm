<x-app-layout>
    @section('title', 'Staff Workspace')

    <div class="space-y-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $staffStats = [
                    ['label' => 'Total Apps', 'value' => $stats['total'], 'color' => 'primary', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['label' => 'Pending', 'value' => $stats['pending'], 'color' => 'amber', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Enrolled', 'value' => $stats['enrolled'], 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Rejected', 'value' => $stats['rejected'], 'color' => 'rose', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($staffStats as $stat)
                <div class="glass-card rounded-3xl p-6 border-l-4 border-{{ $stat['color'] }}-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-secondary-400 uppercase tracking-widest mb-1">{{ $stat['label'] }}</p>
                            <p class="text-2xl font-extrabold text-secondary-900 leading-none">{{ $stat['value'] }}</p>
                        </div>
                        <div class="p-2 bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $stat['icon'] }}" /></svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-secondary-200/50 overflow-hidden border border-secondary-100">
            <div class="p-8 border-b border-secondary-100 flex flex-col md:flex-row justify-between items-center gap-6 bg-secondary-50/30">
                 <div>
                    <h3 class="text-xl font-extrabold text-secondary-900 tracking-tight">Application Management</h3>
                    <p class="text-sm text-secondary-500 font-medium">Review and update student admission progress</p>
                 </div>
                 
                 <form action="{{ route('staff.dashboard') }}" method="GET" class="relative w-full md:w-80">
                      <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                      </span>
                      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search applications..." class="block w-full pl-10 pr-4 py-3 bg-white border border-secondary-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm">
                 </form>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary-100">
                    <thead class="bg-secondary-50/50">
                        <tr>
                            <th class="px-8 py-4 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Student info</th>
                            <th class="px-8 py-4 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Course Detail</th>
                            <th class="px-8 py-4 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Date Applied</th>
                            <th class="px-8 py-4 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Documents</th>
                            <th class="px-8 py-4 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Current Status</th>
                            <th class="px-8 py-4 text-right text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary-50">
                        @foreach($applications as $application)
                            <tr class="hover:bg-secondary-50/50 transition-colors group">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center text-primary-700 font-bold border-2 border-white shadow-sm mr-4">
                                            {{ substr($application->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-secondary-900 group-hover:text-primary-700 transition-colors">{{ $application->user->name }}</div>
                                            <div class="text-[11px] font-medium text-secondary-400 leading-none">{{ $application->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm font-bold text-secondary-900 tracking-tight">{{ $application->course->name }}</div>
                                    <div class="text-[11px] font-medium text-secondary-400 uppercase tracking-wider">{{ $application->course->university->name }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm font-bold text-secondary-600">{{ $application->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-full bg-secondary-100 rounded-full h-1.5 w-24 overflow-hidden">
                                            @php
                                                $requiredCount = count($application->getRequiredDocuments());
                                                $progress = $requiredCount > 0 ? ($application->approved_documents_count / $requiredCount) * 100 : 0;
                                            @endphp
                                            <div class="bg-primary-500 h-1.5 rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-secondary-700">{{ $application->approved_documents_count }}/{{ $requiredCount }}</span>
                                    </div>
                                    <div class="text-[10px] font-medium text-secondary-400 mt-1">{{ $application->approved_documents_count }} approved</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                     @php
                                        $statusColors = [
                                            'Pending' => 'bg-amber-100 text-amber-700',
                                            'Document Review' => 'bg-blue-100 text-blue-700',
                                            'Submitted to Uni' => 'bg-indigo-100 text-indigo-700',
                                            'Offer Received' => 'bg-purple-100 text-purple-700',
                                            'Visa Process' => 'bg-rose-100 text-rose-700',
                                            'Enrolled' => 'bg-emerald-100 text-emerald-700',
                                            'Rejected' => 'bg-secondary-100 text-secondary-700',
                                        ];
                                        $color = $statusColors[$application->status] ?? 'bg-secondary-50 text-secondary-500';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $color }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-2 opacity-60 {{ str_replace('text-', 'bg-', $color) }}"></span>
                                        {{ $application->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-right">
                                    <a href="{{ route('staff.applications.review', $application) }}" class="btn-primary py-2 shadow-none hover:shadow-primary-600/20">Review</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($applications->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-secondary-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <p class="text-sm font-bold text-secondary-500">No applications found</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

