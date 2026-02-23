<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Progress Stepper -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-100">
                <div class="relative flex items-center justify-between">
                    @php
                        $steps = [
                            ['name' => 'Details', 'status' => 'Pending'],
                            ['name' => 'Documents', 'status' => 'Document Review'],
                            ['name' => 'Review', 'status' => 'Submitted to Uni'],
                            ['name' => 'Offer', 'status' => 'Offer Received'],
                            ['name' => 'Visa', 'status' => 'Visa Process'],
                        ];
                        $statusMap = array_column($steps, 'status');
                        $currentStatusIndex = array_search($application->status, $statusMap);
                        if ($currentStatusIndex === false) $currentStatusIndex = 0;
                    @endphp

                    <div class="absolute left-0 top-1/2 -ml-0.5 h-0.5 w-full bg-secondary-100 -translate-y-1/2 z-0"></div>
                    <div class="absolute left-0 top-1/2 -ml-0.5 h-0.5 bg-primary-500 -translate-y-1/2 z-0 transition-all duration-1000" style="width: {{ count($steps) > 1 ? ($currentStatusIndex / (count($steps) - 1)) * 100 : 0 }}%"></div>

                    @foreach($steps as $index => $step)
                        <div class="relative z-10 flex flex-col items-center group">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-4 transition-all duration-500 {{ $index <= $currentStatusIndex ? 'bg-primary-500 border-primary-100 text-white scale-110 shadow-lg shadow-primary-500/20' : 'bg-white border-secondary-100 text-secondary-400' }}">
                                @if($index < $currentStatusIndex)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    <span class="text-xs font-bold">{{ $index + 1 }}</span>
                                @endif
                            </div>
                            <span class="mt-3 text-[10px] font-bold uppercase tracking-widest {{ $index <= $currentStatusIndex ? 'text-primary-600' : 'text-secondary-400' }}">{{ $step['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Application Summary -->
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-100 overflow-hidden">
                <div class="bg-secondary-900 px-8 py-6 flex justify-between items-center text-white">
                    <div>
                        <h3 class="text-lg font-bold tracking-tight">Application Summary</h3>
                        <p class="text-primary-200 text-xs font-medium">Your submitted personal and academic information</p>
                    </div>
                    <div class="flex items-center gap-3">
                         <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-xl text-white text-[10px] font-bold uppercase tracking-widest border border-white/20">
                             ID: #APP-{{ 1000 + $application->id }}
                         </span>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Full Name</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->name }}</p>
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
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Course</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->course->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">University</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->course->university->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Intake</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->intake }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Phone</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->phone }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Qualification</p>
                        <p class="text-sm font-bold text-secondary-900">{{ $application->highest_qualification }} ({{ $application->passing_year }})</p>
                    </div>
                </div>
            </div>

            <!-- Documentation Guidelines -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 shadow-sm rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700 font-medium">
                            Please upload all required documents in PDF or ZIP format (Max 10MB each).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Documents Checklist -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-secondary-100">
                <div class="p-8 text-secondary-900">
                    <h3 class="text-lg font-bold mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Required Documentation Checklist
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($requiredDocuments as $docName)
                            @php
                                $uploadedDoc = $application->documents->where('name', $docName)->first();
                            @endphp
                            <div class="border rounded-2xl p-6 flex flex-col justify-between transition-all hover:border-primary-300 {{ $uploadedDoc && $uploadedDoc->status == 'Approved' ? 'bg-emerald-50 border-emerald-200' : ($uploadedDoc && $uploadedDoc->status == 'Rejected' ? 'bg-rose-50 border-rose-200' : 'bg-white') }}">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="font-bold text-sm text-secondary-700 tracking-tight">{{ $docName }}</span>
                                        @if($uploadedDoc)
                                            <span class="text-[10px] font-bold uppercase tracking-widest {{ $uploadedDoc->status == 'Approved' ? 'text-emerald-600' : ($uploadedDoc->status == 'Rejected' ? 'text-rose-600' : 'text-amber-600') }}">
                                                {{ $uploadedDoc->status }}
                                            </span>
                                        @else
                                            <span class="text-[10px] font-bold text-secondary-300 uppercase tracking-widest">Missing</span>
                                        @endif
                                    </div>

                                    @if($uploadedDoc && $uploadedDoc->status == 'Rejected')
                                        <div class="bg-rose-100/50 text-rose-700 text-[10px] font-bold p-3 rounded-xl mb-3 border border-rose-200">
                                            REASON: {{ $uploadedDoc->rejection_reason }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    @if($uploadedDoc)
                                        <div class="flex items-center space-x-2 mb-4">
                                            <a href="{{ Storage::url($uploadedDoc->file_path) }}" target="_blank" class="text-xs font-bold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 rounded-lg transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                View Document
                                            </a>
                                        </div>
                                    @endif

                                    @if(!$uploadedDoc || $uploadedDoc->status == 'Rejected')
                                        <form action="{{ route('student.applications.upload', $application) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                            @csrf
                                            <input type="hidden" name="document_name" value="{{ $docName }}">
                                            <div class="relative">
                                                <input type="file" name="document_file" id="file-{{ Str::slug($docName) }}" class="sr-only" required onchange="this.nextElementSibling.querySelector('.file-name').textContent = this.files[0].name" />
                                                <label for="file-{{ Str::slug($docName) }}" class="flex items-center justify-center gap-2 px-4 py-3 border-2 border-dashed border-secondary-200 rounded-xl cursor-pointer hover:border-primary-400 hover:bg-primary-50 transition-all group overflow-hidden">
                                                    <svg class="w-4 h-4 text-secondary-400 group-hover:text-primary-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                    <span class="file-name text-[10px] font-bold text-secondary-500 group-hover:text-primary-600 uppercase tracking-widest truncate max-w-full">Select PDF/ZIP</span>
                                                </label>
                                            </div>
                                            <button type="submit" class="w-full bg-secondary-900 text-white text-[10px] font-bold uppercase tracking-widest py-3 rounded-xl hover:bg-primary-600 transition-colors shadow-lg shadow-black/5">
                                                Upload Now
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tuition Fee & Offer Letter (Conditional / Locked States) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Offer Letter -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-secondary-200/40 border border-secondary-100 relative overflow-hidden group">
                    @if(!($application->status == 'Submitted to Uni' || $application->status == 'Offer Received' || $application->status == 'Visa Process' || $application->status == 'Enrolled'))
                        <!-- Locked Overlay -->
                        <div class="absolute inset-0 bg-secondary-50/60 backdrop-blur-[2px] z-20 flex flex-col items-center justify-center text-center p-6">
                            <div class="p-3 bg-white rounded-2xl shadow-sm mb-4">
                                <svg class="w-8 h-8 text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h4 class="text-sm font-black text-secondary-900 uppercase tracking-widest">Stage Locked</h4>
                            <p class="text-[10px] font-bold text-secondary-500 mt-2">Unlocks after staff approves all mandatory documents.</p>
                        </div>
                    @endif

                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-primary-100 text-primary-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <h3 class="font-bold text-lg text-secondary-900">Official Offer Letter</h3>
                    </div>
                    
                    @if($application->offer_letter)
                        <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-900">University Offer Issued</p>
                                <a href="{{ Storage::url($application->offer_letter) }}" target="_blank" class="text-emerald-600 text-xs font-bold hover:underline">Download Letter &rarr;</a>
                            </div>
                        </div>
                    @else
                        <div class="p-6 bg-secondary-50 rounded-2xl border border-secondary-100 flex flex-col items-center text-center">
                            <span class="animate-pulse mb-3">
                                <svg class="w-10 h-10 text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <p class="text-sm font-bold text-secondary-500 italic">Review in progress. Waiting for the university to issue the offer letter...</p>
                        </div>
                    @endif
                </div>

                <!-- Tuition Fee -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-secondary-200/40 border border-secondary-100 relative overflow-hidden group">
                    @if(!($application->status == 'Offer Received' || $application->status == 'Visa Process' || $application->status == 'Enrolled'))
                        <!-- Locked Overlay -->
                        <div class="absolute inset-0 bg-secondary-50/60 backdrop-blur-[2px] z-20 flex flex-col items-center justify-center text-center p-6">
                            <div class="p-3 bg-white rounded-2xl shadow-sm mb-4">
                                <svg class="w-8 h-8 text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h4 class="text-sm font-black text-secondary-900 uppercase tracking-widest">Stage Locked</h4>
                            <p class="text-[10px] font-bold text-secondary-500 mt-2">Unlocks after you receive an official Offer Letter.</p>
                        </div>
                    @endif

                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="font-bold text-lg text-secondary-900">Tuition Fee Payment</h3>
                    </div>
                    
                    @php $feeReceipt = $application->documents->where('name', 'Fee Receipt')->first(); @endphp
                    
                    @if(!$feeReceipt)
                        <div class="bg-amber-50 p-4 rounded-xl mb-6 text-xs font-bold text-amber-800 border-l-4 border-amber-400">
                            ACTION REQUIRED: Please use the bank details provided in your offer letter and upload the receipt here.
                        </div>
                        <form action="{{ route('student.applications.upload', $application) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="document_name" value="Fee Receipt">
                            <label class="block">
                                <span class="text-[10px] font-bold text-secondary-400 uppercase tracking-widest mb-2 block">Upload Receipt (PDF/ZIP)</span>
                                <input type="file" name="document_file" class="block w-full text-xs text-secondary-500 border border-secondary-200 rounded-xl p-3 focus:ring-amber-500 focus:border-amber-500" required>
                            </label>
                            <button type="submit" class="w-full bg-amber-600 text-white text-[10px] font-bold uppercase tracking-widest py-3 rounded-xl hover:bg-amber-700 transition-colors shadow-lg shadow-amber-600/20">Submit Payment Proof</button>
                        </form>
                    @else
                        <div class="p-6 bg-amber-50 rounded-2xl border border-amber-100 flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-amber-900">Receipt Submitted</p>
                                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Verification Pending</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
