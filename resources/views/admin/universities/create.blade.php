<x-app-layout>
    @section('title', 'Onboard New Partner')

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-8 rounded-[2rem] shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-5">
                <div class="p-4 bg-primary-100 text-primary-600 rounded-2xl shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-secondary-900 tracking-tight">Register University</h2>
                    <p class="text-secondary-500 font-medium">Initialize a new academic partnership profile</p>
                </div>
            </div>
            <a href="{{ route('admin.universities.index') }}" class="text-sm font-bold text-secondary-400 hover:text-primary-600 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to List
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-50 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('admin.universities.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">University Name</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </span>
                                <input type="text" name="name" id="name" required
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. University of Oxford">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="space-y-2">
                            <label for="country" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Country</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </span>
                                <input type="text" name="country" id="country" required
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="e.g. United Kingdom">
                            </div>
                        </div>

                        <!-- Website -->
                        <div class="col-span-full space-y-2">
                            <label for="website" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Official Website URL</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                                </span>
                                <input type="url" name="website" id="website"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-secondary-50/50 border border-secondary-200 rounded-2xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                    placeholder="https://www.ox.ac.uk">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-span-full space-y-2">
                            <label for="description" class="block text-sm font-bold text-secondary-700 tracking-tight ml-1">Institutional Description</label>
                            <textarea name="description" id="description" rows="5"
                                class="block w-full px-5 py-4 bg-secondary-50/50 border border-secondary-200 rounded-3xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all placeholder-secondary-400 text-sm font-medium"
                                placeholder="Provide a brief overview of the university, its rankings, and campus facilities..."></textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-secondary-50 flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="btn-primary py-4 px-10 text-sm font-bold tracking-wide shadow-primary-600/30 hover:shadow-primary-600/50">
                            Confirm Registration
                        </button>
                        <a href="{{ route('admin.universities.index') }}" class="py-4 px-10 text-sm font-bold text-secondary-500 hover:bg-secondary-50 rounded-2xl transition-all text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

