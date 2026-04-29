@props(['event'])

<div id="about" class="relative py-32 bg-[#071225] overflow-hidden">

    {{-- Subtle background --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 48px 48px;"></div>
    <div class="absolute top-0 inset-x-0 h-px pointer-events-none"
         style="background: linear-gradient(90deg, transparent, rgba(0,198,230,0.3), transparent);"></div>
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#00c6e6]/4 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 container mx-auto px-6 lg:px-8 max-w-5xl">

        {{-- Section Label --}}
        <div class="reveal mb-16 text-center">
            <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:1rem;">
                Who We Are
            </p>
            <h2 style="font-size:clamp(2.5rem,6vw,5rem); font-weight:900; letter-spacing:-0.04em; line-height:1.0; color:#ffffff;">
                About
                <span style="
                    background: linear-gradient(100deg, #00c6e6, #bfc0d1, #00c6e6);
                    background-size: 200% 100%;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    padding-bottom: 0.08em;
                    display: inline-block;
                ">{{ $event->event_name }}</span>
            </h2>
            <div class="mx-auto mt-6" style="width:60px; height:1px; background:linear-gradient(90deg, transparent, #00c6e6, transparent);"></div>
        </div>

        {{-- Big statement text --}}
        <div class="reveal reveal-delay-2 mb-20">
            <p style="
                font-size: clamp(1.3rem, 3vw, 2rem);
                font-weight: 300;
                line-height: 1.65;
                color: rgba(255,255,255,0.55);
                text-align: center;
                letter-spacing: -0.01em;
                max-width: 720px;
                margin: 0 auto;
            ">{{ $event->event_about }}</p>
        </div>

        {{-- 3 Pillars --}}
        <div class="reveal reveal-delay-3 grid grid-cols-1 md:grid-cols-3 gap-px"
             style="border: 1px solid rgba(255,255,255,0.07); border-radius: 20px; overflow:hidden;">

            {{-- Pillar 1 --}}
            <div class="group p-8 relative"
                 style="background: rgba(13,33,70,0.55); transition: background 0.4s ease;">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-none pointer-events-none"
                     style="background: linear-gradient(135deg, rgba(0,198,230,0.05), transparent);"></div>
                <p style="font-size:2.5rem; font-weight:900; color:#00c6e6; letter-spacing:-0.04em; margin-bottom:0.5rem; line-height:1;">
                    TECH
                </p>
                <div style="width:24px; height:1px; background:#00c6e6; margin-bottom:1rem; transition: width 0.4s ease;" class="group-hover:w-12"></div>
                <p style="font-size:0.8rem; color:rgba(255,255,255,0.4); line-height:1.7; font-weight:300;">
                    Kompetisi teknologi yang mendorong inovasi dan kreativitas para generasi digital.
                </p>
            </div>

            {{-- Pillar 2 --}}
            <div class="group p-8 relative"
                 style="background: rgba(13,33,70,0.55); border-left: 1px solid rgba(95,168,211,0.08); border-right: 1px solid rgba(95,168,211,0.08); transition: background 0.4s ease;">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                     style="background: linear-gradient(135deg, rgba(0,198,230,0.05), transparent);"></div>
                <p style="font-size:2.5rem; font-weight:900; color:#bfc0d1; letter-spacing:-0.04em; margin-bottom:0.5rem; line-height:1;">
                    TAIN
                </p>
                <div style="width:24px; height:1px; background:#bfc0d1; margin-bottom:1rem; transition: width 0.4s ease;" class="group-hover:w-12"></div>
                <p style="font-size:0.8rem; color:rgba(255,255,255,0.4); line-height:1.7; font-weight:300;">
                    Entertainment yang menghibur dan menginspirasi seluruh civitas akademika Universitas Trunojoyo.
                </p>
            </div>

            {{-- Pillar 3 --}}
            <div class="group p-8 relative"
                 style="background: rgba(13,33,70,0.55); transition: background 0.4s ease;">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"
                     style="background: linear-gradient(135deg, rgba(0,198,230,0.05), transparent);"></div>
                <p style="font-size:2.5rem; font-weight:900; letter-spacing:-0.04em; margin-bottom:0.5rem; line-height:1; background: linear-gradient(100deg,#00c6e6,#bfc0d1); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; padding-bottom:0.08em; display:inline-block;">
                    MENT
                </p>
                <div style="width:24px; height:1px; background:linear-gradient(90deg,#00c6e6,#bfc0d1); margin-bottom:1rem; transition: width 0.4s ease;" class="group-hover:w-12"></div>
                <p style="font-size:0.8rem; color:rgba(255,255,255,0.4); line-height:1.7; font-weight:300;">
                    Sebuah momen bersejarah bagi UKMFT-ITC dalam mengembangkan potensi mahasiswa Madura.
                </p>
            </div>
        </div>

        {{-- Bottom accent --}}
        <div class="reveal reveal-delay-4 flex items-center justify-center gap-6 mt-16">
            <div style="flex:1; height:1px; background:linear-gradient(90deg, transparent, rgba(255,255,255,0.08));"></div>
            <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.25em; text-transform:uppercase; color:rgba(255,255,255,0.2); white-space:nowrap;">
                UKMFT-ITC · Universitas Trunojoyo Madura
            </p>
            <div style="flex:1; height:1px; background:linear-gradient(90deg, rgba(255,255,255,0.08), transparent);"></div>
        </div>

    </div>

    <div class="absolute bottom-0 inset-x-0 h-px pointer-events-none"
         style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);"></div>
</div>
