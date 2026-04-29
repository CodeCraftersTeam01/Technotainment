<footer id="footer" class="bg-black border-t border-white/[0.05] px-10">
    <div
        class="flex flex-col justify-between py-8 md:py-12 mx-auto space-y-8 gap-6 lg:flex-row lg:space-y-0 px-4 md:px-6">
        <div class="lg:w-1/3 flex flex-col">
            <div class="flex justify-center space-x-4 lg:justify-start">
                <div
                    class="flex items-center justify-center w-14 h-14 rounded-lg bg-gradient-to-r from-secondary to-tertiary hover:shadow-lg transition-shadow duration-300">
                    @if ($event)
                        <img src="{{ Storage::url($event->event_logo) }}" alt="Technotainment"
                            class="w-12 h-12 rounded-full object-cover hover:opacity-90 transition-opacity duration-300">
                    @endif
                </div>
                <span
                    class="self-center text-xl md:text-2xl font-bold text-white tracking-wide">{{ $event ? $event->event_name . ' ' . date('Y') : 'No Event' }}</span>
            </div>
            <div class="lg:max-w-72">
                <p class="text-white mt-4 pr-4 lg:max-w-72">
                    {{ $event ? $event->event_about : '' }}
                </p>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-8 lg:w-2/3">
            <div class="sm:text-left">
                <h2 class="mb-4 text-sm font-bold text-white uppercase tracking-wider">LINKS</h2>
                @if ($event)
                    <ul class="space-y-2">
                        @foreach ($event->competitions as $competition)
                            @if ($competition->competition_status == 'active')
                                <li>
                                    <a href="{{ '/competition/' . $competition->slug }}"
                                        class="text-gray-400 hover:text-white transition-all duration-300 hover:pl-2">
                                        {{ $competition->competition_name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="text-gray-400 hover:text-white transition-all duration-300 hover:pl-2">
                                Tidak ada Kompetisi
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="text-center sm:text-left">
                <h2 class="mb-4 text-sm font-bold text-white uppercase tracking-wider">PRESENTED BY</h2>
                <div class="flex gap-3 items-center justify-center sm:justify-start">
                    <div class="block transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/logo_utm.png') }}" alt="ITC Logo"
                            class="h-14 w-14 md:h-16 md:w-16 hover:opacity-90 transition-opacity duration-300">
                    </div>
                    <div
                        class="block transform hover:scale-105 transition-transform duration-300 h-14 w-14 md:h-16 md:w-16">
                        <img src="{{ asset('images/ITC HD-01.png') }}" alt="UTM Logo"
                            class=" hover:opacity-90 transition-opacity duration-300 w-full h-full object-cover">
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-between md:block sm:text-left md:space-y-4 col-span-2 md:col-span-1">
                <div>
                    <h2 class="mb-4 text-sm font-bold text-white uppercase tracking-wider">Social Media</h2>
                    <div class="flex space-x-6 items-center justify-center sm:justify-start">
                        <a href="https://www.instagram.com/technotainment.itc" target="_blank"
                            class="text-gray-400 hover:text-white transition-all duration-300 transform hover:scale-110">
                            <x-icons.instagram width="26" height="26" />
                        </a>
                        <a href="https://www.youtube.com/@UKMFTITCTrunojoyo" target="_blank"
                            class="text-gray-400 hover:text-white transition-all duration-300 transform hover:scale-110">
                            <x-icons.youtube width="26" height="26" />
                        </a>
                        <a href="https://www.tiktok.com/@technotainment.itc" target="_blank"
                            class="text-gray-400 hover:text-white transition-all duration-300 transform hover:scale-110">
                            <x-icons.tiktok width="26" height="26" />
                        </a>
                    </div>
                </div>
                <div class="sm:text-left">
                    <h2 class="mb-4 text-sm font-bold text-white uppercase tracking-wider">CONTACT US</h2>
                    <ul class="space-y-2">
                        <li class="space-y-2">
                            <a href="mailto:technotainment.itc@gmail.com"
                                class="block text-gray-400 text-xs md:text-base hover:text-white transition-all duration-300">
                                technotainment.itc@gmail.com
                            </a>
                            <a href="/"
                                class="block text-gray-400 text-xs md:text-base hover:text-white transition-all duration-300">
                                0813-5260-2516 (ZAKI)
                            </a>
                            <a href="/"
                                class="block text-gray-400 text-xs md:text-base hover:text-white transition-all duration-300">
                                0823-3145-9862 (MARTHA)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6 md:py-8 text-sm text-center text-gray-400 border-t border-gray-800">
        <p class="px-4">© {{ $event ? Str::upper($event->event_name) . ' ' . date('Y') . ' | ' : '' }}UKMFT -
            Information Technology Center UTM</p>
    </div>
</footer>
