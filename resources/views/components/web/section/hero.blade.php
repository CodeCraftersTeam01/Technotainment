@props(['mediaPartners', 'event', 'sponsors'])

<div id="home" class="relative min-h-screen bg-black overflow-hidden">

    {{-- Ambient light orbs --}}
    <div class="absolute top-[-5%] left-1/2 -translate-x-1/2 w-[900px] h-[600px] bg-[#00c6e6]/12 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/5 w-[500px] h-[500px] bg-[#00c6e6]/6 rounded-full blur-[120px] pointer-events-none animate-blob"></div>

    {{-- Square Grid --}}
    <div class="absolute inset-0 pointer-events-none z-0"
         style="background-image: linear-gradient(rgba(128,128,128,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(128,128,128,0.1) 1px, transparent 1px); background-size: 64px 64px;"></div>

    {{-- Large Background Typography Watermark --}}
    <div class="hidden md:flex absolute inset-0 items-center justify-center pointer-events-none select-none overflow-hidden z-0">
        <span class="font-black text-transparent whitespace-nowrap opacity-20 transform -translate-y-10"
              style="
                  font-size: clamp(8rem, 15vw, 20rem);
                  -webkit-text-stroke: 2px rgba(255, 255, 255, 0.4);
                  letter-spacing: 0.05em;
              ">
            {{ $event ? strtoupper($event->event_name) : 'TECHNOTAINMENT' }}
        </span>
    </div>

    {{-- Top fade --}}
    <div class="absolute top-0 inset-x-0 h-40 bg-gradient-to-b from-black to-transparent pointer-events-none z-10"></div>

    {{-- Hero Content --}}
    <div class="relative z-20 container mx-auto px-6 lg:px-8 flex flex-col items-center justify-center min-h-screen text-center pt-28 pb-20">

        {{-- Status badge --}}
        <div class="reveal mb-10 inline-flex items-center gap-2.5 px-4 py-2 rounded-full"
             style="background: rgba(0, 198, 230, 0.08); border: 1px solid rgba(0, 198, 230, 0.25);">
            <span class="relative flex h-2 w-2 flex-shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00c6e6] opacity-60"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#00c6e6]"></span>
            </span>
            <span style="font-size: 0.62rem; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; color: #00c6e6; white-space: nowrap;">
                Official Event 2025
            </span>
        </div>

        {{-- Eyebrow --}}
        <p class="reveal reveal-delay-1 mb-5"
           style="font-size: 0.68rem; font-weight: 600; letter-spacing: 0.35em; text-transform: uppercase; color: rgba(191, 192, 209, 0.45);">
            UKMFT-ITC Presents
        </p>

        {{-- Main Title + Year stacked — solve clip by using outline + solid on title, gradient on year separately --}}
        <div class="reveal reveal-delay-2" style="margin-bottom: 2.5rem; line-height: 1; position: relative; z-index: 30; isolation: isolate;">

            {{-- Event Name --}}
            <div style="
                font-size: clamp(3rem, 9vw, 7.5rem);
                font-weight: 900;
                letter-spacing: -0.04em;
                line-height: 1.0;
                color: #ffffff;
                text-shadow: 0 0 60px rgba(0, 198, 230, 0.18);
                margin-bottom: 0;
            ">{{ $event ? $event->event_name : 'Technotainment' }}</div>

            {{-- Year — key fix: extra vertical padding to prevent clip --}}
            <div style="
                padding-top: 0.15em;
                padding-bottom: 0.25em;
                overflow: visible;
                display: block;
            ">
                <span style="
                    display: inline-block;
                    font-size: clamp(3rem, 9vw, 7.5rem);
                    font-weight: 900;
                    letter-spacing: -0.04em;
                    line-height: 1.1;
                    font-style: italic;
                    padding-bottom: 0.15em;
                    padding-left: 0.15em;
                    padding-right: 0.15em;
                    background: linear-gradient(100deg, #00c6e6 0%, #7ee8f8 30%, #ffffff 55%, #00c6e6 80%);
                    background-size: 250% 100%;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    animation: shimmer-year 4s linear infinite;
                    transform: translateZ(0);
                    will-change: transform;
                ">{{ $event ? $event->event_year : '2025' }}</span>
            </div>
        </div>

        {{-- Divider --}}
        <div class="reveal reveal-delay-3 mx-auto mb-8 opacity-50"
             style="width: 80px; height: 1px; background: linear-gradient(90deg, transparent, #00c6e6, transparent);"></div>

        {{-- Tagline --}}
        <p class="reveal reveal-delay-3 mb-12"
           style="color: rgba(191, 192, 209, 0.5); font-size: 1rem; font-weight: 300; max-width: 480px; line-height: 1.75; letter-spacing: 0.01em;">
            {{ $event ? $event->event_theme : 'Innovating the Future Through Technology and Entertainment' }}
        </p>

        {{-- CTA Buttons --}}
        <div class="reveal reveal-delay-4 flex flex-wrap justify-center gap-3 mb-28">
            <a href="#competition" class="btn-primary">
                Register Now
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="#about" class="btn-secondary">
                Learn More
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="reveal reveal-delay-4 w-full max-w-xl mx-auto">
            <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.1),transparent);margin-bottom:2rem;"></div>
            <div class="grid grid-cols-3 gap-8">
                <div class="text-center">
                    <p style="color:#00c6e6;font-size:1.3rem;font-weight:800;letter-spacing:-0.03em;margin-bottom:4px;">
                        {{ $event ? $event->event_year : '2025' }}
                    </p>
                    <p style="color:rgba(255,255,255,0.25);font-size:0.6rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;">Event Year</p>
                </div>
                <div class="text-center" style="border-left:1px solid rgba(255,255,255,0.07);border-right:1px solid rgba(255,255,255,0.07);">
                    <p style="color:#fff;font-size:1.3rem;font-weight:800;letter-spacing:-0.03em;margin-bottom:4px;">UTM</p>
                    <p style="color:rgba(255,255,255,0.25);font-size:0.6rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;">Madura</p>
                </div>
                <div class="text-center">
                    <p style="color:#00c6e6;font-size:1.3rem;font-weight:800;letter-spacing:-0.03em;margin-bottom:4px;">4+</p>
                    <p style="color:rgba(255,255,255,0.25);font-size:0.6rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;">Categories</p>
                </div>
            </div>
            <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.1),transparent);margin-top:2rem;"></div>
        </div>

    </div>

    {{-- Bottom fade --}}
    <div class="absolute bottom-0 inset-x-0 h-40 bg-gradient-to-t from-black to-transparent pointer-events-none z-10"></div>
</div>

<style>
@keyframes shimmer-year {
    0%   { background-position: 100% center; }
    100% { background-position: -100% center; }
}
</style>
