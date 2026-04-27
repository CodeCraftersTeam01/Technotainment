<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <!-- Competition Info -->
        <div class="flex items-center flex-col md:flex-row mb-6 bg-indigo-50 p-4 rounded-xl gap-4">
            <div class="flex-shrink-0">
                <img class="h-20 md:h-28 object-cover" src="{{ Storage::url($event->event_logo) }}" alt="{{ $event->event_name }}">
            </div>
            <div>
                <h2 class="text-xl font-semibold text-indigo-800 mb-2">{{ $event->event_name }}</h2>
                <p>{{ $event->event_about }}</p>
            </div>
        </div>

        <!-- Add announcement Button -->
        <div class="flex justify-between flex-wrap gap-y-4 items-center">
            <a href="{{ route('announcements.index', ['status' => 'active']) }}"
                class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Back
            </a>
            <button type="button" onclick="addAnnouncement({{ $event->event_id }})"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Announcement
            </button>
        </div>
        <p class="my-4 text-gray-500 italic mt-2">*NB: Tap photo to view</p>

        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
            <!-- announcements table -->
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ANNOUNCEMENT TITLE</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ANNOUNCEMENT PHOTO</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ANNOUNCEMENT DESCRIPTION</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @forelse($event->announcements as $announcement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900">{{ $announcement->announcement_id }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $announcement->announcement_title }}</td>
                            <td class="px-6 py-4">
                                @if($announcement->announcement_photo)
                                    <a href="{{ Storage::url($announcement->announcement_photo) }}" target="_blank">
                                        <img class="h-28 w-28 md:w-fit object-cover md:object-contain"
                                            src="{{ Storage::url($announcement->announcement_photo) }}" alt="logo">
                                    </a>
                                @else
                                    <p class="text-gray-500">No photo</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $announcement->announcement_description }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-button.action as="a"
                                        href="{{ route('announcements.edit', $announcement->announcement_id) }}"
                                        icon="components.icons.edit"
                                        onclick="openEditModal({{ $announcement->announcement_id }})"
                                        class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                        Edit
                                    </x-button.action>
                                    <form action="{{ route('announcements.destroy', $announcement->announcement_id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button.action as="button" type="submit"
                                            onclick="event.preventDefault(); alertDeleteModal({{ $announcement->announcement_id }});"
                                            icon="components.icons.delete"
                                            class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                            Delete
                                        </x-button.action>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No announcements found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination if needed -->
        @if (isset($announcements) && $announcements->hasPages())
            <div class="mt-6">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>

    <!-- Delete announcement Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete announcement</h3>
            </div>
            <div id="deleteTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this announcement? This action cannot be
                    undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete announcement
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        function addAnnouncement(eventId) {
            const url = `/announcements/create?event_id=${eventId}`;
            let params = new URLSearchParams(url.search);
            window.location.href = url;
        }

        // Add Timeline Modal Functions
        function openAddModal() {
            document.getElementById('addTimelineModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addTimelineModal').classList.add('hidden');
        }

        function alertDeleteModal(announcementId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/announcements/" + announcementId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</x-admin.layout>
