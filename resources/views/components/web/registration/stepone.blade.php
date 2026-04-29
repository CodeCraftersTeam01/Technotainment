@props(['competition'])

@if (session('error'))
    <p class="text-md text-red-500">{{ session('error') }}</p>
@endif

<div id="step-1" class="step-content active transition-all duration-500">
    <div class="space-y-8">
        <div class="flex items-center space-x-4">
            <div class="h-8 w-1.5 bg-[#00c6e6] rounded-full shadow-[0_0_15px_rgba(0,198,230,0.5)]"></div>
            <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Informasi Tim</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-8">
            <div class="space-y-2 group">
                <label for="team_name" class="block text-xs font-bold text-white/50 uppercase tracking-widest transition-colors group-focus-within:text-[#00c6e6]">
                    Nama Team {{ $competition->slug == 'dZ4AnskCXj' ? '(isi nama lengkap)' : '' }} <span class="text-[#00c6e6]">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-5 py-4 rounded-xl border {{ $errors->has('team_name') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 focus:border-transparent transition-all bg-white/5 text-white placeholder:text-white/20"
                        id="team_name" name="team_name" type="text" placeholder="Masukkan nama tim"
                        value="{{ old('team_name') }}" />
                </div>
            </div>

            <div class="space-y-2 group">
                <label for="team_email" class="block text-xs font-bold text-white/50 uppercase tracking-widest transition-colors group-focus-within:text-[#00c6e6]">
                    Email Aktif <span class="text-[#00c6e6]">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-5 py-4 rounded-xl border {{ $errors->has('team_email') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 focus:border-transparent transition-all bg-white/5 text-white placeholder:text-white/20"
                        id="team_email" name="team_email" type="email" placeholder="email@example.com"
                        value="{{ old('team_email') }}" />
                </div>
            </div>

            @if ($competition->slug != 'dZ4AnskCXj')
                <div class="space-y-2">
                    <label for="team_logo" class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                        Logo Team <span class="text-[#00c6e6]">*</span>
                    </label>
                    <div class="flex flex-col gap-3">
                        <label class="w-full flex items-center justify-center px-5 py-4 rounded-xl border-2 border-dashed {{ $errors->has('team_logo') ? 'border-red-500/30' : 'border-white/10' }} bg-white/5 hover:bg-white/10 hover:border-[#00c6e6]/30 cursor-pointer transition-all group">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/30 group-hover:text-[#00c6e6] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-white/40 group-hover:text-white transition-colors">Pilih file logo...</span>
                            </div>
                            <input id="team_logo" name="team_logo" type="file" accept="image/*" class="hidden" />
                        </label>
                        <div id="logo-preview" class="hidden flex items-center gap-3 p-2 bg-white/5 rounded-xl border border-white/10">
                            <img src="" alt="Preview" class="h-10 w-10 object-cover rounded-lg">
                            <span id="team_logo_name" class="text-xs text-white/60 truncate max-w-[200px]"></span>
                        </div>
                    </div>
                    <p class="text-[10px] text-white/30 font-medium italic">Format: JPEG, PNG, JPG (Maks. 2MB)</p>
                </div>
            @endif

            <div class="space-y-2 group">
                <label for="team_contact" class="block text-xs font-bold text-white/50 uppercase tracking-widest transition-colors group-focus-within:text-[#00c6e6]">
                    WhatsApp Aktif <span class="text-[#00c6e6]">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-5 py-4 rounded-xl border {{ $errors->has('team_contact') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 focus:border-transparent transition-all bg-white/5 text-white placeholder:text-white/20"
                        id="team_contact" name="team_contact" type="text" placeholder="08123456789"
                        value="{{ old('team_contact') }}" />
                </div>
            </div>
        </div>

        @if ($competition->slug != '7lTI2n5EDK')
            <div class="space-y-2">
                <label for="team_invoice" class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                    Bukti Pembayaran <span class="text-[#00c6e6]">*</span>
                </label>
                <div class="flex flex-col gap-3">
                    <label class="w-full flex items-center justify-center px-5 py-4 rounded-xl border-2 border-dashed {{ $errors->has('team_invoice') ? 'border-red-500/30' : 'border-white/10' }} bg-white/5 hover:bg-white/10 hover:border-[#00c6e6]/30 cursor-pointer transition-all group">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/30 group-hover:text-[#00c6e6] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium text-white/40 group-hover:text-white transition-colors">Upload bukti transfer...</span>
                        </div>
                        <input id="team_invoice" name="team_invoice" type="file" accept="image/*" class="hidden" />
                    </label>
                    <div id="invoice-preview" class="hidden flex items-center gap-3 p-2 bg-white/5 rounded-xl border border-white/10">
                        <img src="" alt="Preview" class="h-10 w-10 object-cover rounded-lg">
                        <span id="team_invoice_name" class="text-xs text-white/60 truncate max-w-[200px]"></span>
                    </div>
                </div>
                <p class="text-[10px] text-white/30 font-medium italic">Format: JPEG, PNG, JPG (Maks. 2MB)</p>
            </div>
        @endif

        <div class="space-y-4 p-4 sm:p-6 rounded-2xl bg-white/[0.03] border border-white/10">
            <label class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                Status Instansi <span class="text-[#00c6e6]">*</span>
            </label>
            <div class="flex flex-wrap items-center gap-4 sm:gap-10">
                <div class="flex items-center cursor-pointer group">
                    <input type="radio" id="team_instance_yes" name="team_instance" value="YES"
                        class="h-5 w-5 border-white/20 bg-black text-[#00c6e6] focus:ring-[#00c6e6]/50"
                        {{ old('team_instance') == 'YES' ? 'checked' : '' }} />
                    <label for="team_instance_yes" class="ml-3 text-sm font-medium text-white/70 group-hover:text-white cursor-pointer transition-colors">Ya, Mewakili Instansi</label>
                </div>
                <div class="flex items-center cursor-pointer group">
                    <input type="radio" id="team_instance_no" name="team_instance" value="NO"
                        class="h-5 w-5 border-white/20 bg-black text-[#00c6e6] focus:ring-[#00c6e6]/50"
                        {{ old('team_instance', 'NO') == 'NO' ? 'checked' : '' }} />
                    <label for="team_instance_no" class="ml-3 text-sm font-medium text-white/70 group-hover:text-white cursor-pointer transition-colors">Tidak / Umum</label>
                </div>
            </div>
        </div>

        <div id="team_instance_name_container"
            class="space-y-2 transition-all duration-300 {{ old('team_instance') == 'YES' ? '' : 'hidden' }}">
            <label for="team_instance_name" class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                Nama Instansi <span class="text-[#00c6e6]">*</span>
            </label>
            <input
                class="w-full px-5 py-4 rounded-xl border {{ $errors->has('team_instance_name') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 transition-all bg-white/5 text-white placeholder:text-white/20"
                id="team_instance_name" name="team_instance_name" type="text"
                placeholder="Masukkan nama sekolah / instansi" value="{{ old('team_instance_name') }}" />
        </div>

        <div class="pt-4 flex justify-end">
            <button type="button" id="next-step" class="btn-primary w-full sm:w-auto justify-center">
                Lanjutkan Ke Informasi Anggota
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- Payment Methods --}}
        <div class="pt-4">
            <div class="relative overflow-hidden p-5 sm:p-8 rounded-[1.5rem] sm:rounded-[2rem] bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 shadow-2xl">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#00c6e6]/5 rounded-full blur-3xl"></div>
                
                <h2 class="text-xl font-black text-white mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#00c6e6]/20 flex items-center justify-center text-[#00c6e6] text-xs">#</span>
                    Metode Pembayaran
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- BRI --}}
                    <div class="group p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#00c6e6]/30 hover:bg-white/[0.06] transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white p-2.5 rounded-xl shadow-lg">
                                <img src="{{ asset('images/bri-logo.png') }}" alt="BRI" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#00c6e6] uppercase tracking-widest">Bank BRI</p>
                                <p class="text-white font-black text-base sm:text-lg break-all">364901038435531</p>
                                <p class="text-white/40 text-xs font-medium">a.n Rizqita Martha Amalia</p>
                            </div>
                        </div>
                    </div>

                    {{-- DANA --}}
                    <div class="group p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#00c6e6]/30 hover:bg-white/[0.06] transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white p-2.5 rounded-xl shadow-lg">
                                <img src="{{ asset('images/dana.png') }}" alt="Dana" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#00c6e6] uppercase tracking-widest">E-Wallet DANA</p>
                                <p class="text-white font-black text-base sm:text-lg">082140545290</p>
                                <p class="text-white/40 text-xs font-medium">a.n Triswanti Jannatul Ma'wa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
