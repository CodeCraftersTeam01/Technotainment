<div id="competition" class="relative py-24 bg-black">
    <x-web.section.background />

    {{-- Top line --}}
    <div class="absolute top-0 inset-x-0 h-px pointer-events-none"
         style="background: linear-gradient(90deg, transparent, rgba(0,198,230,0.25), transparent);"></div>

    <div class="relative z-10 container mx-auto px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 reveal">
            <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:1rem;">
                What We Offer
            </p>
            <h2 style="font-size:clamp(2rem,5vw,4rem); font-weight:900; letter-spacing:-0.04em; line-height:1.0; color:#ffffff; margin-bottom:1.25rem;">
                Competition Categories
            </h2>
            <div style="width:48px; height:1px; background:linear-gradient(90deg, transparent, #00c6e6, transparent); margin:0 auto;"></div>
        </div>

        {{-- Tab Switcher --}}
        <div class="flex justify-center mb-14 reveal reveal-delay-2">
            <div class="inline-flex p-1 rounded-full" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08);">
                <button onclick="switchTab('esport')" id="esportTab"
                    class="tab-pill active-tab px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-400 flex items-center gap-2">
                    <x-icons.gamepad width="18" height="18" />
                    E-Sport
                </button>
                <button onclick="switchTab('nonesport')" id="nonesportTab"
                    class="tab-pill px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-400 flex items-center gap-2">
                    <x-icons.light width="18" height="18" />
                    Non E-Sport
                </button>
            </div>
        </div>

        {{-- E-Sport Cards --}}
        <div id="esportContent" class="{{ request()->get('tab') == 'nonesport' ? 'hidden' : '' }}">
            @forelse($esports as $esport)
                <a href="/competition/{{ $esport->slug }}" class="block mb-6 group reveal">
                    <div class="relative overflow-hidden rounded-2xl border transition-all duration-500 group-hover:-translate-y-1"
                         style="background:rgba(255,255,255,0.025); border-color:rgba(255,255,255,0.07);"
                         onmouseover="this.style.borderColor='rgba(0,198,230,0.2)'; this.style.background='rgba(0,198,230,0.02)'; this.style.boxShadow='0 24px 48px -12px rgba(0,0,0,0.8)'"
                         onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='rgba(255,255,255,0.025)'; this.style.boxShadow='none'">

                        <div class="flex flex-col md:flex-row items-center gap-8 p-8 md:p-10">

                            {{-- Logo --}}
                            <div class="flex-shrink-0">
                                <div class="w-28 h-28 md:w-36 md:h-36 rounded-2xl overflow-hidden"
                                     style="border:1px solid rgba(255,255,255,0.08);">
                                    <img src="{{ Storage::url($esport->competition_logo) }}"
                                         alt="{{ $esport->competition_name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 text-center md:text-left">
                                <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:0.5rem;">
                                    E-Sport
                                </p>
                                <h3 style="font-size:clamp(1.5rem,3vw,2.25rem); font-weight:800; letter-spacing:-0.03em; color:#ffffff; margin-bottom:0.75rem; line-height:1.1;">
                                    {{ $esport->competition_name }}
                                </h3>
                                <p style="font-size:0.875rem; color:rgba(191,192,209,0.45); line-height:1.7; max-width:520px; font-weight:300;">
                                    {{ Str::limit($esport->competition_description, 120) }}
                                </p>
                            </div>

                            {{-- Meta --}}
                            <div class="flex flex-col gap-4 flex-shrink-0 text-center md:text-right">
                                <div>
                                    <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.25rem;">Prize Pool</p>
                                    <p style="font-size:1.1rem; font-weight:800; color:#00c6e6; letter-spacing:-0.02em;">
                                        Rp {{ number_format($esport->achievements->sum('achievement_price'), 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.25rem;">Reg. Fee</p>
                                    <p style="font-size:1.1rem; font-weight:800; color:#bfc0d1; letter-spacing:-0.02em;">
                                        Rp {{ number_format($esport->competition_fee, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 justify-center md:justify-end"
                                     style="color:rgba(0,198,230,0.7); font-size:0.8rem; font-weight:600; letter-spacing:0.02em;">
                                    View Details
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="group-hover:translate-x-1 transition-transform duration-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-20">
                    <p style="font-size:1rem; color:rgba(255,255,255,0.2); font-weight:300;">E-Sport Competition Coming Soon</p>
                </div>
            @endforelse
        </div>

        {{-- Non E-Sport Cards --}}
        <div id="nonesportContent" class="hidden">
            @forelse($nonesports as $nonesport)
                <a href="/competition/{{ $nonesport->slug }}" class="block mb-6 group reveal">
                    <div class="relative overflow-hidden rounded-2xl border transition-all duration-500 group-hover:-translate-y-1"
                         style="background:rgba(255,255,255,0.025); border-color:rgba(255,255,255,0.07);"
                         onmouseover="this.style.borderColor='rgba(0,198,230,0.2)'; this.style.background='rgba(0,198,230,0.02)'; this.style.boxShadow='0 24px 48px -12px rgba(0,0,0,0.8)'"
                         onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='rgba(255,255,255,0.025)'; this.style.boxShadow='none'">

                        <div class="flex flex-col md:flex-row items-center gap-8 p-8 md:p-10">
                            <div class="flex-shrink-0">
                                <div class="w-28 h-28 md:w-36 md:h-36 rounded-2xl overflow-hidden"
                                     style="border:1px solid rgba(255,255,255,0.08);">
                                    <img src="{{ Storage::url($nonesport->competition_logo) }}"
                                         alt="{{ $nonesport->competition_name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:rgba(191,192,209,0.6); margin-bottom:0.5rem;">
                                    Non E-Sport
                                </p>
                                <h3 style="font-size:clamp(1.5rem,3vw,2.25rem); font-weight:800; letter-spacing:-0.03em; color:#ffffff; margin-bottom:0.75rem; line-height:1.1;">
                                    {{ $nonesport->competition_name }}
                                </h3>
                                <p style="font-size:0.875rem; color:rgba(191,192,209,0.45); line-height:1.7; max-width:520px; font-weight:300;">
                                    {{ Str::limit($nonesport->competition_description, 120) }}
                                </p>
                            </div>
                            <div class="flex flex-col gap-4 flex-shrink-0 text-center md:text-right">
                                <div>
                                    <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.25rem;">Prize Pool</p>
                                    <p style="font-size:1.1rem; font-weight:800; color:#00c6e6; letter-spacing:-0.02em;">
                                        Rp {{ number_format($nonesport->achievements->sum('achievement_price'), 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.25rem;">Reg. Fee</p>
                                    <p style="font-size:1.1rem; font-weight:800; color:#bfc0d1; letter-spacing:-0.02em;">
                                        Rp {{ number_format($nonesport->competition_fee, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 justify-center md:justify-end"
                                     style="color:rgba(0,198,230,0.7); font-size:0.8rem; font-weight:600; letter-spacing:0.02em;">
                                    View Details
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="group-hover:translate-x-1 transition-transform duration-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-20">
                    <p style="font-size:1rem; color:rgba(255,255,255,0.2); font-weight:300;">Non-E-Sport Competition Coming Soon</p>
                </div>
            @endforelse
        </div>

    </div>

    <div class="absolute bottom-0 inset-x-0 h-px pointer-events-none"
         style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);"></div>

    <style>
        .tab-pill {
            color: rgba(255,255,255,0.35);
            transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .tab-pill.active-tab {
            background: rgba(0,198,230,0.12);
            color: #00c6e6;
        }
        .tab-pill:hover:not(.active-tab) {
            color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.05);
        }
    </style>

    <script>
        function switchTab(tab) {
            const esportContent   = document.getElementById('esportContent');
            const nonesportContent = document.getElementById('nonesportContent');
            const esportTab       = document.getElementById('esportTab');
            const nonesportTab    = document.getElementById('nonesportTab');

            if (tab === 'esport') {
                esportContent.classList.remove('hidden');
                nonesportContent.classList.add('hidden');
                esportTab.classList.add('active-tab');
                nonesportTab.classList.remove('active-tab');
            } else {
                nonesportContent.classList.remove('hidden');
                esportContent.classList.add('hidden');
                nonesportTab.classList.add('active-tab');
                esportTab.classList.remove('active-tab');
            }
        }
    </script>
</div>
