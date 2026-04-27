@props(['competition'])

<div id="step-2" class="step-content hidden transition-all duration-500">
    <div class="space-y-8">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
            <h2 class="text-2xl font-semibold text-blue-primary">Informasi Anggota</h2>
        </div>

        <!-- Ketua Tim -->
        <div class="p-6 bg-gradient-to-r from-blue-quinary/30 to-blue-quinary/10 rounded-xl space-y-4 shadow-sm">
            @if ($competition->slug != 'dZ4AnskCXj')
                <div class="flex items-center">
                    <div class="bg-blue-primary/10 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-blue-primary">Ketua Tim <span class="text-red-500">*</span></h3>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2 group">
                    <label
                        class="block text-sm font-medium text-blue-primary group-focus-within:text-blue-primary transition-colors">
                        @if ($competition->slug == 'Ia1Dh6sZdQ')
                            Nickname InGame
                        @else
                            Nama Lengkap
                        @endif
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            class="w-full px-4 py-3 rounded-lg border {{ $errors->has('members.0.name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                            name="members[0][name]" type="text"
                            placeholder="Nama {{ $competition->slug == 'dZ4AnskCXj' ? 'Lengkap' : 'Ketua Tim' }}"
                            value="{{ old('members.0.name') }}" />
                        <div
                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-blue-primary">
                        KTP/Kartu Pelajar <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center">
                        <label
                            class="w-full flex items-center justify-center px-4 py-3 rounded-lg border {{ $errors->has('members.0.identity') ? 'border-red-500' : 'border-blue-quinary' }} bg-white hover:bg-blue-quinary/10 cursor-pointer transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2 text-blue-tertiary group-hover:text-blue-primary transition-colors"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-blue-tertiary group-hover:text-blue-primary transition-colors">Upload
                                identitas</span>
                            <input name="members[0][identity]" type="file" accept="image/*"
                                class="hidden member-file" data-index="0" />
                        </label>
                        <span id="member_file_0" class="ml-2 text-sm text-blue-tertiary truncate max-w-[150px]"></span>
                    </div>
                    <div id="member-preview-0" class="mt-2 hidden">
                        <img src="/placeholder.svg" alt="ID Preview"
                            class="h-12 w-auto object-cover rounded-lg border border-blue-quinary">
                    </div>
                    <p class="text-sm text-gray-500 italic">*jpeg,png,jpg mask 2MB</p>
                </div>
            </div>
        </div>

        <!-- Anggota 1-4 -->
        @php
            // Menentukan jumlah anggota berdasarkan slug kompetisi
            $memberCount = match ($competition->slug) {
                'Ia1Dh6sZdQ' => 5, // Mobile Legends (5 anggota + 1 cadangan)
                'dZ4AnskCXj' => 0, // PES (1 anggota)
                '7lTI2n5EDK' => 2, // UI/UX (3 anggota)
                'I5njJtbe5J' => 2, // Web Designer (3 anggota)
                default => 4,
            };
        @endphp

        <div class="space-y-4">
            @for ($i = 1; $i <= $memberCount; $i++)
                <div
                    class="p-6 bg-white border border-blue-quinary rounded-xl space-y-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="bg-blue-tertiary/10 rounded-full p-2 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-tertiary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-blue-primary">
                            @if (($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2))
                                Anggota Cadangan (Opsional)
                            @else
                                Anggota {{ $i }} <span class="text-red-500">*</span>
                            @endif
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 group">
                            <label
                                class="block text-sm font-medium text-blue-primary group-focus-within:text-blue-primary transition-colors">
                                @if ($competition->slug == 'Ia1Dh6sZdQ')
                                    Nickname InGame
                                @else
                                    Nama Lengkap
                                @endif
                                @if (!(($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2)))
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <div class="relative">
                                <input
                                    class="w-full px-4 py-3 rounded-lg border {{ $errors->has('members.' . $i . '.name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                    name="members[{{ $i }}][name]" type="text"
                                    placeholder="Nama anggota {{ $i }}"
                                    value="{{ old('members.' . $i . '.name') }}" />
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-primary"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-blue-primary">
                                KTP/Kartu Pelajar
                                @if (!(($competition->slug == 'Ia1Dh6sZdQ' && $i == 5) || ($competition->slug == '7lTI2n5EDK' && $i == 2) || ($competition->slug == 'I5njJtbe5J' && $i == 2)))
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>
                            <div class="flex items-center">
                                <label
                                    class="w-full flex items-center justify-center px-4 py-3 rounded-lg border {{ $errors->has('members.' . $i . '.identity') ? 'border-red-500' : 'border-blue-quinary' }} bg-white hover:bg-blue-quinary/10 cursor-pointer transition-all group">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2 text-blue-tertiary group-hover:text-blue-primary transition-colors"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="text-blue-tertiary group-hover:text-blue-primary transition-colors">Upload
                                        identitas</span>
                                    <input name="members[{{ $i }}][identity]" type="file"
                                        accept="image/*" class="hidden member-file"
                                        data-index="{{ $i }}" />
                                </label>
                                <span id="member_file_{{ $i }}"
                                    class="ml-2 text-sm text-blue-tertiary truncate max-w-[150px]"></span>
                            </div>
                            <div id="member-preview-{{ $i }}" class="mt-2 hidden">
                                <img src="/placeholder.svg" alt="ID Preview"
                                    class="h-12 w-auto object-cover rounded-lg border border-blue-quinary">
                            </div>
                            <p class="text-sm text-gray-500 italic">*jpeg,png,jpg mask 2MB</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        {{-- Inputan untuk ui/ux work_abstract --}}
        @if ($competition->slug == '7lTI2n5EDK')
            <div class="space-y-2">
                <label class="block text-sm font-medium text-blue-primary">
                    Abstract <span class="text-red-500">*</span>
                </label>
                <div>
                    <label
                        class="w-full flex items-center justify-center px-4 py-3 rounded-lg border {{ $errors->has('work_abstract') ? 'border-red-500' : 'border-blue-quinary' }} bg-white hover:bg-blue-quinary/10 cursor-pointer transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2 text-blue-tertiary group-hover:text-purple-primary transition-colors"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-blue-tertiary group-hover:text-purple-primary transition-colors">Upload
                            Abstract</span>
                        <input name="work_abstract" id="work_abstract_input" type="file" accept=".pdf"
                            class="hidden member-file" />
                    </label>
                    <span id="work_abstract" class="ml-2 text-sm text-blue-tertiary truncate max-w-[150px]"></span>
                </div>
                <p class="text-sm text-gray-500 italic">*pdf maks 5MB</p>
                <a href="{{ Storage::url($competition->competition_guide_book) }}" class="text-sm text-gray-500 italic block underline">Lihat ketentuan Guide Book disini</a>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="pt-4 flex justify-between">
            <button type="button" id="prev-step"
                class="border border-blue-tertiary text-blue-tertiary hover:bg-blue-tertiary hover:text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-tertiary focus:ring-opacity-50 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </button>
            <button type="submit" id="submit-form"
                class="bg-blue-primary hover:bg-blue-secondary text-white font-medium py-2 px-1 md:py-3 md:px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-opacity-50 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                Daftar Sekarang
            </button>
        </div>
        <div class="pt-4">
            <div class="bg-gradient-to-r from-blue-secondary to-blue-tertiary p-6 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold text-quinary mb-4">Metode Pembayaran</h2>
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
