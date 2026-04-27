<x-admin.layout header="Achievement">
    <div class="flex items-center justify-end mb-5 space-x-1 md:space-x-4">
        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Competition Status:</label>
            <div class="relative">
                <select name="status" id="status"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Status</option>
                    <option class="text-gray-900" value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
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

        <div class="flex items-center space-x-2">
            <label for="type" class="text-xs md:text-sm font-medium text-gray-700">Type:</label>
            <div class="relative">
                <select name="type" id="type"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="">All Types</option>
                    <option class="text-gray-900" value="E-Sports"
                        {{ request('type') == 'E-Sports' ? 'selected' : '' }}>E-Sports</option>
                    <option class="text-gray-900" value="Non-E-Sports"
                        {{ request('type') == 'Non-E-Sports' ? 'selected' : '' }}>Non-E-Sports</option>
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
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACHIEVEMENT COUNT</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($competitions as $competition)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">{{ $competition->competition_id }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <img class="h-28 w-28 md:w-fit object-cover md:object-contain"
                                src="{{ Storage::url($competition->competition_logo) }}" alt="logo">
                        </td>
                        <td class="px-6 py-4">{{ $competition->competition_name }}</td>
                        <td class="px-6 py-4">{{ $competition->achievements ? count($competition->achievements) : 'No Achievement' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action icon="components.icons.info"
                                    href="{{ route('achievements.show', $competition->competition_id) }}"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Details
                                </x-button.action>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No achievement found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $competitions->links() }}
    </div>

    <script>
        function applyFilters() {
            const status = document.getElementById('status').value;
            const type = document.getElementById('type').value;

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

            // Redirect to the filtered URL
            window.location.href = `${url.pathname}?${params.toString()}`;
        }
    </script>
</x-admin.layout>
