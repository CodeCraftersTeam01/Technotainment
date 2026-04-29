@props(['event'])

<div class="flex items-center md:hidden">
    <button id="hamburger-button"
        class="p-2 rounded-xl text-white/60 hover:text-white hover:bg-white/5 focus:outline-none transition-all duration-300 relative z-50">
        <span class="hamburger-line block w-5 h-px bg-current transition-all duration-300 mb-1.5 rounded-full"></span>
        <span class="hamburger-line block w-4 h-px bg-current transition-all duration-300 mb-1.5 ml-0.5 rounded-full"></span>
        <span class="hamburger-line block w-5 h-px bg-current transition-all duration-300 rounded-full"></span>
    </button>

    {{-- Mobile menu --}}
    <div id="mobile-menu"
        class="hidden md:hidden mobile-menu-closed fixed top-0 left-0 right-0 bg-black/95 backdrop-blur-3xl h-screen z-40 border-r border-white/5">
        <div class="container mx-auto px-6 py-20 flex flex-col h-full relative">

            {{-- Ambient glow --}}
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#00c6e6]/30 to-transparent"></div>

            <nav class="flex flex-col gap-1 mt-6">
                <a href="{{ request()->path() == '/' ? '#home' : '/' }}" data-section="home"
                    class="nav-link mobile-link group flex items-center justify-between p-4 rounded-2xl hover:bg-white/4 transition-all duration-300">
                    <span class="text-white/70 group-hover:text-white text-base font-medium tracking-tight transition-colors">Home</span>
                    <svg class="w-4 h-4 text-white/20 group-hover:text-[#00c6e6] group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                @if($event)
                <a href="/#about" data-section="about"
                    class="nav-link mobile-link group flex items-center justify-between p-4 rounded-2xl hover:bg-white/4 transition-all duration-300">
                    <span class="text-white/70 group-hover:text-white text-base font-medium tracking-tight transition-colors">About</span>
                    <svg class="w-4 h-4 text-white/20 group-hover:text-[#00c6e6] group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="/#competition" data-section="competition"
                    class="nav-link mobile-link group flex items-center justify-between p-4 rounded-2xl hover:bg-white/4 transition-all duration-300">
                    <span class="text-white/70 group-hover:text-white text-base font-medium tracking-tight transition-colors">Competition</span>
                    <svg class="w-4 h-4 text-white/20 group-hover:text-[#00c6e6] group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="/#announcement" data-section="announcement"
                    class="nav-link mobile-link group flex items-center justify-between p-4 rounded-2xl hover:bg-white/4 transition-all duration-300">
                    <span class="text-white/70 group-hover:text-white text-base font-medium tracking-tight transition-colors">Announcement</span>
                    <svg class="w-4 h-4 text-white/20 group-hover:text-[#00c6e6] group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif

                <a href="/#footer" data-section="footer"
                    class="nav-link mobile-link group flex items-center justify-between p-4 rounded-2xl hover:bg-white/4 transition-all duration-300">
                    <span class="text-white/70 group-hover:text-white text-base font-medium tracking-tight transition-colors">Contact</span>
                    <svg class="w-4 h-4 text-white/20 group-hover:text-[#00c6e6] group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </nav>

            @if($event)
            <div class="mt-auto pb-6">
                <div class="gradient-line opacity-20 mb-6"></div>
                <a href="{{ route('team.login') }}" id="toLoginHamburger"
                    class="btn-primary w-full justify-center text-sm">
                    Sign In to Dashboard
                </a>
            </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileLinks = document.querySelectorAll('.mobile-link');
            const mobileMenu  = document.getElementById('mobile-menu');
            const hamburgerLines = document.querySelectorAll('.hamburger-line');

            function closeMobileMenu() {
                mobileMenu.classList.remove('mobile-menu-open');
                mobileMenu.classList.add('mobile-menu-closed');
                setTimeout(() => mobileMenu.classList.add('hidden'), 400);
                hamburgerLines.forEach(l => l.classList.remove('rotate-45', 'translate-y-2', 'opacity-0', 'translate-x-3', '-rotate-45', '-translate-y-2'));
            }

            mobileLinks.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    const href = link.getAttribute('href');
                    closeMobileMenu();
                    setTimeout(() => {
                        const el = document.querySelector(href);
                        if (el) el.scrollIntoView({ behavior: 'smooth' });
                    }, 400);
                });
            });

            const toLoginHamburger = document.getElementById('toLoginHamburger');
            if (toLoginHamburger) {
                toLoginHamburger.addEventListener('click', () => {
                    document.location.href = "{{ route('team.login') }}";
                });
            }
        });
    </script>
</div>
