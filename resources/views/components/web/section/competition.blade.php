<div id="competition" class="relative px-4 pt-8 md:pt-12 lg:pt-24 bg-gradient-to-br from-primary to-secondary">
    <x-web.section.background />
    <div class="relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-16 relative pt-12">
            <span
                class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/3 text-[40px] sm:text-[70px] md:text-[90px] lg:text-[120px] xl:text-[140px] text-transparent bg-clip-text bg-gradient-to-r from-secondary via-tertiary to-quaternary font-black italic transform -rotate-3 select-none tracking-wider">COMPETITIONS</span>
            <h2
                class="relative font-extrabold text-quaternary/85 -translate-y-8 sm:-translate-y-2 md:-translate-y-0 lg:translate-y-4 text-2xl sm:text-3xl md:text-5xl lg:text-6xl mb-6 tracking-tighter drop-shadow-lg">
                Competition Categories</h2>
            <div
                class="w-40 h-2 bg-gradient-to-r from-secondary via-tertiary to-quaternary mx-auto rounded-full animate-pulse shadow-glow">
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="flex justify-center mb-16">
            <div
                class="inline-flex rounded-full bg-gradient-to-br from-white/10 to-gray-900/10 backdrop-blur-2xl p-2 shadow-xl border border-white/20">
                <button onclick="switchTab('esport')" id="esportTab"
                    class="px-4 md:px-8 py-3 rounded-full text-quaternary transition-all duration-300 flex items-center gap-3 bg-gradient-to-br from-[#064469] to-[#5790ab] shadow-[0_6px_20px_rgba(6,68,105,0.3)] group">
                    <x-icons.gamepad width="28" height="28" />
                    <span class="font-semibold text-lg">E-Sport</span>
                </button>
                <button onclick="switchTab('nonesport')" id="nonesportTab"
                    class="px-4 md:px-8 py-3 rounded-full text-quaternary transition-all duration-300 flex items-center gap-3 group">
                    <x-icons.light width="28" height="28" />
                    <span class="font-semibold text-lg">Non E-Sport</span>
                </button>
            </div>
        </div>

        <section class="py-12">
            <!-- E-Sport Categories -->
            <div id="esportContent" class="my-0 {{ request()->get('tab') == 'nonesport' ? 'hidden' : '' }}">
                <!-- Loop E-Sport -->
                @forelse($esports as $esport)
                    <a href="/competition/{{ $esport->slug }}">
                        <div
                            class="bg-white/[0.03] backdrop-blur-lg mb-8 rounded-3xl border border-white/[0.1] transition-all duration-400 hover:-translate-y-2.5 hover:shadow-[0_25px_50px_rgba(6,68,105,0.25)] hover:border-white/[0.2] relative overflow-hidden group reveal">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-secondary/10 to-tertiary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="relative p-10">
                                <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                                    <div class="md:w-1/2 flex justify-center">
                                        <div
                                            class="relative transform transition-transform duration-500 group-hover:scale-105">
                                            <div
                                                class="w-72 h-72 md:w-96 md:h-96 rounded-full border-4 border-gradient-to-r from-quaternary to-tertiary flex items-center justify-center overflow-hidden shadow-2xl">
                                                <img src="{{ Storage::url($esport->competition_logo) }}" alt="PES Game"
                                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                                            </div>
                                            <div
                                                class="absolute -bottom-6 -left-6 w-44 h-44 rounded-full border-4 border-tertiary overflow-hidden shadow-lg">
                                                <img src="{{ Storage::url($esport->competition_third_logo) }}"
                                                    alt="Third Logo" class="w-full h-full object-cover" loading="lazy">
                                            </div>
                                            <div
                                                class="absolute -top-6 -right-6 w-44 h-44 rounded-full border-4 border-tertiary overflow-hidden shadow-lg">
                                                <img src="{{ Storage::url($esport->competition_second_logo) }}"
                                                    alt="Second Logo" class="w-full h-full object-cover" loading="lazy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-1/2 text-white">
                                        <h1
                                            class="text-5xl md:text-6xl font-extrabold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary">
                                            {{ $esport->competition_name }}</h1>
                                        <p class="text-xl mb-8 leading-relaxed opacity-90">
                                            {{ $esport->competition_description }}
                                        </p>
                                        <ul class="space-y-6 text-lg">
                                            <li class="flex items-center gap-4"><span
                                                    class="w-10 h-1 bg-gradient-to-r from-quaternary to-tertiary rounded-full"></span>Prize
                                                Pool:
                                                Rp {{ number_format($esport->achievements->sum('achievement_price'), 0, ',', '.') }}
                                            </li>
                                            <li class="flex items-center gap-4"><span
                                                    class="w-10 h-1 bg-gradient-to-r from-quaternary to-tertiary rounded-full"></span>Registration
                                                Fee: Rp {{ number_format($esport->competition_fee, 0, ',', '.') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <h1
                        class="text-2xl font-semibold bg-clip-text text-transparent text-center bg-gradient-to-r from-tertiary to-quaternary">
                        E-Sport Competition Coming Soon</h1>
                @endforelse
            </div>

            <!-- Non E-Sport Categories -->
            <div id="nonesportContent" class="my-0 hidden">
                <!-- UI/UX -->
                @forelse ($nonesports as $nonesport)
                    <a href="/competition/{{ $nonesport->slug }}">
                        <div
                            class="bg-white/[0.03] backdrop-blur-lg mb-8 rounded-3xl border border-white/[0.1] transition-all duration-400 hover:-translate-y-2.5 hover:shadow-[0_25px_50px_rgba(6,68,105,0.25)] hover:border-white/[0.2] relative overflow-hidden group reveal">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-secondary/10 to-tertiary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div class="relative p-10">
                                <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                                    <div class="md:w-1/2 flex justify-center">
                                        <div
                                            class="relative transform transition-transform duration-500 group-hover:scale-105">
                                            <div
                                                class="w-72 h-72 md:w-96 md:h-96 rounded-full border-4 border-gradient-to-r from-quaternary to-tertiary flex items-center justify-center overflow-hidden shadow-2xl">
                                                <img src="{{ Storage::url($nonesport->competition_logo) }}"
                                                    alt="UI/UX Design"
                                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                                            </div>
                                            <div
                                                class="absolute -bottom-6 -left-6 w-44 h-44 rounded-full border-4 border-tertiary overflow-hidden shadow-lg">
                                                <img src="{{ Storage::url($nonesport->competition_third_logo) }}"
                                                    alt="Figma" class="w-full h-full object-cover" loading="lazy">
                                            </div>
                                            <div
                                                class="absolute -top-6 -right-6 w-44 h-44 rounded-full border-4 border-tertiary overflow-hidden shadow-lg">
                                                <img src="{{ Storage::url($nonesport->competition_second_logo) }}"
                                                    alt="Design" class="w-full h-full object-cover" loading="lazy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-1/2 text-white">
                                        <h1
                                            class="text-5xl md:text-6xl font-extrabold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary">
                                            {{ $nonesport->competition_name }}</h1>
                                        <p class="text-xl mb-8 leading-relaxed opacity-90">
                                            {{ $nonesport->competition_description }}
                                        </p>
                                        <ul class="space-y-6 text-lg">
                                            <li class="flex items-center gap-4"><span
                                                    class="w-10 h-1 bg-gradient-to-r from-quaternary to-tertiary rounded-full"></span>Prize
                                                Pool:
                                                Rp {{ number_format($nonesport->achievements->sum('achievement_price'), 0, ',', '.') }}
                                            </li>
                                            <li class="flex items-center gap-4"><span
                                                    class="w-10 h-1 bg-gradient-to-r from-quaternary to-tertiary rounded-full"></span>Registration
                                                Fee: Rp {{ number_format($nonesport->competition_fee, 0, ',', '.') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <h1
                        class="text-2xl font-semibold bg-clip-text text-transparent text-center bg-gradient-to-r from-tertiary to-quaternary">
                        Non-E-Sport Competition Coming Soon</h1>
                @endforelse
            </div>
        </section>
    </div>

    <script>
        function switchTab(tab) {
            const esportContent = document.getElementById('esportContent');
            const nonesportContent = document.getElementById('nonesportContent');
            const esportTab = document.getElementById('esportTab');
            const nonesportTab = document.getElementById('nonesportTab');

            if (tab === 'esport') {
                esportContent.classList.remove('hidden');
                nonesportContent.classList.add('hidden');
                esportTab.classList.add('bg-gradient-to-br', 'from-[#064469]', 'to-[#5790ab]', 'text-white',
                    'shadow-[0_6px_20px_rgba(6,68,105,0.3)]');
                nonesportTab.classList.remove('bg-gradient-to-br', 'from-[#064469]', 'to-[#5790ab]', 'text-white',
                    'shadow-[0_6px_20px_rgba(6,68,105,0.3)]');
            } else {
                esportContent.classList.add('hidden');
                nonesportContent.classList.remove('hidden');
                esportTab.classList.remove('bg-gradient-to-br', 'from-[#064469]', 'to-[#5790ab]', 'text-white',
                    'shadow-[0_6px_20px_rgba(6,68,105,0.3)]');
                nonesportTab.classList.add('bg-gradient-to-br', 'from-[#064469]', 'to-[#5790ab]', 'text-white',
                    'shadow-[0_6px_20px_rgba(6,68,105,0.3)]');
            }
        }
    </script>
</div>
