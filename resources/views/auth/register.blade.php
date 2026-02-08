<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-secondary-700 mb-2">Full Name</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </span>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    class="block w-full pl-10 pr-3 py-3 bg-secondary-50/50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 placeholder-secondary-400"
                    placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-secondary-700 mb-2">Email Address</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                </span>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                    class="block w-full pl-10 pr-3 py-3 bg-secondary-50/50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 placeholder-secondary-400"
                    placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-secondary-700 mb-2">Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full pl-10 pr-3 py-3 bg-secondary-50/50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 placeholder-secondary-400"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-secondary-700 mb-2">Confirm Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full pl-10 pr-3 py-3 bg-secondary-50/50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 placeholder-secondary-400"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <button type="submit" class="w-full btn-primary py-3 mt-4">
            Create Account
        </button>

        <div class="text-center mt-6">
            <p class="text-sm text-secondary-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700">Sign In instead</a>
            </p>
        </div>
    </form>
</x-guest-layout>

