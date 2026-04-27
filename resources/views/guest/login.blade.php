<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-primary to-blue-secondary py-12 md:px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto mt-10">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 relative overflow-hidden">
                <!-- Background Effects -->
                <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-blue-quaternary/20 rounded-full blur-3xl"></div>
                <div class="absolute -top-16 -right-16 w-48 h-48 bg-blue-quinary/20 rounded-full blur-3xl"></div>

                <!-- Form Section -->
                <form action="{{ route('team.login.store') }}" method="POST"
                    class="flex flex-col-reverse md:flex-row gap-8 p-10 justify-between items-center">
                    @csrf
                    <!-- Left Side: Mascot and Bubble -->
                    <div class="relative mt-10 flex justify-center items-center">
                        <!-- Bubble -->
                        <div
                            class="absolute z-20 -top-12 left-0 bg-white/20 text-white px-4 py-2 rounded-lg shadow-lg max-w-xs text-sm backdrop-blur-sm border border-white/30">
                            ✨ Masukkan token-mu ya! Kita siap menyambutmu! ✨
                            <div
                                class="absolute -bottom-2 left-6 w-4 h-4 bg-white/20 rotate-45 border-l border-b border-white/30">
                            </div>
                        </div>
                        <!-- Mascot -->
                        <img src="/images/pose3.png" alt="maskot"
                            class="w-40 md:w-56 mt-20 md:mt-0 hover:scale-110 hover:-rotate-6 transition-all duration-300 z-10">
                    </div>

                    <!-- Right Side: Login Form -->
                    <div class="flex flex-col gap-4 w-full md:w-1/2">
                        <h2 class="text-4xl font-extrabold text-blue-tertiary">Login</h2>
                        <p class="text-md text-slate-300">Masukkan token Anda untuk melanjutkan</p>
                        <input type="text" name="team_token" id="token" placeholder="Contoh: XJ29-L0PQ-AB12"
                            class="px-4 py-2 bg-white/10 text-blue-quinary font-mono rounded-lg shadow-inner border {{ session('error') ? 'border-red-500' : 'border-blue-quinary' }} text-sm focus:outline-none" required>
                            @if(session('error'))
                                <p class="text-md text-red-500">{{ session('error') }}</p>
                            @endif
                            @error('team_token')
                                <p class="text-md text-red-500">{{ $message }}</p>
                            @enderror
                        <div class="flex justify-between gap-x-4">
                            <a href="/"
                                class="px-4 py-2 w-fit bg-blue-tertiary text-white rounded hover:bg-blue-secondary transition">
                                Kembali
                            </a>
                            <button type="submit"
                                class="px-4 py-2 w-full bg-blue-tertiary text-white rounded hover:bg-blue-secondary transition">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
