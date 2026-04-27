@props([
    'header' => null,
])

@if (isset($header))
    <header
        class="sticky top-0 w-full z-10 h-16 px-4 mb-3 bg-white shadow-lg rounded-md flex md:justify-between items-center gap-2 md:gap-20 lg:gap-40">
        <form class="flex items-center w-full relative">
            <input autocomplete="off" name="search" type="text" placeholder="Search for {{ $header }}"
                class="bg-gray-100 rounded-l-lg pl-12 pr-2 py-2 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="gray" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search-icon lucide-search absolute left-4">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <button type="submit" class="bg-blue-500 rounded-r-lg px-4 py-2 text-white">Search</button>
        </form>
        <div class="flex gap-5 items-center">
            <div class="w-10 h-10 rounded-full overflow-hidden">
                <img src="{{ asset("images/" . Auth::user()->user_photo) }}" alt="profile" class="w-full h-full object-cover">
            </div>
        </div>
    </header>
@endif
