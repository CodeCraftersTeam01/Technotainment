<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <!-- Competition Info -->
        <div class="flex items-center mb-6 bg-indigo-50 p-4 rounded-xl gap-4">
            <div class="flex-shrink-0">
                <img class="h-28 object-cover" src="{{ Storage::url($competition->competition_logo) }}" alt="{{ $competition->competition_name }}">
            </div>
            <div>
                <h2 class="text-xl font-semibold text-indigo-800 mb-2">{{ $competition->competition_name }}</h2>
                <div class="prose">
                    {{ $competition->competition_description }}
                </div>
            </div>
        </div>

        <!-- Add Achievement Button -->
        <div class="mb-6 flex justify-between">
            <a href="{{ route('achievements.index', ['status' => 'active']) }}"
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
                Add Achievement
            </button>
        </div>

        <div class="w-full">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-red-700 text-md font-semibold mt-1 bg-red-100 outline outline-1 outline-red-400 rounded-md p-3 mb-3">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
            <!-- Achievements table -->
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACHIEVEMENT NAME</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACHIEVEMENT PRICE</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @forelse($competition->achievements as $achievement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900">{{ $achievement->achievement_id }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $achievement->achievement_name }}</td>
                            <td class="px-6 py-4">Rp{{ number_format($achievement->achievement_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-button.action as="button" type="button" icon="components.icons.edit"
                                        onclick="openEditModal({{ $achievement->achievement_id }})"
                                        class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                        Edit
                                    </x-button.action>
                                    <form action="{{ route('achievements.destroy', $achievement->achievement_id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button.action as="button" type="submit"
                                            onclick="event.preventDefault(); alertDeleteModal({{ $achievement->achievement_id }});"
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No achievements found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination if needed -->
        @if (isset($achievements) && $achievements->hasPages())
            <div class="mt-6">
                {{ $achievements->links() }}
            </div>
        @endif
    </div>

    <!-- Add Achievement Modal -->
    <div id="addAchievementModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Add New Achievement</h3>
            </div>
            <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf

                <input type="hidden" name="competition_id" value="{{ $competition->competition_id }}">

                <!-- Achievement name -->
                <x-form.input class="mb-4" label="Achievement Name" id="achievement_name" name="achievement_name"
                    type="text" required />

                <!-- Achievement price -->
                <x-form.input class="mb-4" label="Achievement Price" id="achievement_price" name="achievement_price"
                    type="number" required />
                
                <!-- Achievement descriptio -->
                <x-form.textarea class="mb-4" label="Achievement Description" id="achievement_description"
                    name="achievement_description" required />

                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeAddModal()" class="flex justify-end space-x-3 mt-6">
                    Save Achievement
                </x-form.submit>
            </form>
        </div>
    </div>

    <!-- Edit Achievement Modal -->
    @if (isset($achievement))
        <div id="editAchievementModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
                <div class="px-6 py-4 bg-indigo-600">
                    <h3 class="text-lg font-medium text-white">Edit Achievement</h3>
                </div>
                <form id="editAchievementForm" action="" method="POST" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Achievement Name -->
                    <x-form.input class="mb-4" label="Achievement Name" id="edit_achievement_name"
                        name="achievement_name" type="text" required />

                    <!-- Achievement Price -->
                    <x-form.input class="mb-4" label="Achievement Price" id="edit_achievement_price" name="achievement_price"
                        type="number" required />
                    
                    <!-- Achievement Description -->
                    <x-form.textarea class="mb-4" label="Achievement Description" id="edit_achievement_description"
                        name="achievement_description" required />

                    <!-- Submit button -->
                    <x-form.submit as="button" onclick="closeEditModal()" class="flex justify-end space-x-3 mt-6">
                        Update Achievement
                    </x-form.submit>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Achievement Modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Achievement</h3>
            </div>
            <div id="deleteTimelineForm" class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this achievement? This action cannot be
                    undone.</p>
                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                    class="flex justify-end space-x-3 mt-6">
                    Delete Achievement
                </x-form.submit>
            </div>
        </div>
    </div>

    <script>
        // Add Achievement Modal Functions
        function openAddModal() {
            document.getElementById('addAchievementModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addAchievementModal').classList.add('hidden');
        }

        function alertDeleteModal(achievementId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/achievements/" + achievementId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Edit Achievement Modal Functions
        function openEditModal(achievementId) {
            // Fetch achievement data via AJAX
            fetch(`/achievements/${achievementId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Populate the form
                    document.getElementById('edit_achievement_name').value = data.achievement_name;
                    document.getElementById('edit_achievement_price').value = data.achievement_price;
                    document.getElementById('edit_achievement_description').value = data.achievement_description;

                    // Set the current logo
                    // document.getElementById('current-logo').src = `/storage/${data.achievement_logo}`;

                    // Set the form action URL
                    document.getElementById('editAchievementForm').action = `/achievements/${achievementId}`;

                    // Show the modal
                    document.getElementById('editAchievementModal').classList.remove('hidden');
                })
                .catch(error => {
                    // console.error('Error fetching achievement data:', error);
                    alert('Failed to load achievement data. Please try again.');
                });
        }

        function closeEditModal() {
            document.getElementById('editAchievementModal').classList.add('hidden');
        }

        // Preview image before upload - Add form
        // document.getElementById('achievement_logo').addEventListener('change', function(e) {
        //     const fileInput = e.target;
        //     const fileName = document.querySelector('.file-name-add');
        //     const preview = document.querySelector('.logo-preview-add');

        //     // console.log(fileName);
        //     // console.log(preview);

        //     if (fileInput.files && fileInput.files[0]) {
        //         fileName.textContent = fileInput.files[0].name;

        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             preview.src = e.target.result;
        //             preview.classList.remove('hidden');
        //         }
        //         reader.readAsDataURL(fileInput.files[0]);
        //     } else {
        //         fileName.textContent = 'No file selected';
        //         preview.classList.add('hidden');
        //     }
        // });

        // Preview image before upload - Edit form
        // document.getElementById('edit_achievement_logo').addEventListener('change', function(e) {
        //     const fileInput = e.target;
        //     const fileName = document.querySelector('.file-name-edit');
        //     const preview = document.querySelector('.logo-preview-edit');

        //     console.log(fileName);
        //     console.log(preview);

        //     if (fileInput.files && fileInput.files[0]) {
        //         fileName.textContent = fileInput.files[0].name;

        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             preview.src = e.target.result;
        //             preview.classList.remove('hidden');
        //         }
        //         reader.readAsDataURL(fileInput.files[0]);
        //     } else {
        //         fileName.textContent = 'No file selected';
        //         preview.classList.add('hidden');
        //     }
        // });

        // Close modals when clicking outside
        window.onclick = function(event) {
            const addModal = document.getElementById('addAchievementModal');
            const editModal = document.getElementById('editAchievementModal');
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
