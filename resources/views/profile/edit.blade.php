<x-app-layout>
    @section('title', 'Manage Your Account')

    <div class="space-y-10 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-secondary-100 flex items-center gap-6">
             <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-primary-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
             </div>
             <div>
                <h2 class="text-2xl font-extrabold text-secondary-900 tracking-tight">Account Settings</h2>
                <p class="text-secondary-500 font-medium">Update your professional profile and security preferences</p>
             </div>
        </div>

        <!-- Forms Grid -->
        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-50">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-secondary-200/40 border border-secondary-50">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white/50 backdrop-blur-sm p-10 rounded-[2.5rem] border border-red-50">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

