<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Edit Competition</h1>
        <form id="updateCompetitionForm" action="{{ route('competitions.update', $competition->competition_id) }}"
            method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- competition Name -->
            <x-form.input label="Competition Name" id="competition_name" name="competition_name" type="text"
                :default="$competition->competition_name" required />

            <!-- competition slug -->
            <x-form.input label="Competition Slug" id="slug" name="slug" type="text" :default="$competition->slug" required />
            <p class="text-sm mt-0 italic">*NB : (Untuk slug tanya litbang bang)</p>

            <!-- competition end date -->
            <x-form.input label="Competition End Date" id="competition_end_date" name="competition_end_date" type="date"
                :default="$competition->competition_end_date" required />

            <!-- competition Logo -->
            <x-form.file label="Competition Logo" id="competition_logo" name="competition_logo" type="file"
                accept="image/*" mode="edit">
                <!-- Current Image Preview -->
                @if ($competition->competition_logo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($competition->competition_logo) }}"
                            class="h-32 w-auto object-contain rounded-md"
                            alt="{{ $competition->competition_name }} logo">
                    </div>
                @endif
            </x-form.file>

            <div class="rounded-md">
                <p class="text-sm text-gray-500">Logo Placement</p>
                <img class="h-32 mt-2 rounded-md" src="{{ asset('images/primary_logo.png') }}" alt="primary logo">
            </div>

            <!-- competition second Logo -->
            <x-form.file label="Competition Seecond Logo" id="competition_second_logo" name="competition_second_logo" type="file"
                accept="image/*" mode="edit" fileName="second-file-name" preview="second-logo-preview">
                <!-- Current Image Preview -->
                @if ($competition->competition_second_logo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($competition->competition_second_logo) }}"
                            class="h-32 w-auto object-contain rounded-md"
                            alt="{{ $competition->competition_name }} logo">
                    </div>
                @endif
            </x-form.file>

            <div class="rounded-md">
                <p class="text-sm text-gray-500">Second Logo Placement</p>
                <img class="h-32 mt-2 rounded-md" src="{{ asset('images/second_logo.png') }}" alt="second logo">
            </div>

            <!-- competition Logo -->
            <x-form.file label="Competition Third Logo" id="competition_third_logo" name="competition_third_logo" type="file"
                accept="image/*" mode="edit" fileName="third-file-name" preview="third-logo-preview">
                <!-- Current Image Preview -->
                @if ($competition->competition_third_logo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($competition->competition_third_logo) }}"
                            class="h-32 w-auto object-contain rounded-md"
                            alt="{{ $competition->competition_name }} logo">
                    </div>
                @endif
            </x-form.file>

            <div class="rounded-md">
                <p class="text-sm text-gray-500">Third Logo Placement</p>
                <img class="h-32 mt-2 rounded-md" src="{{ asset('images/third_logo.png') }}" alt="third logo">
            </div>

            <!-- competition guidebook -->
            <div class="mb-4">
                <label for="competition_guide_book" class="block text-sm font-medium text-gray-700 mb-1">
                    Competition Guidebook
                </label>
                <div class="flex items-center space-x-2">
                    <input type="file" id="competition_guide_book" name="competition_guide_book"
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md
                        file:text-sm file:font-semibold
                        file:text-indigo-700
                        cursor-pointer hover:file:bg-indigo-100
                        file:border file:border-gray-300"
                        accept=".pdf" />
                </div>
                <p class="text-sm text-gray-500 italic">*PDF</p>
                <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current guidebook</p>
                @error('competition_guide_book')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- competition description -->
            <x-form.textarea label="Competition Description" id="competition_description" name="competition_description" :default="$competition->competition_description" />

            <!-- competition information -->
            <x-form.editor editorId="editor_competition_information" label="Competition Information"
                id="competition_information" name="competition_information" :default="$competition->competition_information" required />

            <!-- competition instance_level -->
            <x-form.input label="Competition Instance Level" id="competition_instance_level" name="competition_instance_level"
                :default="$competition->competition_instance_level" type="text" />

            <!-- competition Status -->
            <x-form.select label="Competition Status" id="competition_status" name="competition_status">
                <option value="nonactive"
                    {{ old('competition_status', $competition->competition_status) == 'nonactive' ? 'selected' : '' }}>
                    Non-Active</option>
                <option value="active"
                    {{ old('competition_status', $competition->competition_status) == 'active' ? 'selected' : '' }}>
                    Active
                </option>
            </x-form.select>

            <!-- competition fee -->
            <x-form.input label="Competition Fee" id="competition_fee" name="competition_fee" type="number" :default="$competition->competition_fee" required />

            <!-- competition type -->
            <x-form.select label="Competition Type" id="competition_type" name="competition_type">
                <option value="Non-E-Sports"
                    {{ old('competition_type', $competition->competition_type) == 'E-Sports' ? 'selected' : '' }}>
                    Non-E-Sport</option>
                <option value="E-Sports"
                    {{ old('competition_type', $competition->competition_type) == 'E-Sports' ? 'selected' : '' }}>
                    E-Sport
                </option>
            </x-form.select>

            <!-- event id -->
            <x-form.select label="Event" id="event_id" name="event_id">
                @foreach ($events as $event)
                    <option value="{{ $event->event_id }}"
                        {{ old('event_id', $event->event_id) == $competition->event_id ? 'selected' : '' }}>
                        {{ $event->event_name }}
                    </option>
                @endforeach
            </x-form.select>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('competitions.index', ['event_status' => 'active']) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Competition
                </button>
            </div>
        </form>
    </div>

    <script>
        // Preview image before upload
        document.addEventListener("DOMContentLoaded", function() {
            const nameInput = document.getElementById('competition_name');
            const slugInput = document.getElementById('slug');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', function() {
                    // Only auto-update if slug was already derived from name or is being edited
                    const slug = nameInput.value.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    slugInput.value = slug;
                });
            }

            const editorCompetitionInformation = createEditor('#editor_competition_information');

            const competitionInformationField = document.querySelector('#competition_information');

            editorCompetitionInformation.insertText(competitionInformationField.value);

            document.querySelector('#updateCompetitionForm').addEventListener('submit', function(e) {
                e.preventDefault();
                competitionInformationField.value = editorCompetitionInformation
                    .getMarkdown();
                e.target.submit();
            })
        });

        // Preview image before upload
        document.getElementById('competition_logo').addEventListener('change', function(e) {
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

        // Preview second image before upload
        document.getElementById('competition_second_logo').addEventListener('change', function(e) {
            const secondFileInput = e.target;
            const secondFileName = document.getElementById('second-file-name');
            const secondPreview = document.getElementById('second-logo-preview');
            if (secondFileInput.files && secondFileInput.files[0]) {
                secondFileName.textContent = secondFileInput.files[0].name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    secondPreview.src = e.target.result;
                    secondPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(secondFileInput.files[0]);
            } else {
                secondFileInput.textContent = 'No file selected';
                secondPreview.classList.add('hidden');
            }
        });

        // Preview third image before upload
        document.getElementById('competition_third_logo').addEventListener('change', function(e) {
            const thirdFileInput = e.target;
            const thirdFileName = document.getElementById('third-file-name');
            const thirdPreview = document.getElementById('third-logo-preview');
            if (thirdFileInput.files && thirdFileInput.files[0]) {
                thirdFileName.textContent = thirdFileInput.files[0].name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    thirdPreview.src = e.target.result;
                    thirdPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(thirdFileInput.files[0]);
            } else {
                thirdFileInput.textContent = 'No file selected';
                thirdPreview.classList.add('hidden');
            }
        });

    </script>
</x-admin.layout>
