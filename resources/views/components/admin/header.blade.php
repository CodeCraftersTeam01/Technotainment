@props([
    'header' => null,
])

@if (isset($header))
    <header
        class="sticky top-0 w-full z-20 h-20 px-6 bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center gap-4">
        <div class="flex items-center gap-4 flex-1">
            <h1 class="text-xl font-bold text-gray-800 hidden lg:block whitespace-nowrap">{{ $header }}</h1>
            <div class="h-8 w-[1px] bg-gray-200 hidden lg:block"></div>
            <form class="flex items-center w-full max-w-xl relative group">
                <input autocomplete="off" name="search" type="text" value="{{ request('search') }}"
                    placeholder="Search for {{ $header }}..."
                    class="bg-gray-50 border-none rounded-xl pl-12 pr-4 py-2.5 w-full focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 group-hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search absolute left-4 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </form>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" 
                    class="flex items-center gap-3 p-1.5 pr-3 rounded-xl hover:bg-gray-50 transition-all duration-200 border border-transparent hover:border-gray-100">
                    <div class="w-10 h-10 rounded-lg overflow-hidden border-2 border-white shadow-sm ring-1 ring-gray-100">
                        <img src="{{ asset("images/" . Auth::user()->user_photo) }}" alt="profile" class="w-full h-full object-cover">
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-bold text-gray-800 line-clamp-1">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Administrator</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50"
                    style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-50 mb-1">
                        <p class="text-xs text-gray-500">Signed in as</p>
                        <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        My Profile
                    </a>
                    <hr class="my-1 border-gray-50">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
@endif
