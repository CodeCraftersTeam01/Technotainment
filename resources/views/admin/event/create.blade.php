<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Add Event</h1>
        <form id="createEventForm" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <!-- Event Name -->
            <x-form.input label="Event Name" id="event_name" name="event_name" type="text" required />

            <!-- Event Logo -->
            <x-form.file label="Event Logo" id="event_logo" name="event_logo" type="file" accept="image/*"
                required />
            
            <!-- Event Theme -->
            <x-form.input label="Event Theme" id="event_theme" name="event_theme" type="text" required />

            <!-- Event About -->
            <x-form.textarea label="Event About" id="event_about" name="event_about" required />

            <!-- Event Description -->
            <x-form.editor editorId="editor_event_description" label="Event Description" id="event_description"
                name="event_description" />

            <!-- Event Year -->
            <x-form.input label="Event Year" id="event_year" name="event_year" type="text" value="{{ date('Y') }}" required />

            <!-- Event Status -->
            <x-form.select label="Event Status" id="event_status" name="event_status">
                <option value="nonactive">Non-Active</option>
                <option value="active">Active</option>
            </x-form.select>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('events.index') }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Event
                </button>
            </div>
        </form>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('event_logo').addEventListener('change', function(e) {
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

        document.addEventListener('DOMContentLoaded', function() {
            const editorEventDescription = createEditor('#editor_event_description');

            const eventDescriptionField = document.querySelector('#event_description');

            if (eventDescriptionField.value) {
                editorEventDescription.insertText(eventDescriptionField.value);
            }

            console.log(document.getElementById('event_about').value + 'p')

            document.querySelector('#createEventForm').addEventListener('submit', function(e) {
                e.preventDefault();
                eventDescriptionField.value = editorEventDescription
                    .getMarkdown();
                e.target.submit();
            });
        });
    </script>
</x-admin.layout>
