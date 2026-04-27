<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-primary flex items-center to-blue-secondary md:px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 relative overflow-hidden">
                <!-- Background Effects -->
                <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-blue-quaternary/20 rounded-full blur-3xl"></div>
                <div class="absolute -top-16 -right-16 w-48 h-48 bg-blue-quinary/20 rounded-full blur-3xl"></div>

                <!-- Heading Section -->
                <div class="text-center">
                    <h1 class="text-5xl font-extrabold">
                        🎉
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-quaternary to-blue-quinary">
                            Registrasi Berhasil!
                        </span>
                    </h1>
                    <p class="mt-4 text-lg text-blue-quaternary">
                        Terima kasih telah bergabung! Pendaftaran Anda telah berhasil dikirim.
                    </p>
                </div>

                <!-- Mascot Images with Hover Effect -->
                <div class="relative mt-10 flex justify-center items-center gap-4">
                    <img src="{{ asset('images/maskot1.png') }}" alt="Maskot UKMFT-ITC"
                        class="w-40 md:w-56 hover:scale-110 hover:-rotate-6 transition-all duration-300 z-10">
                    <img src="{{ asset('images/maskot2.png') }}" alt="Maskot UKMFT-ITC"
                        class="w-40 md:w-56 hover:scale-110 hover:rotate-6 transition-all duration-300 z-20">
                </div>

                <!-- Token Display with Copy Button -->
                <div class="mt-8 text-center">
                    <p class="text-lg text-blue-quaternary mb-2">Berikut token registrasi Anda:</p>
                    <div class="inline-flex items-center gap-2">
                        <div id="tokenText"
                            class="px-4 py-2 bg-white/10 text-blue-quinary font-mono rounded-lg shadow-inner border border-blue-quinary text-sm select-all">
                            {{ $token }}
                        </div>
                        <button onclick="copyToken()"
                            class="px-3 py-2 text-sm bg-blue-tertiary text-white rounded hover:bg-blue-secondary transition">
                            Salin
                        </button>
                    </div>
                    <p id="copiedText" class="text-green-400 text-sm mt-2 hidden">Token berhasil disalin!</p>
                    <p id="goToLogin" class="text-sm text-slate-300 mt-2">Simpan token ini untuk <a
                            class="text-blue-quaternary underline" href="{{ route('team.login') }}">login</a> ke
                        dashboard</p>
                    <a href="/"
                        class="mt-2 mx-auto block w-fit px-4 py-2 bg-blue-primary text-sm md:text-base hover:bg-blue-quinary hover:text-black rounded text-white transition">
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline JavaScript -->
    <script>
        document.getElementById('goToLogin').addEventListener('click', function() {
            document.location.href = "{{ route('team.login') }}";
        })
        function copyToken() {
            const tokenText = document.getElementById('tokenText').innerText;
            navigator.clipboard.writeText(tokenText).then(() => {
                const copiedText = document.getElementById('copiedText');
                copiedText.classList.remove('hidden');
                setTimeout(() => copiedText.classList.add('hidden'), 2000);
            });
        }
    </script>
</x-layout>
