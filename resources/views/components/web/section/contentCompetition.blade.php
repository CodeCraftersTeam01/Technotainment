@props(['competition'])
<div id="overviewContent" class="tab-content active">
    <div class="text-white space-y-4 md:space-y-8">
        <p class="text-3xl text-center font-bold leading-relaxed text-quaternary">INFORMASI</p>
        <div class="prose">
            <x-markdown>
                {!! $competition->competition_information !!}
            </x-markdown>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="stat-card bg-gradient-to-br from-white/10 to-transparent backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:border-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <div class="flex items-center mb-4">
                    <span class="p-2 bg-tertiary/20 rounded-lg mr-3">
                        <x-icons.date width="24" height="24" class="text-tertiary" />
                    </span>
                    <h3 class="text-xl font-bold">Biaya Registrasi</h3>
                </div>
                <p class="text-3xl font-bold text-tertiary">Rp
                    {{ number_format($competition->competition_fee, 0, ',', '.') }}</p>
                <p class="text-white/70 mt-2">
                    @if ($competition->slug == 'dZ4AnskCXj')
                        Per Orang
                    @else
                        Per Tim
                    @endif
                </p>
            </div>
            <div
                class="stat-card bg-gradient-to-br from-white/10 to-transparent backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:border-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <div class="flex items-center mb-4">
                    <span class="p-2 bg-tertiary/20 rounded-lg mr-3">
                        <x-icons.gift width="24" height="24" class="text-tertiary" />
                    </span>
                    <h3 class="text-xl font-bold">Total Prize Pool</h3>
                </div>
                <p class="text-3xl font-bold text-quaternary">
                    Rp {{ number_format($competition->achievements->sum('achievement_price'), 0, ',', '.') }}</p>
                <p class="text-white/70 mt-2">Dibagi untuk setiap pemenang</p>
            </div>
            <div
                class="stat-card bg-gradient-to-br from-white/10 to-transparent backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:border-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                <div class="flex items-center mb-4">
                    <span class="p-2 bg-green-500/20 rounded-lg mr-3">
                        <x-icons.check width="24" height="24" class="text-green-400" />
                    </span>
                    <h3 class="text-xl font-bold">Status Lomba</h3>
                </div>
                <p
                    class="text-3xl font-bold {{ $competition->competition_status == 'active' && \Carbon\Carbon::parse(now())->format('Y-m-d') <= $competition->competition_end_date ? 'text-green-400' : 'text-red-400' }}">
                    {{ $competition->competition_status == 'active' && \Carbon\Carbon::parse(now())->format('Y-m-d') <= $competition->competition_end_date ? 'Open' : 'Close' }}</p>
                <p class="
                @if(\Carbon\Carbon::parse(now())->format('Y-m-d') < $competition->competition_end_date)
                {{ 'text-white/70' }}
                @elseif(\Carbon\Carbon::parse(now())->format('Y-m-d') == $competition->competition_end_date)
                {{ 'text-yellow-400' }}
                @elseif(\Carbon\Carbon::parse(now())->format('Y-m-d') > $competition->competition_end_date)
                {{ 'text-red-400' }}
                @endif
                mt-2">
                    {{ \Carbon\Carbon::parse($competition->competition_end_date)->format('d F Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div id="guidebookContent" class="tab-content hidden">
    <div class="text-white">
        <div class="prose prose-invert max-w-none">
            <div
                class="bg-gradient-to-br from-white/10 to-transparent backdrop-blur-sm p-8 rounded-2xl border border-white/10">
                <h2 class="text-2xl font-bold mb-4 text-tertiary">Panduan Umum Lomba</h2>
                <p class="mb-4">Unduh panduan lengkap yang berisi semua peraturan, ketentuan, dan informasi penting
                    terkait penyelenggaraan lomba.</p>
                <ul class="space-y-2 list-disc list-inside mb-6">
                    <li>Format dan peraturan kompetisi</li>
                    <li>Jadwal dan rincian kegiatan</li>
                    <li>Informasi pembagian hadiah</li>
                    <li>Persyaratan peserta dan tim</li>
                    <li>Spesifikasi teknis dan kebutuhan lainnya</li>
                </ul>
            </div>
        </div>
        <div class="mt-8 text-center">
            <a href="{{ Storage::url($competition->competition_guide_book) }}"
                class="group inline-flex items-center px-8 py-3 bg-gradient-to-r from-tertiary to-quaternary rounded-full font-semibold hover:opacity-90 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <x-icons.download width="24" height="24" class="mr-2 group-hover:animate-bounce" />
                Download Guidebook
            </a>
        </div>
    </div>
</div>

<div id="timelineContent" class="tab-content hidden">
    <div class="text-white">
        @if ($competition->timelines->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative">
                @foreach ($competition->timelines as $index => $timeline)
                    <div
                        class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-5 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-tertiary/70 before:via-tertiary/40 before:to-transparent">
                        <div class="relative flex items-start gap-6">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-r from-yellow-500 to-red-500 flex items-center justify-center flex-shrink-0 pulse shadow-lg z-10">
                                <span class="font-bold">{{ $index + 1 }}</span>
                            </div>
                            <div
                                class="glass-card rounded-xl p-6 flex-grow bg-white/5 backdrop-blur-sm border border-white/10 hover:border-white/20 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                                <h3 class="text-lg md:text-xl font-bold mb-2 text-tertiary">
                                    {{ $timeline->timeline_name }}</h3>
                                <p class="text-sm md:text-base text-gray-300 mb-3">
                                    {{ $timeline->timeline_description }}
                                </p>
                                <div class="flex items-center text-yellow-400">
                                    <x-icons.date width="20" height="20" class="mr-2" />
                                    <span class="text-sm md:text-base">
                                        {{ \Carbon\Carbon::parse($timeline->timeline_start)->format('d F') }}
                                        @if ($timeline->timeline_end)
                                            - {{ \Carbon\Carbon::parse($timeline->timeline_end)->format('d F') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h1
                class="text-2xl font-semibold bg-clip-text text-center text-transparent bg-gradient-to-r from-tertiary to-quaternary">
                Tidak ada Timeline</h1>
        @endif
    </div>
</div>

<div id="prizesContent" class="tab-content hidden">
    <div class="text-white">
        @if ($competition->achievements->count() >= 3)
            <div class="flex flex-col md:flex-row gap-8 items-center justify-center">
                @if (Str::contains($competition->achievements[1]->achievement_name, '2'))
                    <div
                        class="order-2 md:order-1 transform hover:scale-105 transition-transform duration-300 w-full md:w-3/12">
                        <div
                            class="text-center p-6 bg-gradient-to-b from-white/10 to-transparent backdrop-blur-md rounded-2xl border border-white/10 hover:border-white/30 transition-all h-full">
                            <div
                                class="w-20 h-20 mx-auto bg-gradient-to-r from-gray-400 to-gray-300 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                <x-icons.trophy width="40" height="40" class="text-gray-800 font-bold" />
                            </div>
                            <div class="text-3xl font-bold mb-4">{{ $competition->achievements[1]->achievement_name }}
                            </div>
                            <div class="text-2xl text-gray-300 mb-2">
                                Rp {{ number_format($competition->achievements[1]->achievement_price, 0, ',', '.') }}
                            </div>
                            <div class="h-1 w-16 bg-gray-400 mx-auto mb-4 rounded-full"></div>
                            <p class="text-gray-300">{{ $competition->achievements[1]->achievement_description }}</p>
                        </div>
                    </div>
                @endif
                @if (Str::contains($competition->achievements[0]->achievement_name, '1'))
                    <div
                        class="order-1 md:order-2 transform hover:scale-110 transition-transform duration-300 w-full md:w-4/12 z-10">
                        <div
                            class="text-center p-8 bg-gradient-to-b from-yellow-500/20 to-transparent backdrop-blur-md rounded-2xl border border-yellow-500/30 hover:border-yellow-500/50 transition-all h-full">
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-r from-yellow-500 to-amber-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                <x-icons.trophy width="50" height="50" class="text-yellow-900 font-bold" />
                            </div>
                            <div class="text-4xl font-bold mb-4">{{ $competition->achievements[0]->achievement_name }}
                            </div>
                            <div class="text-3xl text-yellow-400 mb-2">
                                Rp {{ number_format($competition->achievements[0]->achievement_price, 0, ',', '.') }}
                            </div>
                            <div class="h-1 w-24 bg-yellow-400 mx-auto mb-4 rounded-full"></div>
                            <p class="text-gray-300">{{ $competition->achievements[0]->achievement_description }}</p>
                        </div>
                    </div>
                @endif
                @if (Str::contains($competition->achievements[2]->achievement_name, '3'))
                    <div class="order-3 transform hover:scale-105 transition-transform duration-300 w-full md:w-3/12">
                        <div
                            class="text-center p-6 bg-gradient-to-b from-white/10 to-transparent backdrop-blur-md rounded-2xl border border-white/10 hover:border-white/30 transition-all h-full">
                            <div
                                class="w-20 h-20 mx-auto bg-gradient-to-r from-amber-700 to-amber-500 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                <x-icons.trophy width="40" height="40" class="text-amber-900 font-bold" />
                            </div>
                            <div class="text-3xl font-bold mb-4">{{ $competition->achievements[2]->achievement_name }}
                            </div>
                            <div class="text-2xl text-amber-600 mb-2">
                                Rp {{ number_format($competition->achievements[2]->achievement_price, 0, ',', '.') }}
                            </div>
                            <div class="h-1 w-16 bg-amber-600 mx-auto mb-4 rounded-full"></div>
                            <p class="text-gray-300">{{ $competition->achievements[2]->achievement_description }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <h1
                class="text-2xl font-semibold bg-clip-text text-center text-transparent bg-gradient-to-r from-tertiary to-quaternary">
                Tidak ada Hadiah</h1>
        @endif
    </div>
</div>
