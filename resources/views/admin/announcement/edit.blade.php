<div class="w-full">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="text-red-700 text-md font-semibold mt-1 bg-red-100 outline outline-1 outline-red-400 rounded-md p-3 mb-3">{{ $error }}</p>
        @endforeach
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
</div>

<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg md:rounded-3xl p-2 p-5">
        <h1 class="text-3xl font-semibold">Edit Announcement</h1>
        <form id="createEventForm" action="{{ route('announcements.update', $announcement->announcement_id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- announcement title -->
            <x-form.input label="Announcement Title" id="announcement_title" name="announcement_title" type="text"
                :default="$announcement->announcement_title" required />

            <!-- announcement photo -->
            <x-form.file label="Announcement Photo" id="announcement_photo" name="announcement_photo" type="file"
                accept="image/*" />
            <p class="text-sm text-gray-500 italic">*Image</p>

                @if ($announcement->announcement_photo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($announcement->announcement_photo) }}" class="h-32 w-auto object-contain rounded-md"
                            alt="{{ $announcement->announcement_title }} logo" id="currentPhoto">
                    </div>
                @endif
            @if($announcement->announcement_photo)
                <span class="text-sm text-red-500 italic inline-block space-y-0" id="deletePhotoStatus"></span>
                <a id="deletePhoto"
                    class="cursor-pointer text-sm bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 pr-4 pl-2 rounded-lg shadow-sm transition-all duration-200 flex w-fit items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Delete Photo
                </a>
            @endif

            <!-- announcement description -->
            <x-form.editor editorId="editor_announcement_description" label="Announcement Description"
                id="announcement_description" name="announcement_description" :default="$announcement->announcement_description" />

            <!-- competition id -->
            <input type="hidden" name="event_id" id="event_id" value="{{ $announcement->event_id }}">

            <!-- announcement photo delete status -->
            <input type="hidden" name="delete_photo_status" id="delete_photo_status">

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('announcements.show', $announcement->event_id) }}"
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
            const editorAnnouncementDescription = createEditor('#editor_announcement_description');

            const announcementDescriptionField = document.querySelector('#announcement_description');

            const deletePhotoButton = document.getElementById('deletePhoto');
            const deletePhotoStatus = document.getElementById('deletePhotoStatus');
            const currentPhoto = document.getElementById('currentPhoto');

            deletePhotoButton.addEventListener('click', function() {
                deletePhotoStatus.textContent = 'Photo deleted';
                currentPhoto.src = '';
                currentPhoto.classList.add('hidden');
                document.getElementById('delete_photo_status').value = 'a8Zx9BdL1mP0QwE';
            });

            editorAnnouncementDescription.insertText(announcementDescriptionField.value);

            document.querySelector('#createEventForm').addEventListener('submit', function(e) {
                e.preventDefault();
                announcementDescriptionField.value = editorAnnouncementDescription
                    .getMarkdown();
                e.target.submit();
            });
        });

        document.getElementById('announcement_photo').addEventListener('change', function(e) {
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
