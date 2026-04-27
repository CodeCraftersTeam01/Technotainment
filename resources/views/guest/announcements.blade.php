<x-layout>
    <!-- Add Tailwind colors to match your scheme -->
    <style>
        :root {
            --color-primary: #072d44;
            --color-secondary: #064469;
            --color-tertiary: #5790ab;
            --color-quaternary: #9ccddb;
            --color-quinary: #d0d7e1;
        }

        .bg-primary {
            background-color: var(--color-primary);
        }

        .bg-secondary {
            background-color: var(--color-secondary);
        }

        .bg-tertiary {
            background-color: var(--color-tertiary);
        }

        .bg-quaternary {
            background-color: var(--color-quaternary);
        }

        .bg-quinary {
            background-color: var(--color-quinary);
        }

        .text-primary {
            color: var(--color-primary);
        }

        .text-secondary {
            color: var(--color-secondary);
        }

        .text-tertiary {
            color: var(--color-tertiary);
        }

        .text-quaternary {
            color: var(--color-quaternary);
        }

        .text-quinary {
            color: var(--color-quinary);
        }

        .border-primary {
            border-color: var(--color-primary);
        }

        .border-secondary {
            border-color: var(--color-secondary);
        }

        .border-tertiary {
            border-color: var(--color-tertiary);
        }

        .border-quaternary {
            border-color: var(--color-quaternary);
        }

        .border-quinary {
            border-color: var(--color-quinary);
        }

        .from-primary {
            --tw-gradient-from: var(--color-primary);
        }

        .to-secondary {
            --tw-gradient-to: var(--color-secondary);
        }

        .to-tertiary {
            --tw-gradient-to: var(--color-tertiary);
        }

        /* Custom animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Staggered animation delay */
        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }
    </style>

    <x-web.section.navbar :event="$event" />

    <div class="min-h-screen bg-tertiary">
        <!-- Header with geometric decoration -->
        <div class="relative bg-gradient-to-br from-primary to-secondary overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden opacity-20">
                <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-quaternary"></div>
                <div class="absolute top-20 right-10 w-40 h-40 rounded-full bg-tertiary"></div>
                <div class="absolute bottom-10 left-1/3 w-20 h-20 rounded-full bg-quaternary"></div>
                <div class="absolute -bottom-10 right-1/4 w-32 h-32 rounded-full bg-tertiary"></div>

                <!-- Grid pattern -->
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>

            <div class="container mx-auto px-4 py-16 relative z-10">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center mb-4">
                        <span
                            class="w-12 h-12 flex items-center justify-center rounded-lg bg-quaternary text-primary mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </span>
                        <h1 class="text-4xl md:text-5xl font-bold text-white">Announcements</h1>
                    </div>
                    <p class="text-quaternary text-lg max-w-2xl mx-auto">
                        Tetap update dan ikuti perkembangan terbaru dari event kami.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="container mx-auto px-4 py-8 relative z-10">

            <!-- Section title with decorative elements -->
            <div class="flex items-center mb-10">
                <div class="h-px bg-gradient-to-r from-transparent via-tertiary to-transparent flex-grow"></div>
                <div class="mx-4 flex items-center">
                    <h2 class="text-2xl font-bold text-white mx-3">Latest Updates</h2>
                </div>
                <div class="h-px bg-gradient-to-r from-tertiary via-tertiary to-transparent flex-grow"></div>
            </div>

            <!-- Announcements grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $index => $announcement)
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 animate-float delay-{{ ($index % 5) * 100 }}">
                        <!-- Decorative top bar -->
                        <div class="h-2 bg-gradient-to-r from-tertiary to-quaternary"></div>

                        <div class="h-48 overflow-hidden flex text-center items-center">
                            @if ($announcement->announcement_photo)
                            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                src="{{ Storage::url($announcement->announcement_photo) }}"
                                alt="{{ $announcement->announcements_title }}">
                            @else 
                                <p class="w-full text center">Tidak ada gambar</p>
                            @endif
                        </div>

                        <div class="p-6">
                            @if (isset($announcement->event) && $announcement->event)
                                <div
                                    class="inline-flex items-center rounded-full text-xs font-medium bg-tertiary bg-opacity-20 text-white px-2 py-1 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $announcement->event->event_name }}
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-secondary mb-3 line-clamp-1">
                                {{ $announcement->announcement_title }}</h3>

                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <a href="/show-announcements/{{ $announcement->announcement_id }}"
                                    class="text-primary font-medium flex items-center hover:text-tertiary transition-colors duration-200">
                                    Read More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <div class="flex items-center mb-2">
                                    <span class="text-sm text-gray-500">
                                        {{ $announcement->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl shadow p-10 text-center">
                        <div class="w-20 h-20 bg-quinary rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-secondary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary mb-2">No Announcements Available</h3>
                        <p class="text-gray-600 max-w-md mx-auto">There are currently no announcements to display.
                            Please check back later for updates.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <x-web.section.footer :event="$event" />

    <!-- Add Tailwind's line-clamp plugin for text truncation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add staggered entrance animation
            const cards = document.querySelectorAll('.grid > div');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</x-layout>
