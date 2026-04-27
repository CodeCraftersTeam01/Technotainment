@props([
    'menu' => [
        [
            'icon' => 'components.icons.dashboard',
            'name' => 'Dashboard',
            'link' => route('dashboard'),
        ],
        [
            'icon' => 'components.icons.announcement',
            'name' => 'Announcements',
            'link' => route('announcements.index', ['status' => 'active']),
        ],
        [
            'icon' => 'components.icons.event',
            'name' => 'Events',
            'link' => route('events.index'),
        ],
        [
            'icon' => 'components.icons.competition',
            'name' => 'Competitions',
            'link' => route('competitions.index', ['event_status' => 'active']),
        ],
        [
            'icon' => 'components.icons.timeline',
            'name' => 'Timelines',
            'link' => route('timelines.index', ['status' => 'active']),
        ],
        [
            'icon' => 'components.icons.achievement',
            'name' => 'Achievements',
            'link' => route('achievements.index', ['status' => 'active']),
        ],
        [
            'icon' => 'components.icons.sponsor',
            'name' => 'Sponsors',
            'link' => route('sponsors.index', ['status' => 'active']),
        ],
        [
            'icon' => 'components.icons.medpart',
            'name' => 'Media Partner',
            'link' => route('media-partners.index', ['status' => 'active']),
        ],
        [
            'icon' => 'components.icons.team',
            'name' => 'Teams',
            'link' => route('teams.index', ['competition_status' => 'active']),
        ],
        [
            'icon' => 'components.icons.work',
            'name' => 'Works',
            'link' => route('works.index', ['status' => 'active']),
        ],
    ],
])
<button
    class="fixed z-20 bottom-5 left-5 md:hidden group peer/toggle cursor-pointer w-12 h-12 rounded-full bg-white shadow-lg flex flex-col justify-center items-center gap-[10px]">
    <span
        class="w-9 group-focus:translate-x-[6px] h-[2px] transition-all duration-200 bg-black block origin-top-left group-focus:rotate-[45deg]"></span>
    <span class="w-9 h-[2px] bg-black block group-focus:scale-0 transition-all duration-200"></span>
    <span
        class="w-9 group-focus:translate-x-[6px] h-[2px] transition-all duration-200 bg-black block origin-bottom-left group-focus:rotate-[-45deg]"></span>
</button>

<div
    class="z-30 md:z-0 group fixed peer-focus/toggle:translate-x-0 -translate-x-full md:translate-x-0 md:sticky top-0 w-80 md:w-20 md:hover:w-80 transition-all duration-500 bg-white h-fit">
    <aside
        class="p-5 flex flex-col justify-between h-screen bg-white w-80 md:w-20 hover:w-80 transition-all duration-500">
        <div class="flex flex-col gap-10">
            <a class="flex gap-2 items-center" href="{{ route('dashboard') }}">
                <div class="p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none"
                        stroke="{{ request()->url() == route('dashboard') ? '#064469' : 'currentColor' }}"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                </div>
                <p
                    class="text-black text-lg md:opacity-0 group-hover:opacity-100 transition-all duration-200 md:-translate-x-full group-hover:translate-x-0 hover:translate-x-2 font-bold">
                    Technotaiment
                </p>
            </a>
            <div class="flex flex-col gap-4">
                @foreach ($menu as $item)
                    <a href="{{ $item['link'] }}"
                        class="block hover:translate-x-2 duration-200 rounded-md relative {{ request()->url() == explode('?', $item['link'])[0] || implode('/', array_slice(explode('/', request()->url()), 0, 4)) == $item['link'] || implode('/', array_slice(explode('/', request()->url()), 0, 4)) == explode('?', $item['link'])[0] ? 'bg-blue-quinary after:absolute after:rounded-lg after:-right-5 after:top-0 after:bg-blue-tertiary after:w-1 after:h-10 after:hover:-translate-x-2 after:transition-all duration-300' : '' }}">
                        <div class="flex gap-2 items-center w-40 md:w-14 md:group-hover:w-40">
                            <div class="p-2 rounded-md">
                                @include($item['icon'])
                            </div>
                            <p
                                class="{{ request()->url() === explode('?', $item['link'])[0] ? 'text-gray-900' : 'text-neutral-500' }} whitespace-nowrap font-semibold md:opacity-0 group-hover:opacity-100 transition-all duration-200 md:-translate-x-full group-hover:translate-x-0 hover:translate-x-2 {{ request()->url() === explode('?', $item['link'])[0] ? 'text-blue-primary' : '' }}">
                                {{ $item['name'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </aside>
</div>
