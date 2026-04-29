@props(['mediaPartners', 'event', 'sponsors'])
<div class="relative bg-black overflow-hidden py-16">
    <x-web.section.background />
    <div class="w-full max-w-5xl my-16 mx-auto relative">
        @if($event)
        <!-- Sponsorship Section -->
        <div class="mb-16 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-quaternary/20 to-tertiary/20 blur-3xl -z-10 animate-pulse">
            </div>
            <h3 class="text-2xl font-bold text-white mb-8 block text-center">
                <span class="relative">
                    <span class="absolute -inset-1 bg-gradient-to-r from-tertiary to-quaternary blur-lg opacity-50"></span>
                    <span class="relative">Sponsored By</span>
                </span>
            </h3>
            @if($sponsors->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach ($sponsors as $sponsor)
                        <div class="group">
                            <div class="relative h-40 [perspective:2000px] cursor-pointer">
                                <div
                                    class="absolute inset-0 transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-lg rounded-xl p-6 [backface-visibility:hidden]">
                                        <img src="{{ Storage::url($sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}"
                                            class="w-full h-full object-contain" loading="lazy">
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-tertiary/20 to-quaternary/20 backdrop-blur-xl rounded-xl p-6 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                                        <div class="flex items-center justify-center h-full">
                                            <p class="text-white">{{ $sponsor->sponsor_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-quinary mt-2 font-semibold text-center">{{ $sponsor->sponsor_name }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <h1 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary text-center">Open Sponsors</h1>
            @endif
        </div>

        <!-- Media Partners -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-tertiary/10 to-quaternary/10 blur-3xl -z-10"></div>
            <h3 class="text-2xl font-bold text-white mb-12 text-center">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary">
                    {{ '<Media Partners />' }}
                </span>
            </h3>
            <div class="flex flex-wrap justify-center gap-x-4 gap-y-20 md:gap-y-20">
                @forelse ($mediaPartners as $mediaPartner)
                    <div class="group" title="{{ $mediaPartner->media_partner_name }}">
                        <div class="w-[150px] h-[150px] relative [perspective:1000px]">
                            <div
                                class="w-full h-full relative [clip-path:polygon(50%_0%,100%_25%,100%_75%,50%_100%,0%_75%,0%_25%)] bg-white/5 backdrop-blur-md p-6 group-hover:bg-white/10 transition-all duration-300 hover:[transform:translateZ(20px)] reveal">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <img src="{{ Storage::url($mediaPartner->media_partner_logo) }}" alt="{{ $mediaPartner->media_partner_name }}"
                                        class="h-20 w-auto mx-auto group-hover:scale-110 transition-all duration-300 aspect-square object-cover" loading="lazy">
                                </div>
                            </div>
                            <p class="text-quinary font-semibold mt-2 text-center">{{ $mediaPartner->media_partner_name }}</p>
                        </div>
                    </div>
                @empty
                    <h1 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary">Open Media Partner</h1>
                @endforelse
            </div>
        </div>
        @endif
    </div>
</div>