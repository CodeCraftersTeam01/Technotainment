<div id="main-navbar"
    class="fixed top-0 left-0 right-0 w-full z-50 transition-all duration-700 py-2 navbar-glass">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex items-center">
                @if($event)
                    <div class="flex items-center group">
                        <a href="/">
                            <img class="h-10 w-10 object-cover rounded-md object-center" src="{{ Storage::url($event->event_logo) }}" alt="{{ $event->event_name }}">
                        </a>
                    </div>
                @endif
                <nav class="hidden md:ml-8 md:flex md:space-x-6 lg:space-x-10">
                    <a id="nav-link" href="{{ request()->path() == '/' ? '#home' : '/' }}" data-section="home"
                        class="nav-link flex items-center px-2 py-1 text-sm font-medium text-quaternary hover:text-quinary transition-all duration-300 relative group overflow-hidden">
                        <span>Home</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-quaternary transform translate-y-1 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300"></span>
                    </a>
                    @if ($event)
                        <a id="nav-link" href="/#about" data-section="about"
                            class="nav-link flex items-center px-2 py-1 text-sm font-medium text-quaternary hover:text-quinary transition-all duration-300 relative group overflow-hidden">
                            <span>About</span>
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-quaternary transform translate-y-1 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300"></span>
                        </a>
                        <a id="nav-link" href="/#competition" data-section="competition"
                            class="nav-link flex items-center px-2 py-1 text-sm font-medium text-quaternary hover:text-quinary transition-all duration-300 relative group overflow-hidden">
                            <span>Competition</span>
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-quaternary transform translate-y-1 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300"></span>
                        </a>
                        <a id="nav-link" href="/#announcement" data-section="announcement"
                            class="nav-link flex items-center px-2 py-1 text-sm font-medium text-quaternary hover:text-quinary transition-all duration-300 relative group overflow-hidden">
                            <span>Announcement</span>
                            <span
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-quaternary transform translate-y-1 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300"></span>
                        </a>
                    @endif
                    <a id="nav-link" href="/#footer" data-section="footer"
                        class="nav-link flex items-center px-2 py-1 text-sm font-medium text-quaternary hover:text-quinary transition-all duration-300 relative group overflow-hidden">
                        <span>Contact</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-quaternary transform translate-y-1 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300"></span>
                    </a>
                </nav>
            </div>
            <div class="hidden md:flex items-center">
                @if ($event)
                    <a href="{{ route('team.login') }}" id="toLogin"
                        class="nav-link relative inline-flex items-center px-6 py-2.5 text-sm font-bold rounded-full shadow-md overflow-hidden group">
                        <span
                            class="absolute inset-0 w-full h-full bg-gradient-to-r from-quaternary to-quaternary/80"></span>
                        <span
                            class="absolute bottom-0 left-0 h-full w-0 bg-gradient-to-r from-quinary to-quinary/80 transition-all duration-300 group-hover:w-full"></span>
                        <span
                            class="relative text-secondary group-hover:text-secondary transition-all duration-300">Login</span>
                    </a>
                @endif
            </div>

            <!-- Hamburger toggle -->
            <x-web.section.hamburger :event="$event" />
        </div>
    </div>

    <script>
        const navLink = document.querySelectorAll('#nav-link');
        navLink.forEach(link => {
            link.addEventListener('click', (e) => {
                document.location.href = link.href;
            })
        });
        document.querySelectorAll('.nav-link').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const sectionId = this.getAttribute('data-section');
                const element = document.getElementById(sectionId);

                if (this.classList.contains('mobile-link')) {
                    document.getElementById('mobile-menu').classList.remove('mobile-menu-open');
                    document.getElementById('mobile-menu').classList.add('mobile-menu-closed');
                    setTimeout(() => {
                        document.getElementById('mobile-menu').classList.add('hidden');
                    }, 300);
                    resetHamburgerIcon();
                }

                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        const hamburgerButton = document.getElementById('hamburger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerLines = document.querySelectorAll('.hamburger-line');

        const toLogin = document.getElementById('toLogin');
        if(toLogin) {
            toLogin.addEventListener('click', () => {
                document.location.href = "{{ route('team.login') }}";
            })
        }

        const toLoginHamburger = document.getElementById('toLoginHamburger');
        if(toLoginHamburger) {
            toLoginHamburger.addEventListener('click', () => {
                document.location.href = "{{ route('team.login') }}";
            })
        }

        hamburgerButton.addEventListener('click', () => {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenu.classList.remove('mobile-menu-closed');
                    mobileMenu.classList.add('mobile-menu-open');
                }, 10);
                hamburgerLines[0].classList.add('rotate-45', 'translate-y-2');
                hamburgerLines[1].classList.add('opacity-0', 'translate-x-3');
                hamburgerLines[2].classList.add('-rotate-45', '-translate-y-2');
            } else {
                mobileMenu.classList.remove('mobile-menu-open');
                mobileMenu.classList.add('mobile-menu-closed');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
                resetHamburgerIcon();
            }
        });

        function resetHamburgerIcon() {
            hamburgerLines[0].classList.remove('rotate-45', 'translate-y-2');
            hamburgerLines[1].classList.remove('opacity-0', 'translate-x-3');
            hamburgerLines[2].classList.remove('-rotate-45', '-translate-y-2');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                mobileMenu.classList.add('hidden', 'mobile-menu-closed');
                mobileMenu.classList.remove('mobile-menu-open');
                resetHamburgerIcon();
            }
        });

        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('main-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled', 'py-1');
                navbar.classList.remove('py-2', 'navbar-glass');
            } else {
                navbar.classList.remove('navbar-scrolled', 'py-1');
                navbar.classList.add('py-2', 'navbar-glass');
            }
        });
    </script>
</div>
