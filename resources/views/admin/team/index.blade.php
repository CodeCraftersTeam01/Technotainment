<x-admin.layout header="Teams">
    <div class="flex items-center justify-between md:justify-end mb-5 flex-wrap space-y-2 space-x-1 md:space-x-4">
        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Competition Status:</label>
            <div class="relative">
                <select name="competition_status" id="competitionStatus"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Status</option>
                    <option class="text-gray-900" value="active" {{ request('competition_status') == 'active' ? 'selected' : '' }}>
                        Active</option>
                    <option class="text-gray-900" value="nonactive"
                        {{ request('status') == 'nonactive' ? 'selected' : '' }}>Nonactive</option>
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
            <label for="status" class="text-xs md:text-sm font-medium text-gray-700">Payment Status:</label>
            <div class="relative">
                <select name="status" id="status"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-black" value="">All Status</option>
                    <option class="text-black" value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option class="text-black" value="decline" {{ request('status') == 'decline' ? 'selected' : '' }}>Decline</option>
                    <option class="text-black" value="accept" {{ request('status') == 'accept' ? 'selected' : '' }}>Accept</option>
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
            <label for="type" class="text-xs md:text-sm font-medium text-gray-700">Type:</label>
            <div class="relative">
                <select name="type" id="type"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-black" value="">All Types</option>
                    <option class="text-black" value="E-Sports" {{ request('type') == 'E-Sports' ? 'selected' : '' }}>E-Sports</option>
                    <option class="text-black" value="Non-E-Sports" {{ request('type') == 'Non-E-Sports' ? 'selected' : '' }}>Non-E-Sports</option>
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
    </div>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">PAYMENT STATUS</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($teams as $team)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($team->team_invoice)
                                    @if($team->team_invoice_status == 'accept')
                                        <div class="font-medium text-green-500">{{ Str::upper($team->team_invoice_status) }}</div>
                                    @elseif($team->team_invoice_status == 'decline')
                                        <div class="font-medium text-red-500">{{ Str::upper($team->team_invoice_status) }}</div>
                                    @else
                                        <div class="font-medium text-gray-900">{{ Str::upper($team->team_invoice_status) }}</div>
                                    @endif
                                @else
                                    <div class="font-medium text-gray-900">Belum ada</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $team->competition->competition_name }}</td>
                        <td class="px-6 py-4">{{ $team->team_name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action icon="components.icons.info"
                                    href="{{ route('teams.show', $team->team_id) }}"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Details
                                </x-button.action>
                                <x-button.action icon="components.icons.edit"
                                    href="{{ route('teams.edit', $team->team_id) }}"
                                    class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('teams.destroy', $team->team_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this team?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $team->team_id }})"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100 p-3">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No team found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $teams->links() }}
    </div>

    <!-- Delete Team Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Team</h3>
            </div>
            <div id="deleteTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this team? This action cannot be
                    undone.</p>
                <form id="deleteForm" class="flex justify-end space-x-3 mt-6" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Delete Team
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function hello() {
            console.log('hello')
        }
        function alertDeleteModal(teamId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/teams/" + teamId;
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
            const status = document.getElementById('status').value;
            const type = document.getElementById('type').value;
            const competitionStatus = document.getElementById('competitionStatus').value;

            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

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

            // Update or remove competition status parameter
            if (competitionStatus) {
                params.set('competition_status', competitionStatus);
            } else {
                params.delete('competition_status');
            }

            // Redirect to the filtered URL
            window.location.href = `${url.pathname}${params.size != 0 ? '?'+params.toString() : ''}`;
        }
    </script>
</x-admin.layout>
