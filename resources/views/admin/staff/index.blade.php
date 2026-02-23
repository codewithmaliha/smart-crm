<x-app-layout>
    @section('title', 'Staff Management')

    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-secondary-100 gap-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-100 text-primary-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-secondary-900 tracking-tight">Staff Members</h2>
                </div>
            </div>

            <div class="flex items-center gap-4 flex-1 max-w-xl">
                <form action="{{ route('admin.staff.index') }}" method="GET" class="relative flex-1 group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-secondary-400 group-focus-within:text-primary-500 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search staff by name or email..." class="w-full bg-secondary-50 border-secondary-200 rounded-xl pl-9 pr-4 py-2 text-sm focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" />
                </form>
                <a href="{{ route('admin.staff.create') }}" class="btn-primary py-2 px-6 flex items-center gap-2 text-xs font-bold whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                    Add Team Member
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
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Name</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Email Address</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Joined Date</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-secondary-400 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary-50">
                        @forelse($staff as $member)
                            <tr class="hover:bg-secondary-50/30 transition-colors group">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-xs font-black">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                        <div class="text-sm font-extrabold text-secondary-900 tracking-tight group-hover:text-primary-600 transition-colors">{{ $member->name }}</div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2 text-secondary-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        <span class="text-sm font-medium">{{ $member->email }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-secondary-50 text-secondary-500 rounded-full text-[10px] font-bold uppercase tracking-wider border border-secondary-100">
                                        {{ $member->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to revoke access for this staff member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-secondary-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Revoke Access">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 bg-secondary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-secondary-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                    <p class="text-secondary-500 font-bold">No staff members registered in the system yet</p>
                                    <a href="{{ route('admin.staff.create') }}" class="text-primary-600 font-extrabold text-sm hover:underline mt-2 inline-block">Add Your First team Member &rarr;</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
