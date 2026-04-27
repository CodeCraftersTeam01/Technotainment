<x-layout>
    <!-- Loading Overlay -->
    <x-web.loader />

    <div class="min-h-screen bg-gradient-to-br from-blue-primary to-blue-secondary pt-12 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Progress Bar -->
            <div class="mb-8 px-4">
                <div class="flex justify-between mb-2">
                    <span class="text-quaternary text-sm font-medium" id="progress-text">Informasi Tim</span>
                    <span class="text-quaternary text-sm font-medium"><span id="current-step">1</span>/2</span>
                </div>
                <div class="w-full bg-blue-quinary/30 rounded-full h-2.5">
                    <div id="progress-bar" class="bg-blue-tertiary h-2.5 rounded-full transition-all duration-500"
                        style="width: 50%"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500">
                <!-- Header with Competition Logo -->
                <x-web.registration.header :competition="$competition" />

                <!-- Error Messages -->
                <div class="w-full px-8 pt-6" id="error-container"></div>

                <!-- Form -->
                <form id="registration-form" action="{{ route('registration.store', $competition->slug) }}"
                    method="POST" enctype="multipart/form-data" class="px-8 py-6">
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

        instanceYes.addEventListener('change', function() {
            instanceNameContainer.classList.remove('hidden');
        });

        instanceNo.addEventListener('change', function() {
            instanceNameContainer.classList.add('hidden');
        });

        // Menampilkan nama file yang dipilih dan preview untuk logo
        document.getElementById('team_logo').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                document.getElementById('team_logo_name').textContent = file.name;

                // Preview image
                const preview = document.getElementById('logo-preview');
                preview.classList.remove('hidden');
                const img = preview.querySelector('img');
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Menampilkan nama file yang dipilih dan preview untuk invoice
        document.getElementById('team_invoice').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                document.getElementById('team_invoice_name').textContent = file.name;

                // Preview image
                const preview = document.getElementById('invoice-preview');
                preview.classList.remove('hidden');
                const img = preview.querySelector('img');
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Menampilkan nama file untuk anggota dan preview
        document.querySelectorAll('.member-file').forEach(input => {
            input.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const file = this.files[0];
                if (file) {
                    document.getElementById(`member_file_${index}`).textContent = file.name;

                    // Preview image
                    const preview = document.getElementById(`member-preview-${index}`);
                    preview.classList.remove('hidden');
                    const img = preview.querySelector('img');
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
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

        nextBtn.addEventListener('click', function() {
            // Validate first step
            let hasErrors = false;
            const requiredFields = [{
                    id: 'team_name',
                    name: 'Nama Team'
                },
                {
                    id: 'team_email',
                    name: 'Email'
                },
                {
                    id: 'team_contact',
                    name: 'Kontak'
                },
                {
                    id: 'team_logo',
                    name: 'Logo Team',
                    isFile: true
                },
                {
                    id: 'team_invoice',
                    name: 'Bukti Pembayaran',
                    isFile: true
                }
            ];

            // Reset error messages
            const errorContainer = document.createElement('div');
            errorContainer.className =
                'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4 animate-fade-in';
            errorContainer.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-bold">Mohon periksa form berikut:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1"></ul>
                    </div>
                </div>
            `;
            const errorList = errorContainer.querySelector('ul');

            // Validasi field dasar
            requiredFields.forEach(field => {
                const element = document.getElementById(field.id);
                if (field.isFile) {
                    if (!element.files || element.files.length === 0) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = `${field.name} harus diisi`;
                        errorList.appendChild(li);
                        element.parentElement.classList.add('border-red-500');
                    } else {
                        element.parentElement.classList.remove('border-red-500');
                    }
                } else {
                    if (!element.value.trim()) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = `${field.name} harus diisi`;
                        errorList.appendChild(li);
                        element.classList.add('border-red-500');
                    } else if (field.isEmail) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(element.value)) {
                            hasErrors = true;
                            const li = document.createElement('li');
                            li.textContent = `${field.name} harus valid`;
                            errorList.appendChild(li);
                            element.classList.add('border-red-500');
                        } else {
                            element.classList.remove('border-red-500');
                        }
                    } else if (field.isPhone) {
                        const phoneRegex = /^\d{10,15}$/;
                        if (!phoneRegex.test(element.value)) {
                            hasErrors = true;
                            const li = document.createElement('li');
                            li.textContent = `${field.name} harus valid`;
                            errorList.appendChild(li);
                            element.classList.add('border-red-500');
                        } else {
                            element.classList.remove('border-red-500');
                        }
                    } else {
                        element.classList.remove('border-red-500');
                    }
                }
            });


            // Validasi nama instansi jika Ya dipilih
            if (instanceYes.checked) {
                const instanceName = document.getElementById('team_instance_name');
                if (!instanceName.value.trim()) {
                    hasErrors = true;
                    const li = document.createElement('li');
                    li.textContent = 'Nama Instansi harus diisi';
                    errorList.appendChild(li);
                    instanceName.classList.add('border-red-500');
                } else {
                    instanceName.classList.remove('border-red-500');
                }
            }

            // Tampilkan error jika ada
            if (hasErrors) {
                // Hapus pesan error lama jika ada
                const oldError = document.querySelector('.bg-red-100.border-l-4');
                if (oldError) {
                    oldError.remove();
                }

                // Tambahkan pesan error baru
                const errors = document.querySelector('#error-container');
                errors.appendChild(errorContainer);

                return;
            }

            // Move to step 2
            step1.classList.add('hidden');
            step1.classList.remove('active');
            step2.classList.remove('hidden');
            step2.classList.add('active');
            progressBar.style.width = '100%';
            progressText.textContent = 'Informasi Anggota';
            currentStepText.textContent = '2';
        });

        prevBtn.addEventListener('click', function() {
            // Move back to step 1
            step2.classList.add('hidden');
            step2.classList.remove('active');
            step1.classList.remove('hidden');
            step1.classList.add('active');
            progressBar.style.width = '50%';
            progressText.textContent = 'Informasi Tim';
            currentStepText.textContent = '1';
        });

        // Form submission
        document.getElementById('registration-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading overlay
            document.getElementById('loading-overlay').classList.remove('hidden');

            // Submit the form after a short delay to show the loading animation
            setTimeout(() => {
                this.submit();
            }, 500);
        });

        // Validasi form sebelum submit
        document.getElementById('submit-form').addEventListener('click', function(e) {
            let hasErrors = false;

            // Validasi anggota tim
            const slug = '{{ $competition->slug }}';
            const memberCounts = {
                'Ia1Dh6sZdQ': 5, // Mobile Legends (5 anggota + 1 cadangan)
                'dZ4AnskCXj': 1, // PES (1 anggota)
                '7lTI2n5EDK': 2, // UI/UX (3 anggota)
                'I5njJtbe5J': 2, // Web Designer (3 anggota)
            };

            const memberCount = memberCounts[slug] || 4;

            // Reset error messages
            const errorContainer = document.createElement('div');
            errorContainer.className =
                'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-4 animate-fade-in';
            errorContainer.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-bold">Mohon periksa form berikut:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1"></ul>
                    </div>
                </div>
            `;
            const errorList = errorContainer.querySelector('ul');

            // Validasi ketua tim (selalu wajib)
            const leaderName = document.querySelector('input[name="members[0][name]"]');
            const leaderIdentity = document.querySelector('input[name="members[0][identity]"]');

            if (!leaderName.value.trim()) {
                hasErrors = true;
                const li = document.createElement('li');
                li.textContent = 'Nama Ketua Tim harus diisi';
                errorList.appendChild(li);
                leaderName.classList.add('border-red-500');
            } else {
                leaderName.classList.remove('border-red-500');
            }

            if (!leaderIdentity.files || leaderIdentity.files.length === 0) {
                hasErrors = true;
                const li = document.createElement('li');
                li.textContent = 'KTP/Kartu Pelajar Ketua Tim harus diisi';
                errorList.appendChild(li);
                leaderIdentity.parentElement.classList.add('border-red-500');
            } else {
                leaderIdentity.parentElement.classList.remove('border-red-500');
            }

            // Validasi anggota lain (kecuali cadangan untuk Mobile Legends)
            for (let i = 1; i <= memberCount; i++) {
                const isOptional = (slug === 'I5njJtbe5J' && i === 2);
                const memberName = document.querySelector(`input[name="members[${i}][name]"]`);
                const memberIdentity = document.querySelector(`input[name="members[${i}][identity]"]`);

                const nameFilled = memberName.value.trim() !== "";
                const identityFilled = memberIdentity.files && memberIdentity.files.length > 0;
                
                if (!isOptional) {
                    // Validasi wajib semua
                    if (!nameFilled) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = `Nama Anggota ${i} harus diisi`;
                        errorList.appendChild(li);
                        memberName.classList.add('border-red-500');
                    } else {
                        memberName.classList.remove('border-red-500');
                    }

                    if (!identityFilled) {
                        hasErrors = true;
                        const li = document.createElement('li');
                        li.textContent = `KTP/Kartu Pelajar Anggota ${i} harus diisi`;
                        errorList.appendChild(li);
                        memberIdentity.parentElement.classList.add('border-red-500');
                    } else {
                        memberIdentity.parentElement.classList.remove('border-red-500');
                    }
                } else {
                    // Jika salah satu dari dua field diisi, maka dua-duanya wajib diisi
                    if (nameFilled || identityFilled) {
                        if (!nameFilled) {
                            hasErrors = true;
                            const li = document.createElement('li');
                            li.textContent = `Nama Anggota ${i} harus diisi karena dokumen sudah diunggah`;
                            errorList.appendChild(li);
                            memberName.classList.add('border-red-500');
                        } else {
                            memberName.classList.remove('border-red-500');
                        }

                        if (!identityFilled) {
                            hasErrors = true;
                            const li = document.createElement('li');
                            li.textContent = `KTP/Kartu Pelajar Anggota ${i} harus diisi karena nama telah diisi`;
                            errorList.appendChild(li);
                            memberIdentity.parentElement.classList.add('border-red-500');
                        } else {
                            memberIdentity.parentElement.classList.remove('border-red-500');
                        }
                    } else {
                        // Keduanya tidak diisi → tidak error
                        memberName.classList.remove('border-red-500');
                        memberIdentity.parentElement.classList.remove('border-red-500');
                    }
                }
            }

            // Tampilkan error jika ada
            if (hasErrors) {
                e.preventDefault();

                // Hapus pesan error lama jika ada
                const oldError = document.querySelector('.bg-red-100.border-l-4');
                if (oldError) {
                    oldError.remove();
                }

                // Tambahkan pesan error baru
                const errors = document.querySelector('#error-container');
                errors.appendChild(errorContainer);
            }
        });
    </script>
</x-layout>
