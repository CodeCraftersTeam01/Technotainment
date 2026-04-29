<x-layout>
    <x-web.section.navbar :event="$competition->event" />

    <div class="relative bg-black min-h-screen overflow-hidden">

        {{-- Ambient background --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-[#00c6e6]/8 rounded-full blur-[100px] pointer-events-none" style="will-change: filter;"></div>
        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-black to-transparent pointer-events-none z-10"></div>

        {{-- HERO --}}
        <div class="relative z-20 container mx-auto px-6 lg:px-8 pt-36 pb-16">
            <div class="max-w-4xl mx-auto text-center">

                {{-- Breadcrumb --}}
                <div class="flex items-center justify-center gap-2 mb-8"
                     style="font-size:0.65rem; font-weight:600; letter-spacing:0.2em; text-transform:uppercase; color:rgba(255,255,255,0.25);">
                    <a href="/" style="color:rgba(0,198,230,0.5); text-decoration:none; transition:color 0.3s"
                       onmouseover="this.style.color='#00c6e6'" onmouseout="this.style.color='rgba(0,198,230,0.5)'">Home</a>
                    <span>›</span>
                    <a href="/#competition" style="color:rgba(0,198,230,0.5); text-decoration:none; transition:color 0.3s"
                       onmouseover="this.style.color='#00c6e6'" onmouseout="this.style.color='rgba(0,198,230,0.5)'">Competition</a>
                    <span>›</span>
                    <span>{{ $competition->competition_name }}</span>
                </div>

                {{-- Logo --}}
                <div class="flex justify-center mb-8">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden"
                         style="border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 0 40px rgba(0,198,230,0.15);">
                        <img src="{{ Storage::url($competition->competition_logo) }}"
                             alt="{{ $competition->competition_name }}"
                             class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Title --}}
                <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:1rem;">
                    {{ $competition->competition_type ?? 'Competition' }}
                </p>
                <h1 style="font-size:clamp(2.5rem,6vw,5rem); font-weight:900; letter-spacing:-0.04em; line-height:1.0; color:#ffffff; margin-bottom:1.25rem;">
                    {{ $competition->competition_name }}
                </h1>
                <div style="width:48px; height:1px; background:linear-gradient(90deg, transparent, #00c6e6, transparent); margin:0 auto 1.5rem;"></div>
                <p style="font-size:1rem; color:rgba(191,192,209,0.5); font-weight:300; max-width:560px; margin:0 auto 2.5rem; line-height:1.7;">
                    {{ $competition->competition_description }}
                </p>

                {{-- Quick Stats --}}
                <div class="inline-grid grid-cols-2 md:grid-cols-2 gap-px mb-12"
                     style="background: rgba(255,255,255,0.06); border-radius:16px; overflow:hidden; border:1px solid rgba(255,255,255,0.06);">
                    <div class="px-8 py-5" style="background:#000;">
                        <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.4rem;">Prize Pool</p>
                        <p style="font-size:1.3rem; font-weight:800; color:#00c6e6; letter-spacing:-0.02em;">
                            Rp {{ number_format($competition->achievements->sum('achievement_price'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="px-8 py-5" style="background:#000; border-left:1px solid rgba(255,255,255,0.06);">
                        <p style="font-size:0.6rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.25); margin-bottom:0.4rem;">Reg. Fee</p>
                        <p style="font-size:1.3rem; font-weight:800; color:#bfc0d1; letter-spacing:-0.02em;">
                            Rp {{ number_format($competition->competition_fee, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- CTA --}}
                @if($competition->competition_status == 'active' && \Carbon\Carbon::parse(now())->format('Y-m-d') <= $competition->competition_end_date)
                    <div class="flex flex-wrap justify-center gap-3">
                        <a href="/registration/{{ $competition->slug }}" class="btn-primary">
                            Register Now
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <p class="w-full mt-2" style="font-size:0.75rem; color:rgba(255,255,255,0.2);">
                            Pendaftaran ditutup pada {{ \Carbon\Carbon::parse($competition->competition_end_date)->format('d F Y') }}
                        </p>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full"
                         style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08);">
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        <span style="font-size:0.8rem; color:rgba(255,255,255,0.4); font-weight:500;">Pendaftaran Ditutup</span>
                    </div>
                @endif

            </div>
        </div>

        {{-- CONTENT TABS --}}
        <div class="relative z-20 container mx-auto px-6 lg:px-8 pb-24">
            <div class="max-w-4xl mx-auto">

                {{-- Tab Nav --}}
                <div class="flex justify-center mb-10">
                    <div class="inline-flex p-1 rounded-full" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);">
                        @foreach(['overview' => 'Overview', 'guidebook' => 'Guidebook', 'timeline' => 'Timeline', 'prizes' => 'Prizes'] as $key => $label)
                            <button onclick="switchDetailTab('{{ $key }}')" id="{{ $key }}Tab"
                                class="detail-tab-pill {{ $key === 'overview' ? 'detail-tab-active' : '' }} px-3 md:px-6 py-1.5 md:py-2.5 rounded-full text-[10px] md:text-sm font-bold transition-all duration-300">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Tab Content --}}
                <div class="rounded-2xl overflow-hidden" style="background:rgba(255,255,255,0.025); border:1px solid rgba(255,255,255,0.07);">
                    <x-web.section.contentCompetition :competition="$competition" />
                </div>

            </div>
        </div>

    </div>

    <style>
        .detail-tab-pill {
            color: rgba(255,255,255,0.35);
            transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .detail-tab-pill.detail-tab-active {
            background: rgba(0,198,230,0.12);
            color: #00c6e6;
        }
        .detail-tab-pill:hover:not(.detail-tab-active) {
            color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.05);
        }
        .tab-content { display: none; padding: 2.5rem; }
        .tab-content.active { display: block; }
    </style>

    <script>
        function switchDetailTab(tab) {
            document.querySelectorAll('.tab-content').forEach(c => {
                c.classList.remove('active');
                c.style.display = 'none';
            });
            document.querySelectorAll('.detail-tab-pill').forEach(b => b.classList.remove('detail-tab-active'));
            const el = document.getElementById(`${tab}Content`);
            if (el) { el.classList.add('active'); el.style.display = 'block'; }
            document.getElementById(`${tab}Tab`).classList.add('detail-tab-active');
        }
        // Init
        document.addEventListener('DOMContentLoaded', () => {
            const first = document.querySelector('.tab-content');
            if (first) { first.classList.add('active'); first.style.display = 'block'; }
        });
    </script>
</x-layout>
