<x-layout>
    <section class="flex bg-white min-h-screen">
        <x-admin.sidebar />
        <main
            class="w-full bg-gradient-to-br from-[#f0f0ff] to-[#f8f8ff] md:rounded-tl-3xl p-5 md:p-8 z-10 flex flex-col">

            <!-- Welcome & Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Welcome Card -->
                <div
                    class="w-full md:col-span-2 bg-white shadow-xl rounded-xl p-7 relative overflow-hidden border border-blue-50 transition-all duration-300 hover:shadow-blue-100/50">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full opacity-50"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-50 rounded-tr-full opacity-50"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-5xl font-bold">
                            <span class="from-blue-600 to-indigo-600 bg-gradient-to-r  bg-clip-text text-transparent">Welcome to Dashboard</span> 🚀
                        </h2>
                        <p class="text-neutral-500 mt-4 md:w-2/3 leading-relaxed md:text-xl">
                            Manage your events, competitions, and contributed team all in one place. Get started by
                            exploring the dashboard or creating a new event.
                        </p>
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('events.create') }}"
                                class="bg-gradient-to-r from-blue-500 to-indigo-600 py-2.5 px-5 rounded-lg text-white font-semibold transition-all duration-200 hover:shadow-lg hover:shadow-blue-300/50 flex items-center gap-2">
                                <span>Get Started</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <img class="w-full md:w-1/2 md:absolute -bottom-5 -right-5 mt-5 transition-all duration-300 hover:-translate-y-2"
                        src="{{ asset('undraw_firmware_3fxd.png') }}" alt="undraw firmware">
                </div>

                <!-- Quick Stats -->
                <div class="w-full bg-white shadow-xl rounded-xl p-5 border border-blue-50">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Quick Overview
                    </h3>
                    <div class="space-y-4">
                        @foreach ($statsActive as $stat)
                            <div
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:{{ $stat['colors']['bg-100'] }}">
                                <div
                                    class="flex justify-center items-center {{ $stat['colors']['bg-100'] }} {{ $stat['colors']['text-600'] }} p-3 rounded-lg">
                                    @include($stat['icon'], [
                                        'width' => '24',
                                        'height' => '24',
                                        'class' => $stat['colors']['text-600'],
                                    ])
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">{{ $stat['title'] }} <span class="text-green-500">Active</span></p>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-xl font-bold text-gray-800">{{ $stat['value'] }}</h4>
                                        <span
                                            class="text-xs font-medium {{ $stat['trend_up'] ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }} px-2 py-0.5 rounded-full flex items-center">
                                            {{ $stat['trend'] }} {{ $stat['value'] }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-0.5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ $stat['trend_up'] ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @foreach ($stats as $stat)
                    <div
                        class="w-full bg-white shadow-lg rounded-xl flex flex-col justify-between overflow-hidden border {{ $stat['colors']['border-100'] }} transition-all duration-300 hover:shadow-xl">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $stat['title'] }} Total</p>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stat['value'] }}</h3>
                                </div>
                                <div class="{{ $stat['colors']['bg-100'] }} {{ $stat['colors']['text-600'] }} p-2 rounded-lg">
                                    @include($stat['icon'], [
                                        'width' => '28',
                                        'height' => '28',
                                        'class' => $stat['colors']['text-600'],
                                    ])
                                </div>
                            </div>
                            <div class="mt-4 flex items-center">
                                <span
                                    class="text-xs font-medium {{ $stat['trend_up'] ? 'text-green-600' : 'text-red-600' }} flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $stat['trend_up'] ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                    {{ $stat['trend'] }}
                                </span>
                                <span class="text-xs text-gray-500 ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="h-2 {{ $stat['trend_up'] ? $stat['colors']['bg-up'] : $stat['colors']['bg-down'] }}"></div>
                    </div>
                @endforeach
            </div>

            <!-- Menu Grid -->
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Quick Access
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($menu as $item)
                    <a href="{{ $item['link'] }}" class="group">
                        <div
                            class="w-full aspect-square bg-white shadow-md rounded-xl flex flex-col justify-center items-center p-6 transition-all duration-300 border border-gray-100 group-hover:shadow-xl group-hover:scale-105 group-hover:border-blue-100 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative z-10 flex flex-col items-center">
                                <div
                                    class="w-16 h-16 rounded-full bg-blue-50 flex justify-center items-center mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                                    @include($item['icon'], [
                                        'width' => '32',
                                        'height' => '32',
                                        // 'class' => 'text-blue-600',
                                    ])
                                </div>
                                <p
                                    class="font-medium text-gray-700 group-hover:text-blue-700 transition-colors duration-300">
                                    {{ $item['name'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Recent Activity -->
            <div class="mt-8 bg-white shadow-lg rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Recent Activity
                    </h3>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800">New event created: <span
                                    class="text-blue-600">Annual Tech Conference</span></p>
                            <p class="text-xs text-gray-500 mt-1">Today, 10:30 AM</p>
                        </div>
                    </div>
                    <div class="flex items-start p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800">Updated competition: <span
                                    class="text-blue-600">Coding Challenge 2023</span></p>
                            <p class="text-xs text-gray-500 mt-1">Yesterday, 4:15 PM</p>
                        </div>
                    </div>
                    <div class="flex items-start p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800">New sponsor added: <span
                                    class="text-blue-600">TechCorp Inc.</span></p>
                            <p class="text-xs text-gray-500 mt-1">Mar 15, 2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-auto pt-8">
                <div class="border-t border-gray-200 pt-4 flex justify-between items-center text-sm text-gray-500">
                    <p>© 2025 UKM-FT ITC. All rights reserved.</p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Help</a>
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Privacy
                            Policy</a>
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Terms of
                            Service</a>
                    </div>
                </div>
            </div>
        </main>
    </section>
</x-layout>
