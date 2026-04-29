@props(['announcement'])
<div id="announcement" class="relative pb-24 pt-16 bg-[#071225]">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 relative pt-4 reveal">
            <p class="text-label text-[#00c6e6]/60 mb-3">Stay Updated</p>
            <h2 class="text-headline text-white mb-4">Latest Updates</h2>
            <div class="w-16 h-px bg-gradient-to-r from-transparent via-[#00c6e6] to-transparent mx-auto"></div>
        </div>

        @if ($announcement->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($announcement as $anc)
                    <div
                        class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-white/[0.05] to-white/[0.02] backdrop-blur-lg border border-white/10 hover:border-white/20 transition-all duration-500 hover:shadow-2xl hover:shadow-quaternary/20 reveal">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-quaternary/10 to-tertiary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative p-6">
                            <div class="aspect-[16/9] mb-6 flex text-center items-center overflow-hidden rounded-2xl">
                                @if ($anc->announcement_photo)
                                    <img src="{{ Storage::url($anc->announcement_photo) }}"
                                        alt="{{ $anc->announcement_title }}" onclick="openModal(this.src)"
                                        class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110 cursor-pointer" loading="lazy">
                                @else
                                    <p class="text-quaternary w-full">No Image</p>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <h3
                                    class="text-xl line-clamp-1 font-bold text-quaternary group-hover:text-quinary transition-colors duration-300">
                                    {{ $anc->announcement_title }}
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="/show-announcements/{{ $anc->announcement_id }}"
                                        class="text-quinary/80 font-medium flex items-center hover:text-tertiary transition-colors duration-200">
                                        Read More
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    <time class="text-sm text-quinary/80 font-medium">
                                        {{ $anc->created_at->format('d M Y') }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-10">
                <a href="/show-announcements"
                    class="inline-flex items-center px-12 py-4 bg-gradient-to-r from-tertiary to-quaternary rounded-full text-xl font-bold hover:opacity-90 transition-all duration-300 transform hover:scale-105 hover:shadow-xl group">
                    Lihat Semua
                    <x-icons.arrowRight width="20" height="20"
                        class="ml-2 group-hover:translate-x-1 transition-transform duration-300" />
                </a>
            </div>
        @else
            <div class="text-center p-8">
                <h1
                    class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-tertiary to-quaternary animate-pulse">
                    Tidak ada pengumuman
                </h1>
            </div>
        @endif
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
        <div class="relative max-w-7xl mx-auto p-4 w-full">
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-white/80 hover:text-white z-50 bg-black/20 rounded-full p-2 backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div>
                <img id="modalImage" class="max-h-[80vh] w-auto mx-auto object-contain rounded-lg shadow-2xl">
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');

        function openModal(imgSrc) {
            modal.style.display = 'flex';
            modalImg.src = imgSrc;
            document.body.style.overflow = 'hidden';

            modal.style.opacity = '0';
            modal.offsetHeight;
            modal.style.transition = 'opacity 0.3s ease-out';
            modal.style.opacity = '1';
        }

        function closeModal() {
            modal.style.opacity = '0';
            document.body.style.overflow = '';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        // Tutup modal saat klik di luar gambar
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });
    </script>
</div>
