<x-layout>
<div class="min-h-screen bg-black flex">

    {{-- LEFT PANEL — Branding --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-16"
         style="background: linear-gradient(135deg, #000000 0%, #0a0f1a 50%, #000000 100%);">

        {{-- Ambient light --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#00c6e6]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-[#bfc0d1]/5 rounded-full blur-[100px] pointer-events-none"></div>

        {{-- Dot grid --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 40px 40px;"></div>

        {{-- Top left logo --}}
        <div class="relative z-10 flex items-center gap-3">
            @if(isset($eventLogo))
            <div class="w-8 h-8 rounded-lg overflow-hidden">
                <img src="{{ Storage::url($eventLogo) }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            @endif
            <span style="font-size:0.75rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:rgba(255,255,255,0.4);">
                Technotainment 2025
            </span>
        </div>

        {{-- Center branding --}}
        <div class="relative z-10 flex flex-col">
            <p style="font-size:0.65rem; font-weight:700; letter-spacing:0.3em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:1.5rem;">
                Participant Portal
            </p>
            <h1 style="font-size:clamp(3rem,5vw,4.5rem); font-weight:900; letter-spacing:-0.04em; line-height:1.0; color:#ffffff; margin-bottom:1rem;">
                Welcome<br>Back.
            </h1>
            <p style="font-size:1rem; font-weight:300; line-height:1.7; color:rgba(191,192,209,0.5); max-width:320px;">
                Masukkan token timmu untuk mengakses dashboard dan melanjutkan perjalananmu.
            </p>

            {{-- Decorative line --}}
            <div class="mt-10" style="width:48px; height:1px; background: linear-gradient(90deg, #00c6e6, transparent);"></div>
        </div>

        {{-- Bottom quote --}}
        <div class="relative z-10">
            <p style="font-size:0.75rem; color:rgba(255,255,255,0.2); font-weight:300; font-style:italic; line-height:1.6;">
                "Innovating the Future Through Technology and Entertainment"
            </p>
            <p style="font-size:0.62rem; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:rgba(0,198,230,0.4); margin-top:0.5rem;">
                UKMFT-ITC · UTM
            </p>
        </div>
    </div>

    {{-- RIGHT PANEL — Login Form --}}
    <div class="flex-1 flex flex-col justify-center items-center px-8 py-16 relative">

        {{-- Mobile logo --}}
        <div class="flex lg:hidden items-center gap-3 absolute top-8 left-8">
            <span style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.4);">
                Technotainment 2025
            </span>
        </div>

        <div class="w-full max-w-md">

            {{-- Form Header --}}
            <div class="mb-10">
                <p style="font-size:0.62rem; font-weight:700; letter-spacing:0.25em; text-transform:uppercase; color:rgba(0,198,230,0.6); margin-bottom:0.75rem;">
                    Sign In
                </p>
                <h2 style="font-size:2.25rem; font-weight:800; letter-spacing:-0.03em; color:#ffffff; margin-bottom:0.5rem;">
                    Enter your token
                </h2>
                <p style="font-size:0.875rem; color:rgba(191,192,209,0.5); font-weight:300; line-height:1.6;">
                    Token diberikan saat registrasi tim berhasil.
                </p>
            </div>

            {{-- Form --}}
            <form action="{{ route('team.login.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Token Input --}}
                <div>
                    <label for="token" style="display:block; font-size:0.7rem; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:0.625rem;">
                        Team Token
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="team_token"
                            id="token"
                            placeholder="Contoh: XJ29-L0PQ-AB12"
                            required
                            autocomplete="off"
                            class="w-full"
                            style="
                                padding: 0.875rem 1.25rem;
                                background: rgba(255,255,255,0.04);
                                border: 1px solid {{ session('error') || $errors->has('team_token') ? 'rgba(239,68,68,0.5)' : 'rgba(255,255,255,0.1)' }};
                                border-radius: 12px;
                                color: #00c6e6;
                                font-family: 'JetBrains Mono', 'Fira Code', monospace;
                                font-size: 0.95rem;
                                letter-spacing: 0.08em;
                                outline: none;
                                transition: all 0.3s ease;
                                width: 100%;
                                box-sizing: border-box;
                            "
                            onfocus="this.style.borderColor='rgba(0,198,230,0.5)'; this.style.background='rgba(0,198,230,0.04)'; this.style.boxShadow='0 0 0 3px rgba(0,198,230,0.08)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.04)'; this.style.boxShadow='none'"
                        >
                    </div>

                    @if(session('error'))
                        <p class="mt-2 text-red-400 text-sm">{{ session('error') }}</p>
                    @endif
                    @error('team_token')
                        <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-2">
                    <a href="/"
                       style="
                           flex: 0 0 auto;
                           padding: 0.875rem 1.25rem;
                           background: rgba(255,255,255,0.04);
                           border: 1px solid rgba(255,255,255,0.1);
                           border-radius: 12px;
                           color: rgba(255,255,255,0.5);
                           font-size: 0.875rem;
                           font-weight: 500;
                           text-decoration: none;
                           transition: all 0.3s ease;
                           display: flex;
                           align-items: center;
                           gap: 0.5rem;
                       "
                       onmouseover="this.style.background='rgba(255,255,255,0.08)'; this.style.color='rgba(255,255,255,0.8)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.04)'; this.style.color='rgba(255,255,255,0.5)'">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back
                    </a>

                    <button type="submit"
                            class="btn-primary flex-1"
                            style="border-radius: 12px; justify-content: center;">
                        Sign In
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Divider --}}
            <div class="mt-10 pt-8" style="border-top: 1px solid rgba(255,255,255,0.06);">
                <p style="font-size:0.75rem; color:rgba(255,255,255,0.2); text-align:center; line-height:1.6;">
                    Belum punya token? Daftar terlebih dahulu melalui
                    <a href="#competition" style="color:rgba(0,198,230,0.7); text-decoration:none; font-weight:500;">halaman kompetisi</a>
                </p>
            </div>

        </div>
    </div>

</div>

{{-- Vertical divider --}}
<style>
    .hidden.lg\:flex + div {
        border-left: 1px solid rgba(255,255,255,0.05);
    }
</style>
</x-layout>
