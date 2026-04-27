<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold mb-4">Edit Team</h1>

        {{-- @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <!-- Team Info -->
        <div class="mb-6 bg-indigo-50 p-4 flex items-center gap-3">
            <img class="h-28 ml-2" src="{{ Storage::url($team->team_logo) }}" alt="{{ $team->team_name }}">
            <h2 class="text-3xl font-semibold text-indigo-800">{{ $team->team_name }}</h2>
        </div>

        <form action="{{ route('teams.update', $team->team_id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Team Name -->
            <x-form.input label="Team Name (mohon untuk memperhatikan nama team)" id="team_name" name="team_name" type="text" :default="$team->team_name" disabled />

            <!-- Team Logo -->
            {{-- <x-form.file label="Team Logo" id="team_logo" name="team_logo" type="file" mode="edit"
                accept="image/*">
                <!-- Current Image Preview -->
                @if ($team->team_logo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($team->team_logo) }}" class="h-32 w-auto object-contain rounded-md"
                            alt="{{ $team->team_name }} logo">
                    </div>
                @endif
            </x-form.file> --}}

            <!-- Team Email -->
            <x-form.input label="Team Email" id="team_email" name="team_email" type="email" :default="$team->team_email" disabled />

            <!-- Team Contact -->
            <x-form.input label="Team Contact" id="team_contact" name="team_contact" type="text" :default="$team->team_contact" disabled />

            <!-- Team Instance -->
            <x-form.select label="Team Instance" id="team_instance" name="team_instance" disabled>
                <option value="NO" {{ old('team_instance', $team->team_instance) == 'NO' ? 'selected' : '' }}>
                    No
                </option>
                <option value="YES" {{ old('team_instance', $team->team_instance) == 'YES' ? 'selected' : '' }}>
                    Yes
                </option>
            </x-form.select>

            <!-- Team Instance Name -->
            <div id="team_instance_name_wrapper" class="{{ $team->team_instance == 'NO' ? 'hidden' : '' }}">
                <x-form.input label="Team Instance Name" id="team_instance_name" name="team_instance_name"
                    :default="$team->team_instance_name" disabled />
            </div>

            {{-- Team invoice status --}}
            <x-form.select label="Team Invoice Status" id="team_invoice_status" name="team_invoice_status" required>
                <option value="decline"
                    {{ old('team_invoice_status', $team->team_invoice_status) == 'decline' ? 'selected' : '' }}>
                    Decline
                </option>
                <option value="pending"
                    {{ old('team_invoice_status', $team->team_invoice_status) == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="accept"
                    {{ old('team_invoice_status', $team->team_invoice_status) == 'accept' ? 'selected' : '' }}>
                    Accept
                </option>
            </x-form.select>

            <!-- Team final status -->
            <x-form.select label="Team Final Status" id="team_final_status" name="team_final_status" required>
                <option value="Penyisihan" {{ old('team_final_status', $team->team_final_status) == 'Penyisihan' ? 'selected' : '' }}>
                    Penyisihan
                </option>
                <option value="Semi Final" {{ old('team_final_status', $team->team_final_status) == 'Semi Final' ? 'selected' : '' }}>
                    Semi Final
                </option>
                <option value="Final" {{ old('team_final_status', $team->team_final_status) == 'Final' ? 'selected' : '' }}>
                    Final
                </option>
                <option value="Menang" {{ old('team_final_status', $team->team_final_status) == 'Menang' ? 'selected' : '' }}>
                    Menang
                </option>
                <option value="Kalah" {{ old('team_final_status', $team->team_final_status) == 'Kalah' ? 'selected' : '' }}>
                    Kalah
                </option>
                <option value="Diskualifikasi" {{ old('team_final_status', $team->team_final_status) == 'Diskualifikasi' ? 'selected' : '' }}>
                    Diskualifikasi
                </option>
            </x-form.select>

            <!-- Team Competition -->
            <x-form.select label="Team Competition" id="team_competition" name="competition_id" disabled>
                @foreach ($competitions as $competition)
                    <option value="{{ $competition->competition_id }}"
                        {{ old('team_competition', $team->competition_id) == $competition->competition_id ? 'selected' : '' }}>
                        {{ $competition->competition_name }}
                    </option>
                @endforeach
            </x-form.select>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('teams.index', ['competition_status' => 'active']) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Team
                </button>
            </div>
        </form>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('team_logo').addEventListener('change', function(e) {
            const fileInput = e.target;
            const fileName = document.getElementById('file-name');
            const preview = document.getElementById('logo-preview');

            if (fileInput.files && fileInput.files[0]) {
                fileName.textContent = fileInput.files[0].name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                fileName.textContent = 'No file selected';
                preview.classList.add('hidden');
            }
        });

        document.getElementById('team_instance').addEventListener('change', function() {
            teamInstanceName = document.getElementById('team_instance_name_wrapper');
            if (this.value == 'YES') {
                teamInstanceName.classList.remove('hidden');
            } else if (this.value == 'NO') {
                teamInstanceName.classList.add('hidden');
            }
        });
    </script>
</x-admin.layout>
