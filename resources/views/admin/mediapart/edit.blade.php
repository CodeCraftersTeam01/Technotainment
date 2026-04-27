<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Edit Media Partner</h1>
        <form action="{{ route('media-partners.update', $media_partner->media_partner_id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Media Partner Name -->
            <x-form.input label="Media Partner Name" id="media_partner_name" name="media_partner_name" type="text"
                :default="$media_partner->media_partner_name" required />

            <!-- Media Partner Logo -->
            <x-form.file label="Media Partner Logo" id="media_partner_logo" name="media_partner_logo" type="file"
                mode="edit" accept="image/*">
                <!-- Current Image Preview -->
                @if ($media_partner->media_partner_logo)
                    <div class="mt-2 mb-3">
                        <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ Storage::url($media_partner->media_partner_logo) }}"
                            class="h-32 w-auto object-contain border rounded-md"
                            alt="{{ $media_partner->media_partner_logo }} logo">
                    </div>
                @endif
            </x-form.file>

            <!-- Media Partner Event -->
            <x-form.select label="Event Name" id="event_id" name="event_id" required>
                @forelse($events as $event)
                    <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                @empty
                    <option value="">No events found</option>
                @endforelse
            </x-form.select>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('media-partners.index', ['status' => 'active']) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Media Partner
                </button>
            </div>
        </form>
    </div>
    <script>
        // Preview image before upload
        document.getElementById('media_partner_logo').addEventListener('change', function(e) {
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
    </script>
</x-admin.layout>
