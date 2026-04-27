<x-admin.layout header="Announcements">
    <div class="flex items-center justify-end mb-5 space-x-1 md:space-x-4">
        <div class="flex items-center space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Event Status:</label>
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
    </div>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">EVENT STATUS</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($events as $event)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">{{ $event->event_id }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <img class="h-28 w-28 md:w-fit object-cover md:object-contain"
                                src="{{ Storage::url($event->event_logo) }}" alt="logo">
                        </td>
                        <td class="px-6 py-4">{{ $event->event_name }}</td>
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
                                <x-button.action icon="components.icons.info"
                                    href="{{ route('announcements.show', $event->event_id) }}"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Details
                                </x-button.action>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No announcement found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $events->links() }}
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
            window.location.href = `${url.pathname}${params.size != 0 ? '?'+params.toString() : ''}`;
        }
    </script>
</x-admin.layout>
