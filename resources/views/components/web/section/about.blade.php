@props(['event'])

<div id="about" class="relative py-20 bg-gradient-to-b from-secondary to-primary overflow-x-hidden">
    <!-- Gradient Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="absolute top-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-tertiary/10 rounded-full filter blur-3xl transform translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 md:w-96 h-64 md:h-96 bg-quaternary/10 rounded-full filter blur-3xl transform -translate-x-1/2 translate-y-1/2">
        </div>
    </div>

    <div class="relative container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div class="relative order-2 md:order-1">
                <div class="absolute w-full h-full">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-tertiary/10 rounded-full animate-blob"></div>
                    <div
                        class="absolute bottom-0 left-0 w-32 h-32 bg-quaternary/10 rounded-full animate-blob animation-delay-2000">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 w-32 h-32 bg-tertiary/10 rounded-full animate-blob animation-delay-4000">
                    </div>
                </div>
                <div class="relative flex justify-center items-center">
                    <div
                        class="relative z-20 transform hover:scale-110 hover:-rotate-6 transition-all duration-300 -mr-8">
                        <img src="{{ asset('images/maskot1.png') }}" alt="Maskot UKMFT-ITC" class="w-48 md:w-64">
                    </div>
                    <div
                        class="relative z-10 transform hover:scale-110 hover:rotate-6 transition-all duration-300 -ml-8">
                        <img src="{{ asset('images/maskot2.png') }}" alt="Maskot UKMFT-ITC" class="w-48 md:w-64">
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2">
                <div class="text-center md:text-left relative">
                    <span
                        class="absolute top-0 left-1/2 md:left-0 -translate-x-1/2 md:translate-x-0 -translate-y-1/2 text-6xl md:text-8xl text-tertiary/5 select-none font-black animate-pulse">ABOUT</span>
                    <h2 class="text-tertiary font-bold text-4xl md:text-5xl mb-4 relative">
                        About {{ $event->event_name }}
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-tertiary to-quaternary mx-auto md:mx-0 mb-6"></div>
                    <p class="text-quinary text-lg leading-relaxed text-justify">
                        {{ $event->event_about }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
