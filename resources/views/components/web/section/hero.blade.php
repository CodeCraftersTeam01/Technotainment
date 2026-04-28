@props(['mediaPartners', 'event', 'sponsors'])

<div id="home" class="relative min-h-screen bg-gradient-to-br from-[#191e2b] via-[#253045] to-[#191e2b] overflow-hidden">
    <x-web.section.background />
    
    <!-- Hero Content -->
    <div class="relative container mx-auto px-4 pt-32 pb-20 flex flex-col items-center justify-center min-h-screen text-center z-10">
        <!-- Badge -->
        <div class="reveal mb-6 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md inline-flex items-center gap-2">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-tertiary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-tertiary"></span>
            </span>
            <span class="text-quinary text-sm font-medium tracking-wider uppercase">Official Event 2025</span>
        </div>

        <div class="mb-10 max-w-5xl">
            <h2 class="reveal text-tertiary font-bold text-lg md:text-xl mb-4 tracking-[0.2em] uppercase italic">UKMFT-ITC Present</h2>
            <h1 class="reveal text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-black text-white mb-6 tracking-tighter leading-none">
                {{ $event ? $event->event_name : 'TECHNO' }} <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-tertiary via-quaternary to-tertiary animate-gradient-x italic">
                    {{ $event ? $event->event_year : '2025' }}
                </span>
            </h1>
            <p class="reveal text-quinary/80 text-lg md:text-2xl max-w-3xl mx-auto leading-relaxed">
                {{ $event ? $event->event_theme : 'Innovating the Future Through Technology and Entertainment' }}
            </p>
        </div>

        <!-- Buttons -->
        <div class="reveal flex flex-wrap justify-center gap-4 mb-20">
            <a href="#competition" class="px-8 py-4 bg-gradient-to-r from-tertiary to-quaternary text-secondary font-bold rounded-full hover:scale-105 transition-all duration-300 shadow-lg shadow-tertiary/25 flex items-center gap-2 group">
                Register Now
                <x-icons.arrowRight class="group-hover:translate-x-1 transition-transform" />
            </a>
            <a href="#about" class="px-8 py-4 bg-white/5 border border-white/10 backdrop-blur-md text-white font-bold rounded-full hover:bg-white/10 transition-all duration-300">
                Learn More
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl reveal">
            <div class="group bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-tertiary/30 transition-all duration-500 hover:-translate-y-2">
                <div class="w-12 h-12 bg-tertiary/20 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <x-icons.date class="text-tertiary" />
                </div>
                <h3 class="text-white font-bold text-lg mb-1">Event Date</h3>
                <p class="text-quinary/60 text-sm italic">{{ $event ? $event->event_year : 'Coming Soon' }}</p>
            </div>
            
            <div class="group bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-tertiary/30 transition-all duration-500 hover:-translate-y-2">
                <div class="w-12 h-12 bg-quaternary/20 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <x-icons.location class="text-quaternary" />
                </div>
                <h3 class="text-white font-bold text-lg mb-1">Location</h3>
                <p class="text-quinary/60 text-sm italic">Universitas Trunojoyo Madura</p>
            </div>

            <div class="group bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-tertiary/30 transition-all duration-500 hover:-translate-y-2">
                <div class="w-12 h-12 bg-tertiary/20 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <x-icons.trophy class="text-tertiary" />
                </div>
                <h3 class="text-white font-bold text-lg mb-1">Total Prizes</h3>
                <p class="text-quinary/60 text-sm italic">Millions of Rupiah</p>
            </div>
        </div>
    </div>

    <!-- Background Ornaments -->
    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-tertiary/20 rounded-full blur-[120px] animate-pulse"></div>
    <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-quaternary/20 rounded-full blur-[120px] animate-pulse delay-700"></div>
</div>
