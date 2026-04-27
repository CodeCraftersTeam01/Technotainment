<x-admin.layout header="Works">
    {{-- {{ dd(\Carbon\Carbon::parse(now())->format('Y-m-d H:i:s')) }} --}}
    <div class="flex items-center justify-end mb-5 space-x-1 md:space-x-4">
        <div class="flex items-center justify-end flex-wrap space-x-1 md:space-x-2">
            <label for="status" class="text-sm font-medium text-gray-700">Competition Status:</label>
            <div class="relative">
                <select name="status" id="status"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="" {{ request('status') == '' ? 'selected' : '' }}>All Status
                    </option>
                    <option class="text-gray-900" value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                        Active</option>
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
            <label for="status" class="text-sm font-medium text-gray-700">Competition Name:</label>
            <div class="relative">
                <select name="slug" id="competition_slug"
                    class="text-xs md:text-sm appearance-none w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm cursor-pointer hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition-all duration-200"
                    onchange="applyFilters()">
                    <option class="text-gray-900" value="" {{ request('competition_slug') == '' ? 'selected' : '' }}>All
                        Competition</option>
                    @foreach ($competitions as $competition)
                        <option class="text-gray-900" value="{{ $competition->slug }}" {{ request('competition_slug') == $competition->slug ? 'selected' : '' }}>
                            {{ $competition->competition_name }}</option>
                    @endforeach
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
    <div class="flex items-center mb-5 space-x-1 md:space-x-4">
        <a href="{{ route('work-deadlines.index') }}"
            class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
            Configure Deadline
        </a>
    </div>
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">PAYMENT</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM NAME</th>
                    @if(request()->query('competition_slug') == '7lTI2n5EDK' || request()->query('competition_slug') == '')

                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ABSTRACT</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">PROPOSAL</th>

                    @endif
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">WORK</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTION</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse ($works as $work)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($work->team->team_invoice)
                                @if($work->team->team_invoice_status == 'accept')
                                    <div class="font-medium text-green-500">{{ Str::upper($work->team->team_invoice_status) }}</div>
                                @elseif($work->team->team_invoice_status == 'decline')
                                    <div class="font-medium text-red-500">{{ Str::upper($work->team->team_invoice_status) }}</div>
                                @else
                                    <div class="font-medium text-gray-900">{{ Str::upper($work->team->team_invoice_status) }}</div>
                                @endif
                            @else
                                <div class="font-medium text-gray-900">Belum ada</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $work->team->competition->competition_name }}</td>
                        <td class="px-6 py-4">{{ $work->team->team_name }}</td>
                        @if(request()->query('competition_slug') == '7lTI2n5EDK' || request()->query('competition_slug') == '')

                            <td class="px-6 py-4">
                                @if ($work->work_abstract)
                                    <a href="{{ Storage::url($work->work_abstract) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
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
                                @if ($work->work_proposal)
                                    <a href="{{ Storage::url($work->work_proposal) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        View Document
                                    </a>
                                @else
                                    <span class="text-gray-400">No document</span>
                                @endif
                            </td>

                        @endif
                        <td class="px-6 py-4">
                            @if ($work->work)
                                @if($work->team->competition->slug == '7lTI2n5EDK')
                                    <a class="text-indigo-600 hover:text-indigo-900" href="{{ $work->work }}">View Work</a>
                                @elseif($work->team->competition->slug == 'I5njJtbe5J')
                                    <a href="{{ Storage::url($work->work) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        View Work
                                    </a>
                                @endif
                            @else
                                <span class="text-gray-400">No Work</span>
                            @endif
                        </td>
                        <td class="flex gap-2 items-center px-6 py-2">
                            <form class="inline">
                                <x-button.action icon="components.icons.info"
                                    href="{{ route('works.show', $work->work_id) }}"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Details
                                </x-button.action>
                            </form>
                            <form action="{{ route('works.destroy', $work->work_id) }}" method="POST" class="block">
                                @csrf
                                @method('DELETE')
                                <x-button.action as="button" type="submit" icon="components.icons.delete"
                                    onclick="event.preventDefault(); alertDeleteModal({{ $work->work_id }});"
                                    class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                    Delete
                                </x-button.action>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ request()->query('competition_slug') == 'I5njJtbe5J' || request()->query('competition_slug') == '' ? '7' : '5' }}"
                            class="px-6 py-4 text-center text-gray-500">No work found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Delete Event Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Work</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this work? This action cannot be undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Work
                </x-form.submit>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $works->links() }}
    </div>

    <script>
        function applyFilters() {
            const status = document.getElementById('status').value;
            const competitionSlug = document.getElementById('competition_slug').value;

            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

            // Update or remove status parameter
            if (status) {
                params.set('status', status);
            } else {
                params.delete('status');
            }

            // Update or remove competition slug parameter
            if (competitionSlug) {
                params.set('competition_slug', competitionSlug);
            } else {
                params.delete('competition_slug');
            }

            // Redirect to the filtered URL
            window.location.href = `${url.pathname}${params.size != 0 ? '?' + params.toString() : ''}`;
        }
        // Delete Event Modal Functions
        function alertDeleteModal(workId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/works/" + workId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function (event) {
            const deleteModal = document.getElementById('deleteModal');
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</x-admin.layout>