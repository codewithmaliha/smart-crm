<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apply for ') }} {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('student.apply.store', $course) }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Application Details -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Personal Information</h3>
                            
                            <div>
                                <x-input-label for="name" :value="__('Full Name (as per Passport)')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', Auth::user()->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="dob" :value="__('Date of Birth')" />
                                    <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required />
                                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="passport_number" :value="__('Passport Number')" />
                                    <x-text-input id="passport_number" class="block mt-1 w-full" type="text" name="passport_number" :value="old('passport_number')" required />
                                    <x-input-error :messages="$errors->get('passport_number')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="nationality" :value="__('Nationality')" />
                                    <x-text-input id="nationality" class="block mt-1 w-full" type="text" name="nationality" :value="old('nationality')" required />
                                    <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="marital_status" :value="__('Marital Status')" />
                                    <select id="marital_status" name="marital_status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Academic -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Academic & Contact</h3>

                            <div>
                                <x-input-label for="highest_qualification" :value="__('Highest Qualification')" />
                                <x-text-input id="highest_qualification" class="block mt-1 w-full" type="text" name="highest_qualification" :value="old('highest_qualification')" required />
                                <x-input-error :messages="$errors->get('highest_qualification')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="passing_year" :value="__('Year of Passing')" />
                                    <x-text-input id="passing_year" class="block mt-1 w-full" type="number" name="passing_year" :value="old('passing_year')" required />
                                    <x-input-error :messages="$errors->get('passing_year')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="phone" :value="__('Contact Number')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Complete Address')" />
                                <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <!-- University/Intake Info -->
                        <div class="space-y-6 md:col-span-2">
                             <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Application Specifics</h3>
                             <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="country" :value="__('Desired Country')" />
                                    <x-text-input id="country" class="block mt-1 w-full bg-gray-50" type="text" name="country" :value="$course->university->country" readonly />
                                </div>
                                <div>
                                    <x-input-label for="university_name" :value="__('University')" />
                                    <x-text-input id="university_name" class="block mt-1 w-full bg-gray-50" type="text" name="university_name" :value="$course->university->name" readonly />
                                </div>
                                <div>
                                    <x-input-label for="intake" :value="__('Intake Period')" />
                                    <x-text-input id="intake" class="block mt-1 w-full bg-gray-50" type="text" name="intake" :value="$course->intake" readonly />
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-12 pt-6 border-t">
                        <x-primary-button class="px-8 py-3">
                            {{ __('Save & Continue to Uploads') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
