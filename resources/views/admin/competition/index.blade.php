<x-admin.layout header="Competitions">
    <div class="flex items-center justify-between md:justify-end flex-wrap mb-5 space-x-1 space-y-2 md:space-x-4">

        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="event_status" class="text-sm font-medium text-gray-700">Event Status:</label>
            <div class="relative">
                <select name="event_status" id="event_status"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Status</option>
                    <option class="text-gray-900" value="active" {{ request('event_status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option class="text-gray-900" value="nonactive" {{ request('event_status') == 'nonactive' ? 'selected' : '' }}>Nonactive</option>
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

        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Status:</label>
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

        <div class="flex items-center space-x-2 md:space-x-2">
            <label for="type" class="text-xs md:text-sm font-medium text-gray-700">Type:</label>
            <div class="relative">
                <select name="type" id="type"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Types</option>
                    <option class="text-gray-900" value="E-Sports" {{ request('type') == 'E-Sports' ? 'selected' : '' }}>E-Sports</option>
                    <option class="text-gray-900" value="Non-E-Sports" {{ request('type') == 'Non-E-Sports' ? 'selected' : '' }}>Non-E-Sports</option>
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

        <a href="{{ route('competitions.create') }}"
            class="text-xs md:text-sm bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 pr-4 pl-2 rounded-lg shadow-sm transition-all duration-200 flex items-center">
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
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">SLUG</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION TYPE</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION GUIDE BOOK</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">VIEW TEMPLATE</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION STATUS</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($competitions as $competition)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">{{ $competition->slug }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <img class="h-28 w-28 md:w-fit object-cover md:object-contain"
                                src="{{ Storage::url($competition->competition_logo) }}" alt="logo">
                        </td>
                        <td class="px-6 py-4">{{ $competition->competition_name }}</td>
                        <td class="px-6 py-4">{{ ucfirst($competition->competition_type) }}</td>
                        <td class="px-6 py-4">
                            @if ($competition->competition_guide_book)
                                <a href="{{ Storage::url($competition->competition_guide_book) }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    View Document
                                </a>
                            @else
                                <span class="text-gray-400">No document</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                                {{ ucfirst($competition->competition_view_template) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full {{ $competition->competition_status === 'active' ? 'bg-green-50' : 'bg-red-50' }} px-2 py-1 text-xs font-semibold {{ $competition->competition_status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                <span
                                    class="h-1.5 w-1.5 rounded-full {{ $competition->competition_status === 'active' ? 'bg-green-600' : 'bg-red-600' }}">
                                </span>
                                {{ ucfirst($competition->competition_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action icon="components.icons.edit"
                                    href="{{ route('competitions.edit', $competition->competition_id) }}"
                                    class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('competitions.destroy', $competition->competition_id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $competition->competition_id }});"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No competition found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $competitions->appends(request()->query())->links() }}
    </div>

    <!-- Delete Competition Modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Competition</h3>
            </div>
            <div id="editTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this event? This action cannot be undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Competition
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        // Delete Competition Modal Functions
        function alertDeleteModal(competitionId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/competitions/" + competitionId;
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

        function applyFilters() {
            const eventStatus = document.getElementById('event_status').value;
            const status = document.getElementById('status').value;
            const type = document.getElementById('type').value;

            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

            // Update or remove event status parameter
            if (eventStatus) {
                params.set('event_status', eventStatus);
            } else {
                params.delete('event_status');
            }

            // Update or remove status parameter
            if (status) {
                params.set('status', status);
            } else {
                params.delete('status');
            }

            // Update or remove type parameter
            if (type) {
                params.set('type', type);
            } else {
                params.delete('type');
            }

            // Redirect to the filtered URL
            window.location.href = `${url.pathname}${params.size != 0 ? '?'+params.toString() : ''}`;
        }
    </script>

    <style>
        /* Custom styles for select dropdowns */
        select option {
            background-color: white;
            color: #1e3a8a;
            padding: 8px;
        }

        select:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
    </style>
</x-admin.layout>
