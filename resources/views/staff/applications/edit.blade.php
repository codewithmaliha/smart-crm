<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold">Application Details</h3>
                        <p><strong>Student:</strong> {{ $application->user->name }} ({{ $application->user->email }})</p>
                        <p><strong>Course:</strong> {{ $application->course->name }}</p>
                        <p><strong>University:</strong> {{ $application->course->university->name }}</p>
                        <p><strong>Current Status:</strong> {{ $application->status }}</p>
                    </div>

                    <form action="{{ route('staff.applications.update', $application) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Update Status</label>
                            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach(['Pending', 'Document Review', 'Submitted to Uni', 'Offer Received', 'Visa Process', 'Enrolled', 'Rejected'] as $status)
                                    <option value="{{ $status }}" {{ $application->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Status
                            </button>
                            <a href="{{ route('staff.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
