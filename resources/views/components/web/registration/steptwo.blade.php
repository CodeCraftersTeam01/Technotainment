@props(['competition'])

<div id="step-2" class="step-content hidden transition-all duration-500">
    <div class="space-y-8">
        <div class="flex items-center space-x-4">
            <div class="h-8 w-1.5 bg-[#00c6e6] rounded-full shadow-[0_0_15px_rgba(0,198,230,0.5)]"></div>
            <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Informasi Anggota</h2>
        </div>

        <!-- Ketua Tim -->
        <div class="p-5 sm:p-8 rounded-2xl sm:rounded-3xl bg-white/[0.03] border border-white/10 shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#00c6e6]/5 rounded-full blur-3xl transition-opacity opacity-0 group-hover:opacity-100"></div>
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-[#00c6e6]/20 rounded-2xl flex items-center justify-center text-[#00c6e6] shadow-[0_0_20px_rgba(0,198,230,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-white uppercase tracking-tight">Ketua Tim <span class="text-[#00c6e6]">*</span></h3>
                    <p class="text-white/30 text-xs font-medium uppercase tracking-widest">Main Leader & Point of Contact</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-8">
                <div class="space-y-2 group">
                    <label class="block text-xs font-bold text-white/50 uppercase tracking-widest transition-colors group-focus-within:text-[#00c6e6]">
                        @if ($competition->slug == 'Ia1Dh6sZdQ') Nickname InGame @else Nama Lengkap @endif <span class="text-[#00c6e6]">*</span>
                    </label>
                    <input
                        class="w-full px-5 py-4 rounded-xl border {{ $errors->has('members.0.name') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 transition-all bg-white/5 text-white placeholder:text-white/20"
                        name="members[0][name]" type="text"
                        placeholder="Nama {{ $competition->slug == 'dZ4AnskCXj' ? 'Lengkap' : 'Ketua Tim' }}"
                        value="{{ old('members.0.name') }}" />
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                        KTP / Kartu Pelajar <span class="text-[#00c6e6]">*</span>
                    </label>
                    <div class="flex flex-col gap-3">
                        <label class="w-full flex items-center justify-center px-5 py-4 rounded-xl border-2 border-dashed {{ $errors->has('members.0.identity') ? 'border-red-500/30' : 'border-white/10' }} bg-white/5 hover:bg-white/10 hover:border-[#00c6e6]/30 cursor-pointer transition-all group/file">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/30 group-hover/file:text-[#00c6e6] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-white/40 group-hover/file:text-white transition-colors">Upload identitas...</span>
                            </div>
                            <input name="members[0][identity]" type="file" accept="image/*" class="hidden member-file" data-index="0" />
                        </label>
                        <div id="member_file_0_preview" class="hidden flex items-center gap-3 p-2 bg-white/5 rounded-xl border border-white/10">
                            <span id="member_file_0" class="text-xs text-white/60 truncate px-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $memberCount = match ($competition->slug) {
                'Ia1Dh6sZdQ' => 5,
                'dZ4AnskCXj' => 0,
                '7lTI2n5EDK' => 2,
                'I5njJtbe5J' => 2,
                default => 4,
            };
        @endphp

        <div class="grid grid-cols-1 gap-6">
            @for ($i = 1; $i <= $memberCount; $i++)
                <div class="p-5 sm:p-8 rounded-2xl sm:rounded-3xl bg-white/[0.02] border border-white/5 hover:border-white/10 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-white/40 group-hover:text-[#00c6e6] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white uppercase tracking-tight">
                                @if (($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2))
                                    Anggota Cadangan <span class="text-white/20 text-xs ml-1">(Opsional)</span>
                                @else
                                    Anggota {{ $i }} <span class="text-[#00c6e6]">*</span>
                                @endif
                            </h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-8">
                        <div class="space-y-2 group">
                            <label class="block text-xs font-bold text-white/50 uppercase tracking-widest transition-colors group-focus-within:text-[#00c6e6]">
                                @if ($competition->slug == 'Ia1Dh6sZdQ') Nickname InGame @else Nama Lengkap @endif
                                @if (!(($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2)))
                                    <span class="text-[#00c6e6]">*</span>
                                @endif
                            </label>
                            <input
                                class="w-full px-5 py-4 rounded-xl border {{ $errors->has('members.' . $i . '.name') ? 'border-red-500/50' : 'border-white/10' }} focus:outline-none focus:ring-2 focus:ring-[#00c6e6]/50 transition-all bg-white/5 text-white placeholder:text-white/20"
                                name="members[{{ $i }}][name]" type="text"
                                placeholder="Nama anggota {{ $i }}"
                                value="{{ old('members.' . $i . '.name') }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                                KTP / Kartu Pelajar
                                @if (!(($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2)))
                                    <span class="text-[#00c6e6]">*</span>
                                @endif
                            </label>
                            <div class="flex flex-col gap-3">
                                <label class="w-full flex items-center justify-center px-5 py-4 rounded-xl border-2 border-dashed {{ $errors->has('members.' . $i . '.identity') ? 'border-red-500/30' : 'border-white/10' }} bg-white/5 hover:bg-white/10 hover:border-[#00c6e6]/30 cursor-pointer transition-all group/file">
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/30 group-hover/file:text-[#00c6e6] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium text-white/40 group-hover/file:text-white transition-colors">Upload identitas...</span>
                                    </div>
                                    <input name="members[{{ $i }}][identity]" type="file" accept="image/*" class="hidden member-file" data-index="{{ $i }}" />
                                </label>
                                <div id="member_file_{{ $i }}_preview" class="hidden flex items-center gap-3 p-2 bg-white/5 rounded-xl border border-white/10">
                                    <span id="member_file_{{ $i }}" class="text-xs text-white/60 truncate px-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        @if ($competition->slug == '7lTI2n5EDK')
            <div class="space-y-4 p-8 rounded-3xl bg-white/[0.03] border border-white/10">
                <label class="block text-xs font-bold text-white/50 uppercase tracking-widest">
                    Abstrak Karya <span class="text-[#00c6e6]">*</span>
                </label>
                <div class="flex flex-col gap-3">
                    <label class="w-full flex items-center justify-center px-5 py-4 rounded-xl border-2 border-dashed {{ $errors->has('work_abstract') ? 'border-red-500/30' : 'border-white/10' }} bg-white/5 hover:bg-white/10 hover:border-[#00c6e6]/30 cursor-pointer transition-all group/file">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/30 group-hover/file:text-[#00c6e6] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium text-white/40 group-hover/file:text-white transition-colors">Upload Abstract (PDF)...</span>
                        </div>
                        <input name="work_abstract" id="work_abstract_input" type="file" accept=".pdf" class="hidden member-file" />
                    </label>
                    <div id="work_abstract_preview" class="hidden flex items-center gap-3 p-2 bg-white/5 rounded-xl border border-white/10">
                        <span id="work_abstract" class="text-xs text-white/60 truncate px-2"></span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-[10px] text-white/30 font-medium italic">Format: PDF (Maks. 5MB)</p>
                    <a href="{{ Storage::url($competition->competition_guide_book) }}" class="text-[10px] text-[#00c6e6] hover:underline font-bold uppercase tracking-wider">Unduh Guidebook</a>
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <button type="button" id="prev-step" class="btn-secondary w-full sm:w-auto justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali Ke Informasi Tim
            </button>
            <button type="submit" id="submit-form" class="btn-primary w-full sm:w-auto justify-center">
                Daftar Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- Payment Methods (Duplicate for Step 2) --}}
        <div class="pt-4">
            <div class="relative overflow-hidden p-5 sm:p-8 rounded-[1.5rem] sm:rounded-[2rem] bg-gradient-to-br from-white/[0.05] to-white/[0.01] border border-white/10 shadow-2xl">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#00c6e6]/5 rounded-full blur-3xl"></div>
                
                <h2 class="text-xl font-black text-white mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#00c6e6]/20 flex items-center justify-center text-[#00c6e6] text-xs">#</span>
                    Metode Pembayaran
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="group p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#00c6e6]/30 hover:bg-white/[0.06] transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white p-2.5 rounded-xl">
                                <img src="{{ asset('images/bri-logo.png') }}" alt="BRI" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#00c6e6] uppercase tracking-widest">Bank BRI</p>
                                <p class="text-white font-black text-base sm:text-lg break-all">364901038435531</p>
                                <p class="text-white/40 text-xs">a.n Rizqita Martha Amalia</p>
                            </div>
                        </div>
                    </div>
                    <div class="group p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#00c6e6]/30 hover:bg-white/[0.06] transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white p-2.5 rounded-xl">
                                <img src="{{ asset('images/dana.png') }}" alt="Dana" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#00c6e6] uppercase tracking-widest">E-Wallet DANA</p>
                                <p class="text-white font-black text-base sm:text-lg">082140545290</p>
                                <p class="text-white/40 text-xs">a.n Triswanti Jannatul Ma'wa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
