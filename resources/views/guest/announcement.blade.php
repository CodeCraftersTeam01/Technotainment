{{-- {{ dd($announcement) }} --}}

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

        .bg-primary { background-color: var(--color-primary); }
        .bg-secondary { background-color: var(--color-secondary); }
        .bg-tertiary { background-color: var(--color-tertiary); }
        .bg-quaternary { background-color: var(--color-quaternary); }
        .bg-quinary { background-color: var(--color-quinary); }

        .text-primary { color: var(--color-primary); }
        .text-secondary { color: var(--color-secondary); }
        .text-tertiary { color: var(--color-tertiary); }
        .text-quaternary { color: var(--color-quaternary); }
        .text-quinary { color: var(--color-quinary); }

        .border-primary { border-color: var(--color-primary); }
        .border-secondary { border-color: var(--color-secondary); }
        .border-tertiary { border-color: var(--color-tertiary); }
        .border-quaternary { border-color: var(--color-quaternary); }

        .from-primary { --tw-gradient-from: var(--color-primary); }
        .to-secondary { --tw-gradient-to: var(--color-secondary); }
        .to-tertiary { --tw-gradient-to: var(--color-tertiary); }

        /* Custom prose styles to match your color scheme */
        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            color: var(--color-quaternary);
        }

        .prose a {
            color: var(--color-quaternary);
        }

        .prose strong {
            color: var(--color-quaternary);
        }

        .prose blockquote {
            border-left-color: var(--color-tertiary);
            color: var(--color-quaternary);
        }

        .prose code {
            color: var(--color-secondary);
            background-color: var(--color-quinary);
            padding: 0.2em 0.4em;
            border-radius: 0.25rem;
        }

        .prose pre {
            background-color: var(--color-quaternary);
        }

        .prose ul > li::before {
            background-color: var(--color-tertiary);
        }

        .prose ol > li::before {
            color: var(--color-tertiary);
        }
    </style>

    <x-web.section.navbar :event="$announcement->event" />

    <div class="min-h-screen bg-tertiary">

        <!-- Header with announcement title -->
        <div class="relative bg-gradient-to-br from-primary to-secondary overflow-hidden mb-10">
            <!-- Decorative elements -->
            <div class="absolute inset-0 overflow-hidden opacity-20">
                <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-quaternary"></div>
                <div class="absolute top-20 right-10 w-40 h-40 rounded-full bg-tertiary"></div>
                <div class="absolute bottom-10 left-1/3 w-20 h-20 rounded-full bg-quaternary"></div>

                <!-- Grid pattern -->
                <div class="absolute inset-0" style="background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px;"></div>
            </div>

            <div class="px-4 py-12 relative z-10">
                <div class="max-w-4xl mx-auto">
                    <!-- Event badge if available -->
                    @if(isset($announcement->event) && $announcement->event)
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-quaternary bg-opacity-20 text-white mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $announcement->event->event_name }}
                        </div>
                    @endif

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        {{ $announcement->announcement_title }}
                    </h1>

                    {{-- <div class="prose">
                        <x-markdown>
                            {!! $announcement->announcement_description !!}
                        </x-markdown>
                    </div> --}}

                    <!-- Date and metadata -->
                    <div class="mt-4 flex items-center text-quaternary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ isset($announcement->created_at) ? $announcement->created_at->format('F d, Y') : date('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="px-4 py-8 relative z-10 bg-tertiary">
            <div class="max-w-4xl mx-auto">
                <!-- Content card -->
                <div class="bg-secondary rounded-xl shadow-lg p-6 md:p-10 mb-10">
                        <!-- Featured image -->
                    @if($announcement->announcement_photo)
                        <div class="mb-10 mt-10 rounded-xl overflow-hidden shadow-xl">
                            <img class="w-full h-auto object-cover" src="{{ Storage::url($announcement->announcement_photo) }}" alt="{{ $announcement->announcements_title }}">
                        </div>
                    @endif
                    <!-- Content section -->
                    <div class="prose prose-lg max-w-none">
                        <x-markdown>
                            {!! $announcement->announcement_description !!}
                        </x-markdown>
                    </div>
                </div>
            </div>
        </div>

        <x-web.section.footer :event="$announcement->event" />
    </div>
</x-layout>
