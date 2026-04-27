@props(['event'])

<div class="flex items-center md:hidden">
    <button id="hamburger-button"
        class="p-2 rounded-md text-quaternary hover:text-quinary focus:outline-none relative z-50">
        <span
            class="hamburger-line block w-6 h-0.5 bg-quaternary transition-all duration-300 mb-1.5 rounded-full"></span>
        <span
            class="hamburger-line block w-5 h-0.5 bg-quaternary transition-all duration-300 mb-1.5 ml-1 rounded-full"></span>
        <span class="hamburger-line block w-6 h-0.5 bg-quaternary transition-all duration-300 rounded-full"></span>
    </button>

    <!-- Mobile menu -->
    <div id="mobile-menu"
        class="hidden md:hidden mobile-menu-closed fixed top-0 left-0 right-0 bg-gradient-to-b from-secondary/95 to-secondary/90 backdrop-blur-2xl shadow-2xl h-screen z-40">
        <div class="container mx-auto px-6 py-16 flex flex-col h-full relative">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-10 -right-20 w-72 h-72 bg-quaternary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-quinary/10 rounded-full blur-3xl"></div>
            </div>

            <nav class="flex flex-col space-y-4 relative">
                <a id="nav-link" href="{{ request()->path() == '/' ? '#home' : '/' }}" data-section="home"
                    class="mobile-link group flex items-center p-5 rounded-2xl hover:bg-white/10 border border-quaternary/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-quaternary/20">
                    <x-icons.dashboard class="text-quaternary group-hover:text-quinary mr-4" />
                    <span class="text-quaternary group-hover:text-quinary text-lg font-medium">Home</span>
                    <x-icons.arrowRight
                        class="ml-auto text-2xl text-quaternary/50 group-hover:text-quinary group-hover:translate-x-1 transition-transform" />
                </a>

                @if($event)

                <a id="nav-link" href="/#about" data-section="about"
                    class="mobile-link group flex items-center p-5 rounded-2xl hover:bg-white/10 border border-quaternary/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-quaternary/20">
                    <x-icons.info class="text-quaternary group-hover:text-quinary mr-4" />
                    <span class="text-quaternary group-hover:text-quinary text-lg font-medium">About</span>
                    <x-icons.arrowRight
                        class="ml-auto text-2xl text-quaternary/50 group-hover:text-quinary group-hover:translate-x-1 transition-transform" />
                </a>

                <a id="nav-link" href="/#competition" data-section="competition"
                    class="mobile-link group flex items-center p-5 rounded-2xl hover:bg-white/10 border border-quaternary/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-quaternary/20">
                    <x-icons.trophy class="text-quaternary group-hover:text-quinary mr-4" />
                    <span class="text-quaternary group-hover:text-quinary text-lg font-medium">Competition</span>
                    <x-icons.arrowRight
                        class="ml-auto text-2xl text-quaternary/50 group-hover:text-quinary group-hover:translate-x-1 transition-transform" />
                </a>

                <a id="nav-link" href="/#announcement" data-section="announcement"
                    class="mobile-link group flex items-center p-5 rounded-2xl hover:bg-white/10 border border-quaternary/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-quaternary/20">
                    <x-icons.announcement class="text-quaternary group-hover:text-quinary mr-4" />
                    <span class="text-quaternary group-hover:text-quinary text-lg font-medium">Announcement</span>
                    <x-icons.arrowRight
                        class="ml-auto text-2xl text-quaternary/50 group-hover:text-quinary group-hover:translate-x-1 transition-transform" />
                </a>

                @endif

                <a id="nav-link" href="/#footer" data-section="footer"
                    class="mobile-link group flex items-center p-5 rounded-2xl hover:bg-white/10 border border-quaternary/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-quaternary/20">
                    <x-icons.team class="text-quaternary group-hover:text-quinary mr-4" />
                    <span class="text-quaternary group-hover:text-quinary text-lg font-medium">Contact</span>
                    <x-icons.arrowRight
                        class="ml-auto text-2xl text-quaternary/50 group-hover:text-quinary group-hover:translate-x-1 transition-transform" />
                </a>
            </nav>

            @if($event)

            <div class="mt-auto">
                <a href="{{ route('team.login') }}" data-section="competition" id="toLoginHamburger"
                    class="mobile-link w-full flex items-center justify-center gap-3 p-5 rounded-2xl bg-gradient-to-r from-quaternary to-quinary hover:from-quinary hover:to-quaternary transition-all duration-500 transform hover:-translate-y-1 hover:shadow-xl hover:shadow-quaternary/20">
                    <span class="text-secondary font-bold text-lg">Login</span>
                </a>
            </div>

            @endif

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileLinks = document.querySelectorAll('.mobile-link');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerLines = document.querySelectorAll('.hamburger-line');

            function closeMobileMenu() {
                mobileMenu.classList.remove('mobile-menu-open');
                mobileMenu.classList.add('mobile-menu-closed');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);

                // Reset hamburger icon
                hamburgerLines.forEach(line => {
                    line.classList.remove('rotate-45', 'translate-y-2', 'opacity-0', 'translate-x-3',
                        '-rotate-45', '-translate-y-2');
                });
            }

            mobileLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const href = link.getAttribute('href');
                    closeMobileMenu();

                    // Smooth scroll to section after menu closes
                    setTimeout(() => {
                        const element = document.querySelector(href);
                        if (element) {
                            element.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }, 300);
                });
            });
        });
    </script>
</div>
