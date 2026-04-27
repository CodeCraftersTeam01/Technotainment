<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg md:rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Add Announcement</h1>
        <form id="createAnnouncementForm" action="{{ route('announcements.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <!-- announcement title -->
            <x-form.input label="Announcement Title" id="announcement_title" name="announcement_title" type="text"
                required />
            
            <!-- announcement photo -->
            <x-form.file label="Announcement Photo" id="announcement_photo" name="announcement_photo" type="file"
                accept="image/*" />
            <p class="text-sm text-gray-500 italic">*Image</p>

            <!-- announcement description -->
            <x-form.editor editorId="editor_announcement_description" label="Announcement Description"
                id="announcement_description" name="announcement_description" />

            <!-- competition id -->
            <input type="hidden" name="event_id" id="event_id" value="{{ request('event_id') }}">

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('announcements.show', $event_id) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Announcement
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create editor
            const editorAnnouncementDescription = createEditor('#editor_announcement_description');

            const announcementDescriptionField = document.querySelector('#announcement_description');

            if (announcementDescriptionField.value) {
                editorAnnouncementDescription.insertText(announcementDescriptionField.value);
            }

            document.querySelector('#createAnnouncementForm').addEventListener('submit', function(e) {
                e.preventDefault();
                announcementDescriptionField.value = editorAnnouncementDescription
                    .getMarkdown();
                e.target.submit();
            });
        });

        document.getElementById('announcement_photo').addEventListener('change', function(e) {
            // Preview image before upload
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
        })
    </script>
</x-admin.layout>
