<x-layout>
    <section class="bg-[#f0f0ff] flex justify-center items-center min-h-screen p-4 font-sans">
        <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">
            <!-- blue circle in top left -->
            <div class="absolute w-16 h-16 bg-blue-primary rounded-full -top-6 -left-6 z-0"></div>

            <!-- Login Form Section -->
            <div class="w-full md:w-1/2 p-8 md:p-12 z-10">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2">LOGIN</h1>
                <p class="text-sm text-gray-500 mb-8">Enter your credentials to access your account</p>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-mail-icon lucide-mail h-5 w-5 text-blue-primary">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </div>
                        <input type="text" name="email" placeholder="Email Address"
                            class="pl-10 w-full py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent"
                            required>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" placeholder="Password"
                            class="pl-10 w-full py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent"
                            required>
                    </div>

                    @if (session('error'))
                        <div class="text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <button type="submit"
                        class="w-full bg-blue-primary hover:bg-blue-secondary text-white font-medium py-3 rounded-lg transition duration-300">
                        CONTINUE
                    </button>
                </form>
            </div>

            <!-- Image Section -->
            <div
                class="hidden md:block w-1/2 bg-gradient-to-br from-blue-primary to-blue-secondary m-3 ml-0 rounded-2xl relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute w-10 h-10 bg-white/20 rounded-full top-1/4 left-10"></div>
                <div class="absolute w-10 h-10 bg-white/20 rounded-full bottom-1/4 right-10"></div>

                <!-- Woman image -->
                <div class="flex justify-center items-center h-full">
                    <img src="{{ asset('undraw_upload-image_tpmp.png') }}" alt="logo techno"
                        class="w-4/5 h-auto object-cover z-10 rounded-2xl">
                </div>

                <!-- Plus icon circle -->
                <div class="absolute right-10 top-1/3 w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
</x-layout>
