@props(['competition'])

@if (session('error'))
    <p class="text-md text-red-500">{{ session('error') }}</p>
@endif

<div id="step-1" class="step-content active transition-all duration-500">
    <div class="space-y-8">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
            <h2 class="text-2xl font-semibold text-blue-primary">Informasi Tim</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2 group">
                <label for="team_name"
                    class="block text-sm font-medium text-blue-primary group-focus-within:text-blue-primary transition-colors">
                    Nama Team {{ $competition->slug == 'dZ4AnskCXj' ? '(isi nama lengkap)' : '' }}<span
                        class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 rounded-lg border {{ $errors->has('team_name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                        id="team_name" name="team_name" type="text" placeholder="Masukkan nama tim"
                        value="{{ old('team_name') }}" />
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="space-y-2 group">
                <label for="team_email"
                    class="block text-sm font-medium text-blue-primary group-focus-within:text-blue-primary transition-colors">
                    Email (pastikan yang aktif) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 rounded-lg border {{ $errors->has('team_email') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                        id="team_email" name="team_email" type="email" placeholder="email@example.com"
                        value="{{ old('team_email') }}" />
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                </div>
            </div>

            @if ($competition->slug != 'dZ4AnskCXj')
                <div class="space-y-2">
                    <label for="team_logo" class="block text-sm font-medium text-blue-primary">
                        Logo Team <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center">
                        <label
                            class="w-full flex items-center justify-center px-4 py-3 rounded-lg border {{ $errors->has('team_logo') ? 'border-red-500' : 'border-blue-quinary' }} bg-white hover:bg-blue-quinary/10 cursor-pointer transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2 text-blue-tertiary group-hover:text-blue-primary transition-colors"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-blue-tertiary group-hover:text-blue-primary transition-colors">Pilih
                                logo tim</span>
                            <input id="team_logo" name="team_logo" type="file" accept="image/*" class="hidden" />
                        </label>
                        <span id="team_logo_name" class="ml-2 text-sm text-blue-tertiary truncate max-w-[150px]"></span>
                    </div>
                    <div id="logo-preview" class="mt-2 hidden">
                        <img src="/placeholder.svg" alt="Logo Preview"
                            class="h-16 w-16 object-cover rounded-lg border border-blue-quinary">
                    </div>
                    <p class="text-sm text-gray-500 italic">*jpeg,png,jpg maks 2MB</p>
                </div>
            @endif

            <div class="space-y-2 group">
                <label for="team_contact"
                    class="block text-sm font-medium text-blue-primary group-focus-within:text-blue-primary transition-colors">
                    Kontak (pastikan yang aktif) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-4 py-3 rounded-lg border {{ $errors->has('team_contact') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                        id="team_contact" name="team_contact" type="text" placeholder="Nomor telepon/WhatsApp"
                        value="{{ old('team_contact') }}" />
                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Inputan untuk team_invoice akan tampil jika lomba bukan UI/UX --}}
        @if ($competition->slug != '7lTI2n5EDK')
            <div class="space-y-2">
                <label for="team_invoice" class="block text-sm font-medium text-blue-primary">
                    Bukti Pembayaran <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center">
                    <label
                        class="w-full flex items-center justify-center px-4 py-3 rounded-lg border {{ $errors->has('team_invoice') ? 'border-red-500' : 'border-blue-quinary' }} bg-white hover:bg-blue-quinary/10 cursor-pointer transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2 text-blue-tertiary group-hover:text-blue-primary transition-colors"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-blue-tertiary group-hover:text-blue-primary transition-colors">Upload
                            bukti pembayaran</span>
                        <input id="team_invoice" name="team_invoice" type="file" accept="image/*" class="hidden" />
                    </label>
                    <span id="team_invoice_name"
                        class="ml-2 text-sm text-blue-tertiary truncate max-w-[150px]"></span>
                </div>
                <div id="invoice-preview" class="mt-2 hidden">
                    <img src="/placeholder.svg" alt="Invoice Preview"
                        class="h-16 w-auto object-cover rounded-lg border border-blue-quinary">
                </div>
                <p class="text-sm text-gray-500 italic">*jpeg,png,jpg maks 2MB</p>
            </div>
        @endif

        <div class="space-y-3">
            <label class="block text-sm font-medium text-blue-primary">
                Instansi <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <input type="radio" id="team_instance_yes" name="team_instance" value="YES"
                        class="h-5 w-5 text-blue-primary focus:ring-blue-primary"
                        {{ old('team_instance') == 'YES' ? 'checked' : '' }} />
                    <label for="team_instance_yes" class="ml-2 text-blue-primary">Ya</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="team_instance_no" name="team_instance" value="NO"
                        class="h-5 w-5 text-blue-primary focus:ring-blue-primary"
                        {{ old('team_instance', 'NO') == 'NO' ? 'checked' : '' }} />
                    <label for="team_instance_no" class="ml-2 text-blue-primary">Tidak</label>
                </div>
            </div>
        </div>

        <div id="team_instance_name_container"
            class="space-y-2 transition-all duration-300 {{ old('team_instance') == 'YES' ? '' : 'hidden' }}">
            <label for="team_instance_name" class="block text-sm font-medium text-blue-primary">
                Nama Instansi (nama sekolah atau perusahaan) <span class="text-red-500">*</span>
            </label>
            <input
                class="w-full px-4 py-3 rounded-lg border {{ $errors->has('team_instance_name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary transition-all"
                id="team_instance_name" name="team_instance_name" type="text"
                placeholder="Masukkan nama instansi" value="{{ old('team_instance_name') }}" />
        </div>

        <div class="pt-4 flex justify-end">
            <button type="button" id="next-step"
                class="bg-blue-primary hover:bg-blue-secondary text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-opacity-50 flex items-center">
                Lanjutkan
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="pt-4">
            <div class="bg-gradient-to-r from-blue-secondary to-blue-tertiary p-6 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold text-quinary mb-4">Metode Pembayaran :</h2>
                <div class="space-y-4">
                    <div
                        class="bg-white/10 backdrop-blur-sm p-4 rounded-lg hover:bg-white/20 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <img src="{{ asset('images/bri-logo.png') }}" alt="BRI" class="h-8">
                            </div>
                            <div>
                                <p class="text-quaternary text-sm font-medium">Bank BRI</p>
                                <p class="text-quinary font-semibold">364901038435531</p>
                                <p class="text-quinary text-sm">a/n RIZQITA MARTHA AMALIA</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm p-4 rounded-lg hover:bg-white/20 transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white p-2 rounded-lg">
                                <img src="{{ asset('images/dana.png') }}" alt="Dana" class="h-8">
                            </div>
                            <div>
                                <p class="text-quaternary text-sm font-medium">DANA</p>
                                <p class="text-quinary font-semibold">082140545290</p>
                                <p class="text-quinary text-sm">a/n TRISWANTI JANNATUL MA'WA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
