<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">

        <!-- Competition Info -->
        <div class="flex items-center mb-6 bg-indigo-50 p-4 rounded-xl gap-4">
            <div class="flex-shrink-0">
                <img class="h-28 object-cover" src="{{ Storage::url($competition->competition_logo) }}"
                    alt="{{ $competition->competition_name }}">
            </div>
            <div>
                <h2 class="text-xl font-semibold text-indigo-800 mb-2">{{ $competition->competition_name }}</h2>
                <p>{{ $competition->competition_description }}</p>
            </div>
        </div>

        <!-- Add Timeline Button -->
        <div class="mb-6 flex justify-between">
            <a href="{{ route('timelines.index', ['status' => 'active']) }}"
                class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Back
            </a>
            <button type="button" onclick="openAddModal()"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Timeline
            </button>
        </div>
        <div class="w-full">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-red-700 text-md font-semibold mt-1 bg-red-100 outline outline-1 outline-red-400 rounded-md p-3 mb-3">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <!-- Timeline Display -->
        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-2 md:left-8 top-0 bottom-0 w-0.5 bg-indigo-200"></div>

            @forelse($competition->timelines as $timeline)
                <div class="relative pl-10 md:pl-20 pb-8">
                    <!-- Timeline Dot -->
                    <div
                        class="absolute left-[0.6rem] md:left-[2.1rem] top-14 w-5 h-5 rounded-full bg-indigo-600 transform -translate-x-1/2 border-4 border-indigo-100">
                    </div>

                    <!-- Timeline Content -->
                    <div
                        class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow p-4">
                        <div class="flex flex-col md:flex-row md:justify-between items-start gap-4 md:gap-0">
                            <div class="flex items-start space-x-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $timeline->timeline_name }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($timeline->timeline_start)->format('F d, Y') }}
                                        @if ($timeline->timeline_end)
                                            - {{ \Carbon\Carbon::parse($timeline->timeline_end)->format('F d, Y') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <x-button.action as="button" type="button" icon="components.icons.edit"
                                    onclick="openEditModal({{ $timeline->timeline_id }})"
                                    class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('timelines.destroy', $timeline->timeline_id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $timeline->timeline_id }});"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3 text-gray-700">
                            <p>{{ $timeline->timeline_description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No timelines yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new timeline.</p>
                    <div class="mt-6">
                        <button type="button" onclick="openAddModal()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Timeline
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Add Timeline Modal -->
    <div id="addTimelineModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Add New Timeline</h3>
            </div>
            <form action="{{ route('timelines.store') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="competition_id" value="{{ $competition->competition_id }}">

                <!-- Timeline name -->
                <x-form.input class="mb-4" label="Timeline Name" id="timeline_name" name="timeline_name"
                    type="text" required />

                <!-- Timeline start date -->
                <x-form.input class="mb-4" label="Timeline Start Date" id="timeline" name="timeline_start"
                    type="date" required />

                <!-- Timeline end date -->
                <x-form.input class="mb-4" label="Timeline End Date" id="timeline_end" name="timeline_end"
                    type="date" />

                <!-- Timeline descriptions -->
                <x-form.textarea class="mb-4" label="Timeline Description" id="timeline_description"
                    name="timeline_description" required />

                <!-- Submit button -->
                <x-form.submit class="space-x-3 mt-6" as="button" onclick="closeAddModal()">
                    Save Timeline
                </x-form.submit>
            </form>
        </div>
    </div>

    <!-- Edit Timeline Modal -->
    <div id="editTimelineModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Edit Timeline</h3>
            </div>
            <form id="editTimelineForm" action="" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Timeline name -->
                <x-form.input class="mb-4" label="Timeline Name" id="edit_timeline_name" name="timeline_name"
                    type="text" required />

                <!-- Timeline start date -->
                <x-form.input class="mb-4" label="Timeline Start Date" id="edit_timeline_start" name="timeline_start"
                    type="date" required />

                <!-- Timeline end optional date -->
                <x-form.input class="mb-4" label="Timeline End Date" id="edit_timeline_end" name="timeline_end"
                    type="date" />

                <!-- Timeline descriptions -->
                <x-form.textarea class="mb-4" label="Timeline Description" id="edit_timeline_description"
                    name="timeline_description" required />

                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeEditModal()" class="flex justify-end space-x-3 mt-6">
                    Update Timeline
                </x-form.submit>
            </form>
        </div>
    </div>

    <!-- Delete Timeline Modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Timeline</h3>
            </div>
            <div id="deleteTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this timeline? This action cannot be undone.
                </p>
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Timeline
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        // Add Timeline Modal Functions
        function openAddModal() {
            document.getElementById('addTimelineModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addTimelineModal').classList.add('hidden');
        }

        function alertDeleteModal(timelineId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/timelines/" + timelineId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Edit Timeline Modal Functions
        function openEditModal(timelineId) {
            // Fetch timeline data via AJAX
            fetch(`/timelines/${timelineId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Populate the form
                    document.getElementById('edit_timeline_name').value = data.timeline_name;
                    document.getElementById('edit_timeline_start').value = data.timeline_start;
                    document.getElementById('edit_timeline_end').value = data.timeline_end;
                    document.getElementById('edit_timeline_description').value = data.timeline_description;

                    // Set the form action URL
                    document.getElementById('editTimelineForm').action = `/timelines/${timelineId}`;

                    // Show the modal
                    document.getElementById('editTimelineModal').classList.remove('hidden');
                })
                .catch(error => {
                    // console.error('Error fetching timeline data:', error);
                    alert('Error fetching timeline data. Please try again.');
                });
        }

        function closeEditModal() {
            document.getElementById('editTimelineModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addTimelineModal');
            const editModal = document.getElementById('editTimelineModal');
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === addModal) {
                closeAddModal();
            }

            if (event.target === editModal) {
                closeEditModal();
            }

            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</x-admin.layout>
