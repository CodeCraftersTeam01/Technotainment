<x-admin.layout header="Media Partners">
    <div class="flex items-center justify-end mb-5 space-x-1 md:space-x-4">
        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Event Status:</label>
            <div class="relative">
                <select name="status" id="status"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Status</option>
                    <option class="text-gray-900" value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option class="text-gray-900" value="nonactive" {{ request('status') == 'nonactive' ? 'selected' : '' }}>Nonactive</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
        <a href="{{ route('media-partners.create') }}"
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
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">MEDPART LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">MEDPART NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($mediaPartners as $media_partner)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">
                                    {{ $media_partner->media_partner_id }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <img class="h-28 w-28 md:w-fit object-cover md:object-contain"
                                src="{{ Storage::url($media_partner->media_partner_logo) }}" alt="logo">
                        </td>
                        <td class="px-6 py-4">{{ $media_partner->media_partner_name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action icon="components.icons.edit"
                                    href="{{ route('media-partners.edit', $media_partner->media_partner_id) }}"
                                    class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('media-partners.destroy', $media_partner->media_partner_id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $media_partner->media_partner_id }});"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No media partner found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="mt-4">
        {{ $mediaPartners->links() }}
    </div>

    <!-- Delete Media Partner Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Media Partner</h3>
            </div>
            <div id="editTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this media partner? This action cannot be
                    undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Media Partner
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            const status = document.getElementById('status').value;
            
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

            // Update or remove status parameter
            if (status) {
                params.set('status', status);
            } else {
                params.delete('status');
            }

            // Redirect to the filtered URL
            window.location.href = `${url.pathname}?${params.toString()}`;
        }

        function alertDeleteModal(mediapartId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/media-partners/" + mediapartId;
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
