<x-admin.layout header="Events">
    <div class="flex items-center justify-end mb-5">
        <a href="{{ route('events.create') }}"
            class="text-sm bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 pr-4 pl-2 rounded-lg shadow-sm transition-all duration-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Create
        </a>
    </div>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT YEAR</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT STATUS</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($events as $event)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">{{ $event->event_id }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <img class="h-28 w-28 md:w-fit object-cover md:object-contain" src="{{ Storage::url($event->event_logo) }}" alt="logo">
                        </td>
                        <td class="px-6 py-4">{{ $event->event_name }}</td>
                        <td class="px-6 py-4">{{ $event->event_year }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full {{ $event->event_status === 'active' ? 'bg-green-50' : 'bg-red-50' }} px-2 py-1 text-xs font-semibold {{ $event->event_status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                <span
                                    class="h-1.5 w-1.5 rounded-full {{ $event->event_status === 'active' ? 'bg-green-600' : 'bg-red-600' }}">

                                </span>
                                {{ ucfirst($event->event_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action icon="components.icons.edit"
                                    href="{{ route('events.edit', $event->event_id) }}"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('events.destroy', $event->event_id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $event->event_id }});"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No event found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $events->links() }}
    </div>

    <!-- Delete Event Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Event</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this event? This action cannot be undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Event
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        // Delete Event Modal Functions
        function alertDeleteModal(eventId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/events/" + eventId;
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
