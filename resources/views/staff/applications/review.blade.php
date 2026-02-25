<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Application: ') }} {{ $application->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Workflow Transition Info -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 rounded-[2.5rem] shadow-xl shadow-blue-500/20 text-white flex items-center justify-between border border-blue-400/30">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/20">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-black tracking-tight">Workflow Status Guide</h4>
                        <p class="text-blue-100 text-sm font-medium opacity-90 max-w-xl">Approving all {{ count($application->getRequiredDocuments()) }} mandatory documents will automatically transition this application to <strong class="text-white">"Submitted to Uni"</strong>, unlocking the Offer Letter upload section.</p>
                    </div>
                </div>
                <div class="hidden lg:block">
                     <div class="px-6 py-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 text-[10px] font-black uppercase tracking-[0.2em]">
                         Review Phase
                     </div>
                </div>
            </div>
            <!-- Student Details Summary -->
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-100 overflow-hidden">
                <div class="bg-secondary-900 px-8 py-6 flex justify-between items-center text-white">
                    <div>
                        <h3 class="text-lg font-bold tracking-tight">Student Profile & Application Details</h3>
                        <p class="text-primary-200 text-xs font-medium">Review the primary information submitted by the student</p>
                    </div>
                    <div>
                        @php
                            $statusColors = [
                                'Pending' => 'bg-amber-400 text-secondary-900',
                                'Document Review' => 'bg-blue-400 text-white',
                                'Submitted to Uni' => 'bg-indigo-400 text-white',
                                'Offer Received' => 'bg-emerald-400 text-white',
                                'Rejected' => 'bg-rose-400 text-white',
                            ];
                            $color = $statusColors[$application->status] ?? 'bg-secondary-400 text-white';
                        @endphp
                        <span class="px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest {{ $color }} shadow-lg shadow-black/10">
                            {{ $application->status }}
                        </span>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Student Name</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->user->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Email Address</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->user->email }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Passport Number</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->passport_number }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Nationality</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->nationality }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">DOB</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->dob }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Marital Status</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->marital_status }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">University</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->course->university->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Course</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->course->name }}</p>
                    </div>
                </div>
                <div class="px-8 pb-8">
                     <div class="p-4 bg-secondary-50 rounded-2xl border border-secondary-100">
                         <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest mb-1">Permanent Address</p>
                         <p class="text-xs font-bold text-secondary-700 leading-relaxed">{{ $application->address }}</p>
                     </div>
                </div>
            </div>

            <!-- Documents Review -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-6">Document Verification</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Document Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($application->documents as $doc)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-sm text-gray-900">{{ $doc->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            View File
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full {{ 
                                            $doc->status == 'Approved' ? 'bg-green-100 text-green-800' : 
                                            ($doc->status == 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') 
                                        }}">
                                            {{ $doc->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-3 text-left">
                                            @if($doc->status == 'Pending')
                                                <form action="{{ route('staff.applications.documents.approve', [$application, $doc]) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white font-bold text-[10px] uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/20 hover:scale-105 active:scale-95">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        Approve
                                                    </button>
                                                </form>

                                                <button onclick="document.getElementById('reject-form-{{ $doc->id }}').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-500 text-white font-bold text-[10px] uppercase tracking-widest rounded-xl hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20 hover:scale-105 active:scale-95">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    Reject
                                                </button>
                                            @else
                                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-50 text-secondary-400 font-bold text-[10px] uppercase tracking-widest rounded-xl border border-secondary-100">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    {{ $doc->status }}
                                                </div>
                                                
                                                <button onclick="document.getElementById('reject-form-{{ $doc->id }}').classList.remove('hidden')" class="p-2 text-secondary-300 hover:text-rose-500 transition-colors" title="Change Decision">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Offer Letter Section -->
            @if($application->status == 'Submitted to Uni' || $application->status == 'Offer Received')
                <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                    <h3 class="text-lg font-bold mb-4 text-indigo-900">University Offer Letter</h3>
                    <p class="text-sm text-indigo-700 mb-4">Once all mandatory documents are approved, you can upload the official offer letter from the university.</p>
                    
                    @if($application->offer_letter)
                        <div class="flex items-center text-sm font-medium text-green-700 bg-green-100 p-3 rounded mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                            Offer Letter Uploaded
                        </div>
                    @endif

                    <form action="{{ route('staff.applications.offer-letter', $application) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-end space-x-4">
                            <div class="flex-1">
                                <x-input-label for="offer_letter" value="Choose Offer Letter (PDF/ZIP)" />
                                <input type="file" name="offer_letter" class="mt-1 block w-full text-sm border rounded-lg bg-white p-2" required>
                            </div>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                {{ $application->offer_letter ? 'Re-upload Offer Letter' : 'Upload Offer Letter' }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Ultra-Compact Document Rejection Modals -->
    @foreach($application->documents as $doc)
        <div id="reject-form-{{ $doc->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-secondary-900/60 backdrop-blur-sm" onclick="document.getElementById('reject-form-{{ $doc->id }}').classList.add('hidden')"></div>
            
            <!-- Modal Card (Ultra-Compact) -->
            <div class="relative bg-white rounded-[1.25rem] shadow-2xl w-[320px] overflow-hidden text-left border border-secondary-100 animate-zoom-in">
                <div class="bg-rose-600 px-5 py-4 text-white">
                    <h3 class="text-sm font-black tracking-tight leading-none">Reject Document</h3>
                    <p class="text-rose-100 text-[8px] font-bold uppercase tracking-widest opacity-80 mt-1.5">{{ $doc->name }}</p>
                </div>
                
                <form action="{{ route('staff.applications.documents.reject', [$application, $doc]) }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[8px] font-black text-secondary-500 uppercase tracking-widest px-1">Reason for Rejection</label>
                        <textarea name="reason" rows="2" placeholder="e.g. Expired, blurred, etc." class="text-xs p-3 w-full border-secondary-200 rounded-lg focus:ring-rose-500 focus:border-rose-500 bg-secondary-50 font-bold placeholder-secondary-300 leading-tight shadow-inner" required></textarea>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="button" onclick="document.getElementById('reject-form-{{ $doc->id }}').classList.add('hidden')" class="flex-1 text-[8px] font-black text-secondary-500 uppercase tracking-widest py-3 bg-secondary-50 hover:bg-secondary-100 rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 bg-rose-600 text-white text-[8px] font-black uppercase tracking-widest py-3 rounded-lg shadow-md hover:bg-rose-700 transition-all active:scale-95">
                            Reject Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</x-app-layout>
