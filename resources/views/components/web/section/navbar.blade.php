<div id="main-navbar"
    class="navbar-glass fixed top-0 left-0 right-0 w-full z-50 py-4">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-10">

            {{-- Logo --}}
            <div class="flex items-center gap-3 flex-shrink-0">
                @if($event)
                    <a href="/" class="flex items-center gap-3 group">
                        <img class="h-7 w-7 object-cover rounded-lg" src="{{ Storage::url($event->event_logo) }}" alt="{{ $event->event_name }}" loading="lazy">
                        <span class="hidden sm:block text-sm font-semibold text-white/90 tracking-tight group-hover:text-white transition-colors duration-300">{{ $event->event_name }}</span>
                    </a>
                @endif
            </div>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-1">
                @php
                    $links = [
                        ['href' => (request()->path() == '/' ? '#home' : '/'), 'section' => 'home', 'label' => 'Home'],
                    ];
                    if ($event) {
                        $links[] = ['href' => '/#about',        'section' => 'about',        'label' => 'About'];
                        $links[] = ['href' => '/#competition',  'section' => 'competition',  'label' => 'Competition'];
                        $links[] = ['href' => '/#announcement', 'section' => 'announcement', 'label' => 'Announcement'];
                    }
                    $links[] = ['href' => '/#footer', 'section' => 'footer', 'label' => 'Contact'];
                @endphp

                @foreach($links as $link)
                    <a href="{{ $link['href'] }}" data-section="{{ $link['section'] }}"
                        class="nav-link px-4 py-2 text-[13px] font-medium text-white/60 hover:text-white rounded-full hover:bg-white/6 transition-all duration-300 tracking-tight">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- CTA --}}
            <div class="hidden md:flex items-center gap-3">


                @if ($event)
                    <a href="{{ route('team.login') }}" id="toLogin" class="btn-primary text-[13px] !py-2 !px-5">
                        Sign In
                    </a>
                @endif
            </div>

            {{-- Mobile Actions --}}
            <div class="flex items-center gap-3 md:hidden">


                {{-- Hamburger --}}
                <x-web.section.hamburger :event="$event" />
            </div>
        </div>
    </div>

    <script>
        // Smooth Liquid Glass Navbar on scroll
        (function() {
            const navbar = document.getElementById('main-navbar');

            function handleScroll() {
                if (window.scrollY > 60) {
                    navbar.classList.add('navbar-scrolled');
                    navbar.classList.remove('py-4');
                    navbar.classList.add('py-2');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                    navbar.classList.remove('py-2');
                    navbar.classList.add('py-4');
                }
            }

            window.addEventListener('scroll', handleScroll, { passive: true });

            document.querySelectorAll('.nav-link').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('data-section');
                    const href = this.getAttribute('href');

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('mobile-menu-open');
                        mobileMenu.classList.add('mobile-menu-closed');
                        document.body.classList.remove('mobile-menu-active');
                        setTimeout(() => mobileMenu.classList.add('hidden'), 400);
                        resetHamburger();
                    }

                    const element = document.getElementById(sectionId);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth' });
                    } else if (href) {
                        document.location.href = href;
                    }
                });
            });

            // Hamburger controls
            const hamburgerButton = document.getElementById('hamburger-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerLines = document.querySelectorAll('.hamburger-line');

            function resetHamburger() {
                hamburgerLines.forEach(l => l.classList.remove('rotate-45', 'translate-y-2', 'opacity-0', 'translate-x-3', '-rotate-45', '-translate-y-2'));
            }

            if (hamburgerButton) {
                hamburgerButton.addEventListener('click', () => {
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                        setTimeout(() => {
                            mobileMenu.classList.remove('mobile-menu-closed');
                            mobileMenu.classList.add('mobile-menu-open');
                            document.body.classList.add('mobile-menu-active');
                        }, 10);
                        hamburgerLines[0].classList.add('rotate-45', 'translate-y-2');
                        hamburgerLines[1].classList.add('opacity-0', 'translate-x-3');
                        hamburgerLines[2].classList.add('-rotate-45', '-translate-y-2');
                    } else {
                        mobileMenu.classList.remove('mobile-menu-open');
                        mobileMenu.classList.add('mobile-menu-closed');
                        document.body.classList.remove('mobile-menu-active');
                        setTimeout(() => mobileMenu.classList.add('hidden'), 400);
                        resetHamburger();
                    }
                });
            }

            const toLogin = document.getElementById('toLogin');
            if (toLogin) {
                toLogin.addEventListener('click', () => {
                    document.location.href = "{{ route('team.login') }}";
                });
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768 && mobileMenu) {
                    mobileMenu.classList.add('hidden', 'mobile-menu-closed');
                    mobileMenu.classList.remove('mobile-menu-open');
                    document.body.classList.remove('mobile-menu-active');
                    resetHamburger();
                }
            });
        })();
    </script>
</div>
