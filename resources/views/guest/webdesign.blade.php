<x-layout>
    <!-- Loading Overlay -->
    <x-web.loader />

    {{-- Background Elements --}}
    <div class="fixed inset-0 bg-black -z-10"></div>
    <div class="fixed inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 pointer-events-none -z-10"></div>
    
    {{-- Ambient Light Orbs --}}
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#00c6e6]/10 blur-[100px] animate-pulse -z-10"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-[#00c6e6]/5 blur-[100px] animate-pulse -z-10" style="animation-delay: 2s;"></div>

    {{-- Square Grid Background --}}
    <div class="fixed inset-0 bg-[linear-gradient(to_right,rgba(128,128,128,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(128,128,128,0.05)_1px,transparent_1px)] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] -z-10"></div>

    <div class="min-h-screen py-20 px-3 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto w-full">
            <!-- Progress Bar -->
            <div class="mb-10 w-full max-w-2xl mx-auto">
                <div class="flex justify-between items-end mb-4">
                    <div class="text-left">
                        <p class="text-[10px] font-black text-[#00c6e6] uppercase tracking-[0.3em] mb-1">Current Step</p>
                        <span class="text-white text-xl font-black tracking-tight" id="progress-text">Informasi Tim</span>
                    </div>
                    <div class="text-right">
                        <span class="text-white/40 text-xs font-bold uppercase tracking-widest"><span id="current-step" class="text-white">1</span> / 2</span>
                    </div>
                </div>
                <div class="w-full bg-white/5 rounded-full h-1.5 overflow-hidden backdrop-blur-sm border border-white/5">
                    <div id="progress-bar" class="bg-gradient-to-r from-[#00c6e6] to-[#007b8f] h-full rounded-full transition-all duration-700 ease-out shadow-[0_0_15px_rgba(0,198,230,0.4)]"
                        style="width: 50%"></div>
                </div>
            </div>

            <div class="glass-card rounded-2xl sm:rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl animate-reveal w-full min-w-0">
                <!-- Header with Competition Logo -->
                <x-web.registration.header :competition="$competition" />

                <!-- Error Messages Container -->
                <div class="w-full px-4 sm:px-8 pt-6" id="error-container">
                    @if ($errors->any())
                        <div class="p-6 mb-8 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 animate-reveal">
                            <div class="flex gap-4">
                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-black uppercase tracking-widest text-xs mb-2">Attention Required</p>
                                    <ul class="text-sm font-medium space-y-1 list-disc pl-4">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Form -->
                <form id="registration-form" action="{{ route('registration.store', $competition->slug) }}"
                    method="POST" enctype="multipart/form-data" class="px-4 sm:px-8 py-6 sm:py-10">
                    @csrf
                    <input type="hidden" name="slug" value="{{ $competition->slug }}">

                    <!-- Multi-step Form Container -->
                    <div class="relative">
                        <!-- Step 1: Team Information -->
                        <x-web.registration.stepone :competition="$competition" />

                        <!-- Step 2: Member Information -->
                        <x-web.registration.steptwo :competition="$competition" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle untuk instansi
        const instanceYes = document.getElementById('team_instance_yes');
        const instanceNo = document.getElementById('team_instance_no');
        const instanceNameContainer = document.getElementById('team_instance_name_container');

        if (instanceYes && instanceNo) {
            instanceYes.addEventListener('change', function() {
                instanceNameContainer.classList.remove('hidden');
            });

            instanceNo.addEventListener('change', function() {
                instanceNameContainer.classList.add('hidden');
            });
        }

        // Helper for file selection feedback
        function handleFileChange(inputId, nameId, previewId = null) {
            const input = document.getElementById(inputId);
            if (!input) return;
            
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const nameElement = document.getElementById(nameId);
                    if (nameElement) nameElement.textContent = file.name;

                    if (previewId) {
                        const preview = document.getElementById(previewId);
                        const previewContainer = document.getElementById(previewId + '_preview') || preview;
                        
                        if (previewContainer) previewContainer.classList.remove('hidden');
                        
                        const img = preview.querySelector('img');
                        if (img) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                img.src = e.target.result;
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });
        }

        handleFileChange('team_logo', 'team_logo_name', 'logo-preview');
        handleFileChange('team_invoice', 'team_invoice_name', 'invoice-preview');

        // Menampilkan nama file untuk anggota
        document.querySelectorAll('.member-file').forEach(input => {
            input.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const file = this.files[0];
                if (file) {
                    const nameElement = document.getElementById(`member_file_${index}`);
                    if (nameElement) nameElement.textContent = file.name;
                    
                    const previewContainer = document.getElementById(`member_file_${index}_preview`);
                    if (previewContainer) previewContainer.classList.remove('hidden');
                }
            });
        });

        // Multi-step form handling
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const nextBtn = document.getElementById('next-step');
        const prevBtn = document.getElementById('prev-step');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const currentStepText = document.getElementById('current-step');

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                // Validate first step
                let hasErrors = false;
                const requiredFields = [
                    { id: 'team_name', name: 'Nama Team' },
                    { id: 'team_email', name: 'Email' },
                    { id: 'team_contact', name: 'Kontak' },
                    { id: 'team_logo', name: 'Logo Team', isFile: true },
                    { id: 'team_invoice', name: 'Bukti Pembayaran', isFile: true }
                ];
                
                // Create error box
                const errorContainer = document.createElement('div');
                errorContainer.className = 'p-6 mb-8 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 animate-reveal';
                errorContainer.innerHTML = `
                    <div class="flex gap-4">
                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="font-black uppercase tracking-widest text-xs mb-2">Attention Required</p>
                            <ul class="text-sm font-medium space-y-1 list-disc pl-4"></ul>
                        </div>
                    </div>
                `;
                const errorList = errorContainer.querySelector('ul');

                requiredFields.forEach(field => {
                    const element = document.getElementById(field.id);
                    if (!element) return;

                    let invalid = false;
                    if (field.isFile) {
                        if (!element.files || element.files.length === 0) invalid = true;
                    } else {
                        if (!element.value.trim()) invalid = true;
                    }

                    if (invalid) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = `${field.name} wajib diisi`;
                        errorList.appendChild(li);
                        
                        const target = field.isFile ? element.closest('label') : element;
                        if (target) target.classList.add('!border-red-500/50');
                    } else {
                        const target = field.isFile ? element.closest('label') : element;
                        if (target) target.classList.remove('!border-red-500/50');
                    }
                });

                if (instanceYes && instanceYes.checked) {
                    const instanceName = document.getElementById('team_instance_name');
                    if (!instanceName.value.trim()) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = 'Nama Instansi wajib diisi';
                        errorList.appendChild(li);
                        instanceName.classList.add('!border-red-500/50');
                    } else {
                        instanceName.classList.remove('!border-red-500/50');
                    }
                }

                if (hasErrors) {
                    const oldError = document.querySelector('#error-container .p-6');
                    if (oldError) oldError.remove();
                    document.querySelector('#error-container').appendChild(errorContainer);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    return;
                }

                // Clear errors and move
                document.querySelector('#error-container').innerHTML = '';
                step1.classList.add('hidden');
                step1.classList.remove('active');
                step2.classList.remove('hidden');
                setTimeout(() => step2.classList.add('active'), 10);
                progressBar.style.width = '100%';
                progressText.textContent = 'Informasi Anggota';
                currentStepText.textContent = '2';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                step2.classList.add('hidden');
                step2.classList.remove('active');
                step1.classList.remove('hidden');
                setTimeout(() => step1.classList.add('active'), 10);
                progressBar.style.width = '50%';
                progressText.textContent = 'Informasi Tim';
                currentStepText.textContent = '1';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Form submission loading
        document.getElementById('registration-form').addEventListener('submit', function(e) {
            if (this.checkValidity()) {
                document.getElementById('loading-overlay').classList.remove('hidden');
            }
        });
    </script>
</x-layout>
