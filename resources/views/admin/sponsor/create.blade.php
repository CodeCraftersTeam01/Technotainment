<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Add Sponsor</h1>
        <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Sponsor Name -->
            <x-form.input label="Sponsor Name" id="sponsor_name" name="sponsor_name" type="text" required />

            <!-- Sponsor Logo -->
            <x-form.file label="Sponsor Logo" id="sponsor_logo" name="sponsor_logo" type="file" accept="image/*" required />

            <!-- Sponsor Event -->
            <x-form.select label="Event Name" id="event_id" name="event_id" required>
                @forelse($events as $event)
                    <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                @empty
                    <option value="">No events found</option>
                @endforelse
            </x-form.select>

            <div class="flex justify-end">
                <a href="{{ route('sponsors.index', ['status' => 'active']) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Sponsor
                </button>
            </div>
        </form>
    </div>
    <script>
        // Preview image before upload
        document.getElementById('sponsor_logo').addEventListener('change', function(e) {
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
