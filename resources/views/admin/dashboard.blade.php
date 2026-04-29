<x-admin.layout header="Dashboard">
    <!-- Welcome & Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Welcome Card -->
        <div
            class="w-full md:col-span-2 bg-white shadow-xl rounded-2xl p-8 relative overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-full -translate-y-32 translate-x-32 opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight">
                    <span class="from-blue-600 to-indigo-600 bg-gradient-to-r bg-clip-text text-transparent">Welcome back,</span> 👋
                </h2>
                <p class="text-gray-500 mt-4 md:w-2/3 leading-relaxed text-lg">
                    Manage your events, competitions, and teams all in one powerful dashboard.
                </p>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('events.create') }}"
                        class="bg-blue-600 py-3 px-6 rounded-xl text-white font-bold transition-all duration-300 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-500/30 flex items-center gap-2">
                        <span>Create New Event</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </a>
                </div>
            </div>
            <img class="hidden md:block w-72 absolute -bottom-4 -right-4 transition-all duration-500 group-hover:-translate-y-4 group-hover:scale-105"
                src="{{ asset('undraw_firmware_3fxd.png') }}" alt="welcome illustration">
        </div>

        <!-- Quick Overview -->
        <div class="w-full bg-white shadow-xl rounded-2xl p-6 border border-gray-100 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    Active Stats
                </h3>
                <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full uppercase tracking-wider">Live</span>
            </div>
            <div class="space-y-4 flex-1">
                @foreach ($statsActive as $stat)
                    <div
                        class="flex items-center p-3 rounded-xl transition-all duration-200 border border-transparent hover:border-gray-50 hover:bg-gray-50/50 group">
                        <div
                            class="flex justify-center items-center {{ $stat['colors']['bg-50'] }} {{ $stat['colors']['text-600'] }} p-3 rounded-xl group-hover:scale-110 transition-transform duration-300">
                            @include($stat['icon'], [
                                'width' => '20',
                                'height' => '20',
                                'class' => $stat['colors']['text-600'],
                            ])
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $stat['title'] }}</p>
                            <div class="flex items-center justify-between">
                                <h4 class="text-xl font-black text-gray-800">{{ $stat['value'] }}</h4>
                                <span class="text-xs font-bold text-green-500 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                    {{ $stat['trend'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        @foreach ($stats as $stat)
            <div
                class="bg-white p-6 shadow-lg rounded-2xl border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="{{ $stat['colors']['bg-50'] }} {{ $stat['colors']['text-600'] }} p-3 rounded-2xl group-hover:rotate-12 transition-transform">
                        @include($stat['icon'], [
                            'width' => '24',
                            'height' => '24',
                            'class' => $stat['colors']['text-600'],
                        ])
                    </div>
                    <span class="text-[10px] font-bold {{ $stat['trend_up'] ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} px-2 py-1 rounded-full uppercase">
                        {{ $stat['trend'] }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $stat['title'] }} Total</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $stat['value'] }}</h3>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Quick Access Menu -->
    <div class="mb-12">
        <h3 class="text-xl font-black text-gray-800 mb-8 flex items-center gap-3">
            <span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white text-sm">#</span>
            Quick Management
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($menu as $item)
                <a href="{{ $item['link'] }}" class="group block">
                    <div
                        class="aspect-square bg-white shadow-lg rounded-[2rem] flex flex-col justify-center items-center p-6 transition-all duration-500 border border-gray-50 group-hover:shadow-indigo-500/20 group-hover:scale-105 group-hover:border-indigo-100 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-gray-50 flex justify-center items-center mb-4 group-hover:bg-white group-hover:shadow-lg transition-all duration-500">
                                @include($item['icon'], ['width' => '32', 'height' => '32'])
                            </div>
                            <p class="font-bold text-gray-700 group-hover:text-indigo-600 transition-colors duration-300 text-sm tracking-tight text-center">
                                {{ $item['name'] }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Bottom Section: Activity & Recent -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white shadow-xl rounded-[2.5rem] p-8 border border-gray-50">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-black text-gray-800 flex items-center gap-3">
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    System Activity
                </h3>
                <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">History</a>
            </div>
            <div class="space-y-6">
                <!-- Activity Item 1 -->
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100 group">
                    <div class="bg-green-50 text-green-600 p-3 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">New event created: <span class="text-blue-600">Technotaiment {{ date('Y') }}</span></p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">2 hours ago</p>
                    </div>
                </div>
                <!-- Activity Item 2 -->
                <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-100 group">
                    <div class="bg-blue-50 text-blue-600 p-3 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">New team registered: <span class="text-blue-600">Cyber Warriors</span></p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Helpful Tips / Server Status Card -->
        <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl shadow-indigo-500/20 group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-black mb-4">Pro Dashboard Tip</h3>
                <p class="text-indigo-100 leading-relaxed mb-8 opacity-90">
                    Did you know you can manage all your event documents directly from the team detail page? Now with secure access for KTP and Invoices.
                </p>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold uppercase tracking-widest opacity-70">Server Integrity</span>
                        <span class="text-xs font-bold bg-green-500 px-2 py-0.5 rounded-full text-[10px]">Optimal</span>
                    </div>
                    <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-green-400 w-full h-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
