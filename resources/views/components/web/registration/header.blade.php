@props(['competition'])

<div class="relative py-8 px-5 sm:py-10 sm:px-8 overflow-hidden" style="background: rgba(255, 255, 255, 0.02); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
    {{-- Decorative orbs --}}
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-[#00c6e6]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-[#00c6e6]/5 rounded-full blur-2xl"></div>

    <div class="relative z-10 flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
        <div class="bg-white/5 p-3 sm:p-4 rounded-2xl backdrop-blur-md border border-white/10 shadow-2xl flex-shrink-0">
            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-black/20 rounded-xl flex items-center justify-center overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ Storage::url($competition->competition_logo) }}" alt="{{ $competition->competition_name }}">
            </div>
        </div>
        <div class="text-center sm:text-left">
            <p style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.25em; text-transform: uppercase; color: #00c6e6; margin-bottom: 0.5rem;">
                Registration Form
            </p>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tight">{{ $competition->competition_name }}</h1>
            <p class="text-white/40 mt-2 text-xs sm:text-sm font-medium">Lengkapi formulir pendaftaran untuk bergabung dalam kompetisi</p>
        </div>
    </div>
</div>
