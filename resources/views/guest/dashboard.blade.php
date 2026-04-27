<x-layout>
    <x-web.loader />
    <div class="min-h-screen bg-gradient-to-br from-blue-primary to-blue-secondary md:py-12 md:px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto bg-white/10 backdrop-blur-md md:rounded-3xl shadow-xl py-10 md:p-10 relative text-white">

            <!-- Maskot -->
            <img src="{{ asset('images/maskot1.png') }}" alt="Maskot"
                class="absolute top-6 right-6 w-24 h-24 opacity-20 md:opacity-40 pointer-events-none select-none">

            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-quinary drop-shadow-lg">
                    {{ $team->team_name }}
                </h1>
                <p class="mt-2 text-blue-quaternary text-lg">Dashboard Tim Kamu</p>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Team Card -->
                <div class="bg-blue-secondary/30 rounded-xl p-6 shadow-lg space-y-4 relative">
                    <div class="flex items-center gap-4">
                        @if ($team->team_logo != null)
                            <img src="{{ asset('storage/' . $team->team_logo) }}" alt="Team Logo"
                                class="w-20 h-20 rounded-full object-cover border-4 border-white/20 shadow-md">
                        @endif
                        <div>
                            <h2 class="text-xl font-semibold">{{ $team->team_name }}</h2>
                            <p class="text-sm text-blue-quaternary">{{ $team->team_email }}</p>
                        </div>
                    </div>

                    <div class="text-sm text-blue-quaternary space-y-1">
                        <p><strong>Kontak:</strong> {{ $team->team_contact }}</p>
                        <p><strong>Instansi:</strong> ({{ $team->team_instance }}) {{ $team->team_instance == 'YES' ? $team->team_instance_name : '' }}</p>
                        <p><strong>Token:</strong>
                            <span id="token" class="bg-white/10 px-2 py-1 rounded font-mono text-sm select-all">
                                {{ $team->team_token }}
                            </span>
                            <button id="copy-token" onclick="navigator.clipboard.writeText('{{ $team->team_token }}')"
                                class="md:ml-2 px-2 py-1 mt-2 md:mt-0 bg-blue-primary hover:bg-blue-quinary text-white text-xs rounded transition">
                                Salin
                            </button>
                        <p id="successCopyToken" class="hidden text-green-500">Token berhasil disalin!</p>
                        </p>
                    </div>
                    <div class="flex gap-x-4">
                        <a href="/"
                        class="mt-2 block w-fit px-4 py-2 bg-blue-primary text-sm md:text-base hover:bg-blue-quinary hover:text-black rounded text-white transition">
                            Kembali ke Halaman Utama
                        </a>
                        <a href="{{ route('team.logout') }}"
                            class="mt-2 px-4 py-2 bg-blue-primary hover:bg-blue-quinary text-sm md:text-base hover:text-black rounded text-white transition">
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Competition Card -->
                <div class="bg-blue-tertiary/30 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold mb-4 text-blue-quinary">Info Kompetisi</h3>
                    <div class="flex items-center gap-4">
                        <img src="{{ Storage::url($team->competition->competition_logo) }}"
                            alt="Competition Logo" class="w-24 h-24 object-cover rounded-lg">
                        <div class="text-blue-quaternary text-sm space-y-1">
                            <p><strong>Nama:</strong> {{ $team->competition->competition_name }}</p>
                            <p><strong>Tipe:</strong> {{ $team->competition->competition_type }}</p>
                            <p><strong>Level:</strong> {{ $team->competition->competition_instance_level }}</p>
                            <p><strong>Biaya:</strong> Rp {{ number_format($team->competition->competition_fee) }}</p>
                            <p><strong>Status:</strong>
                                <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">
                                    {{ ucfirst($team->competition->competition_status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice and finalist status Section -->
            <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold text-blue-quinary mb-4">Invoice</h3>
                <p class="text-blue-quaternary mb-2">
                    <strong>Status:</strong>
                    <span
                        class="font-semibold capitalize 
                            @if($team->team_invoice)
                                @if($team->team_invoice_status === 'accept')
                                {{ 'text-green-500' }}
                                @elseif($team->team_invoice_status === 'decline')
                                {{ 'text-red-500' }}
                                @else
                                {{ 'text-yellow-500' }}
                                @endif
                            @else
                                {{ 'text-gray-500' }}
                            @endif
                        ">
                        {{ $team->team_invoice ? $team->team_invoice_status : 'Belum ada' }}
                    </span>
                </p>
                <h3 class="text-xl font-bold text-blue-quinary mb-4 mt-4">Status Team</h3>
                <p class="text-blue-quaternary mb-2">
                    <strong>Status:</strong>
                    <span
                        class="font-semibold capitalize {{ $team->team_final_status === 'Menang' ? 'text-orange-500' : '' }} {{ $team->team_final_status === 'Diskualifikasi' ? 'text-red-600' : '' }}">
                        @if($team->team_final_status === 'Menang')
                        {{ $team->team_final_status . ' 🔥🔥🔥' }}
                        @elseif($team->team_final_status === 'Kalah')
                        {{ $team->team_final_status . '. Tetap semangat!' }}
                        @else
                        {{ $team->team_final_status }}
                        @endif
                    </span>
                </p>
            </div>

            <!-- Work Submission list Section ui/ux -->
            @if ($team->competition->competition_type === 'Non-E-Sports' && $team->competition->slug === '7lTI2n5EDK')
                <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold text-blue-quinary mb-4">List Dokumen {{ $team->works[0]->work_proposal && $team->works[0]->work && $team->works[0]->work_abstract && $team->works[0]->work_title && $team->works[0]->work_ppt && $team->works[0]->work_original ? '(Lengkap)' : '' }}</h3>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Abstract :</strong>
                        @if($team->works[0]->work_abstract)
                        <a href="{{ Storage::url($team->works[0]->work_abstract) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Abstract
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Judul Karya :</strong>
                        @if($team->works[0]->work_title)
                            <span class="text-white">{{ $team->works[0]->work_title }}</span>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Karya :</strong>
                        @if($team->works[0]->work)
                        <a href="{{ $team->works[0]->work }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Karya (Figma)
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Proposal :</strong>
                        @if($team->works[0]->work_proposal)
                        <a href="{{ Storage::url($team->works[0]->work_proposal) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Proposal
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>PPT :</strong>
                        @if($team->works[0]->work_ppt)
                        <a href="{{ Storage::url($team->works[0]->work_ppt) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat PPT
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Originalitas :</strong>
                        @if($team->works[0]->work_original)
                        <a href="{{ Storage::url($team->works[0]->work_original) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Originalitas
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                </div>
            <!-- Work Submission list Section ui/ux -->
            @elseif($team->competition->competition_type === 'Non-E-Sports' && $team->competition->slug === 'I5njJtbe5J')
                <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold text-blue-quinary mb-4">Karya & Link Demo {{ $team->works[0]->work_link && $team->works[0]->work && $team->works[0]->work_title && $team->works[0]->work_original ? '(Lengkap)' : '' }}</h3>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Judul Project :</strong>
                        @if($team->works[0]->work_title)
                        <span class="text-white">
                            {{ $team->works[0]->work_title }}
                        </span>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Link Demo :</strong>
                        @if($team->works[0]->work_link)
                        <a href="{{ $team->works[0]->work_link }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Link Demo
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>File Project :</strong>
                        @if($team->works[0]->work)
                        <a href="{{ Storage::url($team->works[0]->work) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat File Project
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                    <p class="text-blue-quaternary mb-2">
                        <strong>Originalitas :</strong>
                        @if($team->works[0]->work_original)
                        <a href="{{ Storage::url($team->works[0]->work_original) }}" target="_blank"
                            class="text-white ml-2 underline hover:text-blue-quinary">
                            Lihat Originalitas
                        </a>
                        @else
                        <span class="text-white ml-2">Belum ada</span>
                        @endif
                    </p>
                </div>
            @endif

            <!-- Work Submission Section UI/UX Proposal, title, invoice & link -->
            @if ($team->competition->competition_type === 'Non-E-Sports' && $team->competition->slug === '7lTI2n5EDK')
                @if(!$team->works[0]->work &&
                    !$team->works[0]->work_proposal &&
                    !$team->works[0]->work_title &&
                    !$team->team_invoice &&
                    !$team->works[0]->work_original &&
                    $team->works[0]->work_abstract &&
                    $team->team_final_status == 'Semi Final' &&
                    \Carbon\Carbon::parse(now())->format('Y-m-d') >= $karyaDanProposal->start_date &&
                    \Carbon\Carbon::parse(now())->format('Y-m-d') <= $karyaDanProposal->end_date
                    )
                    <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-blue-quinary mb-4">Karya & Proposal</h3>
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div id="error-container"></div>
                        <form id="pdf-upload-form" action="{{ route('work.store', $team->team_id) }}" method="POST" enctype="multipart/form-data"
                            class="md:px-8 md:py-6 space-y-8">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="team_token" id="token" value="{{ $team->team_token }}">

                            <!-- Team Information Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Informasi Tim</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2 group">
                                        <label for="team_name"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Nama Team <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_name" name="team_name" type="text"
                                                placeholder="Masukkan nama tim" value="{{ $team->team_name }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="space-y-2 group">
                                        <label for="team_email"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_email') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_email" name="team_email" type="email"
                                                placeholder="email@example.com" value="{{ $team->team_email }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Upload Dokumen</h2>
                                </div>

                                <!-- Judul Karya -->
                                <div>
                                    <label for="work_title"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Judul Karya <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('work_title') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            id="work_title" name="work_title" type="text" value="{{ old('work_title') }}" required />
                                    </div>
                                    @error('work_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Work link Upload -->
                                <div>
                                    <label for="work"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Link Karya <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('work') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            id="work" name="work" type="text" placeholder="https://www.figma.com/..." value="{{ old('work') }}"  required />
                                    </div>
                                    <p class="text-sm text-white">Karya harus berupa Link/URL Figma</p>
                                    @error('work')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Proposal File Upload -->
                                <div>
                                    <label for="work_proposal"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload Proposal <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white
                                            {{ $errors->has('work_proposal') ? 'border-red-500' : 'border-blue-quinary' }}
                                            "
                                            id="work_proposal" name="work_proposal" type="file" accept=".pdf" required />
                                    </div>
                                    <p class="text-sm text-white italic">*Format file harus PDF, maks 5MB</p>
                                    @error('work_proposal')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Invoice File Upload -->
                                <div>
                                    <label for="team_invoice"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload Bukti Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            {{ $errors->has('work_proposal') ? 'border-red-500' : 'border-blue-quinary' }}
                                            id="team_invoice" name="team_invoice" type="file" accept="image/*" required />
                                    </div>
                                    <p class="text-sm italic">*Format file img, jpg, jpeg, png, maks 5MB</p>
                                    @error('team_invoice')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Invoice File Upload -->
                                <div>
                                    <label for="team_invoice"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload Originalitas Karya <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            {{ $errors->has('work_original') ? 'border-red-500' : 'border-blue-quinary' }}
                                            id="work_original" name="work_original" type="file" accept=".pdf" required />
                                    </div>
                                    <p class="text-sm italic">*Format file harus PDF, maks 5MB</p>
                                    @error('work_original')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                {{-- drag and drop input but not use --}}
                                {{-- <div
                                    class="p-6 bg-white border border-blue-quinary rounded-xl space-y-4 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center">
                                        <div class="bg-blue-tertiary/10 rounded-full p-2 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-tertiary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-blue-primary">File Proposal <span
                                                class="text-red-500">*</span></h3>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="border-2 border-dashed border-blue-quinary rounded-lg p-6 text-center"
                                            id="proposal-dropzone">
                                            <input type="file" name="proposal_file" id="proposal_file"
                                                accept="application/pdf" class="hidden" />
                                            <div class="space-y-2" id="proposal-upload-prompt">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="mx-auto h-12 w-12 text-blue-tertiary" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="text-blue-tertiary">Drag & drop file PDF di sini atau <span
                                                        class="text-purple-primary font-medium cursor-pointer">browse</span>
                                                </p>
                                                <p class="text-sm text-blue-tertiary/70">Maksimal 10MB</p>
                                            </div>

                                            <div id="proposal-file-preview" class="hidden">
                                                <div
                                                    class="flex items-center justify-between bg-blue-quinary/20 p-3 rounded-lg">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-8 w-8 text-red-500 mr-3" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        </svg>
                                                        <div class="text-left">
                                                            <p class="wrap-break-word font-medium text-blue-primary"
                                                                id="proposal-file-name">
                                                                proposal.pdf</p>
                                                            <p class="text-sm text-blue-tertiary" id="proposal-file-size">
                                                                0 KB
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="proposal-file-remove"
                                                        class="text-red-500 hover:text-red-700 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-sm text-blue-tertiary">
                                            <a class="underline" href="{{ Storage::url(Storage::url($team->competition->competition_guide_book)) }}" target="_blank">Lihat ketentuan Proposal disini</a>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                            <p class="text-white mt-2 italic">Harap diperhatikan ketika submit dokumen karena submit hanya bisa dilakukan satu kali. Lihat ketentuan lengkap di <a class="underline text-white" href="{{ Storage::url($team->competition->competition_guide_book) }}">Guide Book</a></p>
                            <button type="submit" name="submit"
                                class="mt-2 px-4 py-2 bg-blue-primary hover:bg-blue-quinary hover:text-black rounded text-white transition">
                                Kirim
                            </button>
                        </form>
                    </div>
                <!-- Work Submission Section UI/UX PPT -->
                @elseif($team->works[0]->work &&
                $team->works[0]->work_proposal &&
                $team->team_invoice &&
                $team->works[0]->work_original &&
                $team->team_invoice_status == 'accept' &&
                !$team->works[0]->work_ppt &&
                $team->team_final_status == 'Final' &&
                \Carbon\Carbon::parse(now())->format('Y-m-d') >= $ppt->start_date &&
                \Carbon\Carbon::parse(now())->format('Y-m-d') <= $ppt->end_date)
                    <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-blue-quinary mb-4">Karya & Proposal</h3>
                        <div id="error-container"></div>
                        <form id="pdf-upload-form" action="{{ route('work.store', $team->team_id) }}" method="POST" enctype="multipart/form-data"
                            class="md:px-8 md:py-6 space-y-8">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="team_token" id="token" value="{{ $team->team_token }}">

                            <!-- Team Information Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Informasi Tim</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2 group">
                                        <label for="team_name"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Nama Team <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_name" name="team_name" type="text"
                                                placeholder="Masukkan nama tim" value="{{ $team->team_name }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="space-y-2 group">
                                        <label for="team_email"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_email') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_email" name="team_email" type="email"
                                                placeholder="email@example.com" value="{{ $team->team_email }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Upload Dokumen</h2>
                                </div>

                                <!-- PPT File Upload -->
                                <div>
                                    <label for="work_ppt"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload PPT <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            {{ $errors->has('work_proposal') ? 'border-red-500' : 'border-blue-quinary' }}
                                            id="work_ppt" name="work_ppt" type="file" accept=".ppt,.pptx" required />
                                    </div>
                                    <p class="text-sm italic">*Format file PPTX atau PPT</p>
                                    @error('work_ppt')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <p class="text-white mt-2 italic">Harap diperhatikan ketika submit dokumen karena submit hanya bisa dilakukan satu kali. Lihat ketentuan lengkap di <a class="underline text-white" href="{{ Storage::url($team->competition->competition_guide_book) }}">Guide Book</a></p>
                            <button type="submit" name="submit"
                                class="mt-2 px-4 py-2 bg-blue-primary hover:bg-blue-quinary hover:text-black rounded text-white transition">
                                Kirim
                            </button>
                        </form>
                    </div>
                @endif
            
            <!-- Work Submission Section Web Design -->
            @elseif ($team->competition->competition_type === 'Non-E-Sports' && $team->competition->slug === 'I5njJtbe5J')
                @if(!$team->works[0]->work && !$team->works[0]->work_link && !$team->works[0]->work_title && $team->team_invoice_status === 'accept' && $team->team_final_status === 'Final' && \Carbon\Carbon::parse(now())->format('Y-m-d') >= $linkDanZip->start_date && \Carbon\Carbon::parse(now())->format('Y-m-d') <= $linkDanZip->end_date))
                    <div class="mt-10 bg-blue-quinary/10 p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-bold text-blue-quinary mb-4">Karya & Link Demo</h3>
                        <div id="error-container"></div>
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('work.store', $team->team_id) }}" method="POST" enctype="multipart/form-data"
                            class="md:px-8 md:py-6 space-y-8">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="team_token" id="token" value="{{ $team->team_token }}">

                            <!-- Team Information Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Informasi Tim</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2 group">
                                        <label for="team_name"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Nama Team <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_name') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_name" name="team_name" type="text"
                                                placeholder="Masukkan nama tim" value="{{ $team->team_name }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="space-y-2 group">
                                        <label for="team_email"
                                            class="block text-sm font-medium text-white transition-colors">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('team_email') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                                id="team_email" name="team_email" type="email"
                                                placeholder="email@example.com" value="{{ $team->team_email }}" required />
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none opacity-0 group-focus-within:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('team_email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-1 bg-blue-primary rounded-full"></div>
                                    <h2 class="text-2xl font-semibold text-white">Upload Dokumen</h2>
                                </div>
                                <div>
                                    <label for="work_title"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Judul Project <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('work_title') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            id="work_title" name="work_title" type="text" required />
                                    </div>
                                    @error('work_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="work_link"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Link Demo Project (GitHub) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="text-black w-full px-4 py-3 rounded-lg border {{ $errors->has('work_link') ? 'border-red-500' : 'border-blue-quinary' }} focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            id="work_link" name="work_link" type="text" placeholder="https://github.com/.../..." required />
                                    </div>
                                    <p class="text-sm text-white">Demo project harus berupa Link/URL GitHub (contoh: https://github.com/user/repo)</p>
                                    @error('work_link')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- File project Upload -->
                                <div>
                                    <label for="work"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload File Project <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white
                                            {{ $errors->has('work') ? 'border-red-500' : 'border-blue-quinary' }}
                                            "
                                            id="work" name="work" type="file" accept=".zip,.rar,.7z" required />
                                    </div>
                                    <p class="text-sm text-white italic">*Format file harus ZIP, RAR atau 7z</p>
                                    @error('work')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- original File Upload -->
                                <div>
                                    <label for="team_invoice"
                                        class="block mb-6 text-sm font-medium text-white transition-colors">
                                        Upload Originalitas Karya <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="block text-sm
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md
                                            file:text-sm file:font-semibold
                                            file:text-indigo-700
                                            cursor-pointer hover:file:bg-indigo-100
                                            file:border file:border-gray-300
                                            text-black w-full px-4 py-3 rounded-lg border
                                            focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all bg-white"
                                            {{ $errors->has('work_original') ? 'border-red-500' : 'border-blue-quinary' }}
                                            id="work_original" name="work_original" type="file" accept=".pdf" required />
                                    </div>
                                    <p class="text-sm italic">*Format file harus PDF, maks 5MB</p>
                                    @error('work_original')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <p class="text-white mt-2 italic">Harap diperhatikan ketika submit dokumen karena submit hanya bisa dilakukan satu kali. Lihat ketentuan lengkap di <a class="underline text-white" href="{{ Storage::url($team->competition->competition_guide_book) }}">Guide Book</a></p>
                            <button type="submit"
                                class="mt-2 px-4 py-2 bg-blue-primary hover:bg-blue-quinary rounded text-white transition">
                                Kirim
                            </button>
                        </form>
                    </div>
                @endif
            @endif


            <!-- Members Section -->
            <div class="mt-10 px-6">
                <h3 class="text-2xl font-bold text-blue-quinary mb-4">Anggota Tim</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($team->members as $member)
                        <div class="bg-white/10 rounded-xl p-4 text-center shadow-md hover:scale-[1.02] transition">
                            <p class="font-semibold text-white">{{ $member->member_team_name }}</p>
                            <p class="text-sm text-blue-quaternary">{{ $member->member_team_role }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const copyButton = document.getElementById('copy-token');
        copyButton.addEventListener('click', copyToken);
        function copyToken() {
            const tokenText = document.getElementById('token').innerText;
            navigator.clipboard.writeText(tokenText).then(() => {
                const copiedText = document.getElementById('successCopyToken');
                copiedText.classList.remove('hidden');
                setTimeout(() => copiedText.classList.add('hidden'), 2000);
            });
        }
        // // Work File Upload Handling
        // const workDropzone = document.getElementById('work-dropzone');
        // const workFileInput = document.getElementById('work_file');
        // const workUploadPrompt = document.getElementById('work-upload-prompt');
        // const workFilePreview = document.getElementById('work-file-preview');
        // const workFileName = document.getElementById('work-file-name');
        // const workFileSize = document.getElementById('work-file-size');
        // const workFileRemove = document.getElementById('work-file-remove');

        // // Handle click on dropzone
        // workDropzone.addEventListener('click', function() {
        //     workFileInput.click();
        // });

        // // Handle drag and drop
        // ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        //     workDropzone.addEventListener(eventName, preventDefaults, false);
        // });

        // function preventDefaults(e) {
        //     e.preventDefault();
        //     e.stopPropagation();
        // }

        // ['dragenter', 'dragover'].forEach(eventName => {
        //     workDropzone.addEventListener(eventName, highlight, false);
        // });

        // ['dragleave', 'drop'].forEach(eventName => {
        //     workDropzone.addEventListener(eventName, unhighlight, false);
        // });

        // function highlight() {
        //     workDropzone.classList.add('border-purple-primary', 'bg-purple-primary/5');
        // }

        // function unhighlight() {
        //     workDropzone.classList.remove('border-purple-primary', 'bg-purple-primary/5');
        // }

        // workDropzone.addEventListener('drop', handleWorkDrop, false);

        // function handleWorkDrop(e) {
        //     const dt = e.dataTransfer;
        //     const file = dt.files[0];
        //     handleWorkFile(file);
        // }

        // // Handle file selection
        // workFileInput.addEventListener('change', function() {
        //     if (this.files && this.files[0]) {
        //         handleWorkFile(this.files[0]);
        //     }
        // });

        // function handleWorkFile(file) {
        //     // Check if file is PDF
        //     if (file.type !== 'application/pdf') {
        //         alert('Hanya file PDF yang diperbolehkan!');
        //         return;
        //     }

        //     // Check file size (max 10MB)
        //     if (file.size > 10 * 1024 * 1024) {
        //         alert('Ukuran file maksimal 10MB!');
        //         return;
        //     }

        //     // Update preview
        //     workFileName.textContent = file.name;
        //     workFileSize.textContent = formatFileSize(file.size);
        //     workUploadPrompt.classList.add('hidden');
        //     workFilePreview.classList.remove('hidden');
        // }

        // // Remove work file
        // workFileRemove.addEventListener('click', function() {
        //     workFileInput.value = '';
        //     workUploadPrompt.classList.remove('hidden');
        //     workFilePreview.classList.add('hidden');
        // });

        // // Proposal File Upload Handling
        // const proposalDropzone = document.getElementById('proposal-dropzone');
        // const proposalFileInput = document.getElementById('proposal_file');
        // const proposalUploadPrompt = document.getElementById('proposal-upload-prompt');
        // const proposalFilePreview = document.getElementById('proposal-file-preview');
        // const proposalFileName = document.getElementById('proposal-file-name');
        // const proposalFileSize = document.getElementById('proposal-file-size');
        // const proposalFileRemove = document.getElementById('proposal-file-remove');

        // // Handle click on dropzone
        // proposalDropzone.addEventListener('click', function() {
        //     proposalFileInput.click();
        // });

        // // Handle drag and drop
        // ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        //     proposalDropzone.addEventListener(eventName, preventDefaults, false);
        // });

        // ['dragenter', 'dragover'].forEach(eventName => {
        //     proposalDropzone.addEventListener(eventName, highlightProposal, false);
        // });

        // ['dragleave', 'drop'].forEach(eventName => {
        //     proposalDropzone.addEventListener(eventName, unhighlightProposal, false);
        // });

        // function highlightProposal() {
        //     proposalDropzone.classList.add('border-purple-primary', 'bg-purple-primary/5');
        // }

        // function unhighlightProposal() {
        //     proposalDropzone.classList.remove('border-purple-primary', 'bg-purple-primary/5');
        // }

        // proposalDropzone.addEventListener('drop', handleProposalDrop, false);

        // function handleProposalDrop(e) {
        //     const dt = e.dataTransfer;
        //     console.log(dt);
        //     const file = dt.files[0];
        //     handleProposalFile(file);
        // }

        // // Handle file selection
        // proposalFileInput.addEventListener('change', function() {
        //     if (this.files && this.files[0]) {
        //         handleProposalFile(this.files[0]);
        //     }
        // });

        // function handleProposalFile(file) {
        //     // Check if file is PDF
        //     if (file.type !== 'application/pdf') {
        //         alert('Hanya file PDF yang diperbolehkan!');
        //         return;
        //     }

        //     // Check file size (max 10MB)
        //     if (file.size > 10 * 1024 * 1024) {
        //         alert('Ukuran file maksimal 10MB!');
        //         return;
        //     }

        //     // Update preview
        //     proposalFileName.textContent = file.name;
        //     proposalFileSize.textContent = formatFileSize(file.size);
        //     proposalUploadPrompt.classList.add('hidden');
        //     proposalFilePreview.classList.remove('hidden');
        // }

        // // Remove proposal file
        // proposalFileRemove.addEventListener('click', function() {
        //     proposalFileInput.value = '';
        //     proposalUploadPrompt.classList.remove('hidden');
        //     proposalFilePreview.classList.add('hidden');
        // });

        // Form submission
        // const formSubmission = document.getElementById('pdf-upload-form');
        // formSubmission.addEventListener('submit', function(e) {
        //     e.preventDefault();

            // Validate form
            // let hasErrors = false;
            // const errorContainer = document.createElement('div');
            // errorContainer.className =
            //     'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4 animate-fade-in';
            // errorContainer.innerHTML = `
            //     <div class="flex">
            //         <div class="flex-shrink-0">
            //             <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            //                 <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            //             </svg>
            //         </div>
            //         <div class="ml-3">
            //             <p class="font-bold">Mohon periksa form berikut:</p>
            //             <ul class="list-disc pl-5 mt-2 space-y-1"></ul>
            //         </div>
            //     </div>
            // `;
            // const errorList = errorContainer.querySelector('ul');

            // Validate team name
            // const teamName = document.getElementById('team_name');
            // if (!teamName.value.trim()) {
            //     hasErrors = true;
            //     const li = document.createElement('li');
            //     li.textContent = 'Nama Team harus diisi';
            //     errorList.appendChild(li);
            //     teamName.classList.add('border-red-500');
            // } else {
            //     teamName.classList.remove('border-red-500');
            // }

            // Validate team email
            // const teamEmail = document.getElementById('team_email');
            // if (!teamEmail.value.trim()) {
            //     hasErrors = true;
            //     const li = document.createElement('li');
            //     li.textContent = 'Email harus diisi';
            //     errorList.appendChild(li);
            //     teamEmail.classList.add('border-red-500');
            // } else if (!/^\S+@\S+\.\S+$/.test(teamEmail.value)) {
            //     hasErrors = true;
            //     const li = document.createElement('li');
            //     li.textContent = 'Format Email tidak valid';
            //     errorList.appendChild(li);
            //     teamEmail.classList.add('border-red-500');
            // } else {
            //     teamEmail.classList.remove('border-red-500');
            // }

            // Validate work file
            // if (!workFileInput.files || workFileInput.files.length === 0) {
            //     hasErrors = true;
            //     const li = document.createElement('li');
            //     li.textContent = 'File Work harus diupload';
            //     errorList.appendChild(li);
            //     workDropzone.classList.add('border-red-500');
            // } else {
            //     workDropzone.classList.remove('border-red-500');
            // }

            // Validate proposal file
            // if (!proposalFileInput.files || proposalFileInput.files.length === 0) {
            //     hasErrors = true;
            //     const li = document.createElement('li');
            //     li.textContent = 'File Proposal harus diupload';
            //     errorList.appendChild(li);
            //     proposalDropzone.classList.add('border-red-500');
            // } else {
            //     proposalDropzone.classList.remove('border-red-500');
            // }

            // Show errors if any
            // if (hasErrors) {
                // Remove existing error messages
                // const oldError = document.querySelector('.bg-red-100.border-l-4');
                // if (oldError) {
                //     oldError.remove();
                // }

                // Add new error message
                // const errorContainerDiv = document.getElementById('error-container');
                // errorContainerDiv.appendChild(errorContainer);

                // Scroll to top to show errors
                // window.scrollTo({
                //     top: 600,
                //     behavior: 'smooth'
                // });

                // return;
            // }

            // Show loading overlay
        //     document.getElementById('loading-overlay').classList.remove('hidden');

        //     // Submit the form after a short delay to show the loading animation
        //     setTimeout(() => {
        //         formSubmission.submit();
        //     }, 500);
        // });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }
    </style>
</x-layout>
