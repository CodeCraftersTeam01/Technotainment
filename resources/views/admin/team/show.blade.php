<x-admin.layout>
    <!-- Competition Info -->
    <div class="mb-6 bg-indigo-50 p-4 rounded-xl">
        <div>
            <h2 class="text-xl font-semibold text-indigo-800">{{ $team->competition->competition_name }}</h2>
        </div>
        <div class="mt-2">
            <p class="text-md/8">
                Team Token : <span class="text-indigo-800" id="token">{{ $team->team_token }}</span> <span id="copyButton" class="border border-indigo-800 text-indigo-800 ml-2 cursor-pointer p-1 rounded-lg hover:bg-indigo-200">Salin</span>
            </p>
        </div>
        <p id="copiedText" class="text-green-400 text-sm mt-2 hidden">Token berhasil disalin!</p>
        <div class="flex items-center justify-start my-5">
            <a href="{{ route('teams.index', ['competition_status' => 'active']) }}"
                class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Back
            </a>
            <a href="{{ route('teams.edit', $team->team_id) }}"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                Edit Team
            </a>
            @if($team->competition->slug == '7lTI2n5EDK' || $team->competition->slug == 'I5njJtbe5J')
                <a href="{{ route('works.show', $team->works[0]->work_id) }}"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    See Work
                </a>
            @endif
        </div>
        {{-- datetime --}}
        <div>
            <!-- Regist At -->
            <p class="text-sm font-medium text-gray-700">Regist At</p>
            <span class="text-gray-400">{{ $team->created_at->format('d M Y') }}</span>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
    <!-- Team detail table -->
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM LOGO</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM EMAIL</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEACM CONTACT</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM INSTANCE</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM INSTANCE NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">TEAM INVOICE</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ Storage::url($team->team_logo) }}">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-10 h-10 object-cover rounded-full" src="{{ Storage::url($team->team_logo) }}"
                                        alt="{{ $team->team_name }}">
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $team->team_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $team->team_email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $team->team_contact }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $team->team_instance }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-gray-400">{{ $team->team_instance_name ? $team->team_instance_name : '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if ($team->team_invoice)
                            <a href="{{ route('admin.documents.serve', ['path' => $team->team_invoice]) }}" target="_blank" class="text-blue-600 hover:underline">View Invoice</a>
                        @else
                            <span class="text-gray-400">No invoice</span>
                        @endif
                    </td>
            </tbody>
        </table>
    </div>

    <!-- Member team table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">MEMBER NAME</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">MEMBER IDENTITY</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">MEMBER ROLE</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($team->members as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="font-medium text-gray-900">{{ $member->member_team_id }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $member->member_team_name }}</td>
                        <td class="px-6 py-4">
                            @if ($member->member_team_identity)
                                <a href="{{ route('admin.documents.serve', ['path' => $member->member_team_identity]) }}" target="_blank" class="text-blue-600 hover:underline">View Identity</a>
                            @else
                                <span class="text-gray-400">No document</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $member->member_team_role }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-button.action as="button" type="button"
                                    onclick="openEditModal({{ $member->member_team_id }})" icon="components.icons.edit"
                                    class="bg-blue-50 text-blue-700 ring-blue-700/10 hover:bg-blue-100">
                                    Edit
                                </x-button.action>
                                <form action="{{ route('members.destroy', $member->member_team_id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.action as="button" type="submit" icon="components.icons.delete"
                                        onclick="event.preventDefault(); alertDeleteModal({{ $member->member_team_id }})"
                                        class="bg-red-50 text-red-700 ring-red-700/10 hover:bg-red-100">
                                        Delete
                                    </x-button.action>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- edit modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Edit Member Team</h3>
            </div>
            <form id="editModalMember" action="" enctype="multipart/form-data" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <input type="hidden" name="team_id" id="team_id" value="{{ $team->team_id }}">

                <!-- member name -->
                <x-form.input class="mb-4" label="Member Name" id="edit_member_team_name" name="member_team_name"
                    type="text" required />

                <!-- member identity -->
                <x-form.file class="mb-4" label="Member Identity" id="edit_member_team_identity"
                    name="member_team_identity" mode="edit" type="file"
                    accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png" />

                <!-- member role  -->
                <x-form.select label="Member Role" id="edit_member_team_role" name="member_team_role" required>
                    <option class="member-role" value="Leader">Leader</option>
                    <option class="member-role" value="Member">Member</option>
                    <option class="member-role" value="Backup">Backup</option>
                </x-form.select>

                <!-- Submit button -->
                <x-form.submit as="button" onclick="closeEditModal()" class="flex justify-end space-x-3 mt-6">
                    Update Member
                </x-form.submit>
            </form>
        </div>
    </div>

    <!-- delete modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 overflow-hidden">
            <div class="px-6 py-4 bg-indigo-600">
                <h3 class="text-lg font-medium text-white">Delete Member</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-500">Are you sure you want to delete this member? This action cannot be undone.</p>
                <div class="flex justify-end space-x-3 mt-6">
                    <x-form.submit as="button" onclick="closeDeleteModal()" mode="delete" formId="deleteForm"
                        class="flex justify-end space-x-3 mt-6">
                        Delete Member
                    </x-form.submit>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('edit_member_team_identity').addEventListener('change', function(e) {
            const fileInput = e.target;
            const fileName = document.querySelector('#file-name');

            if (fileInput.files && fileInput.files[0]) {
                fileName.textContent = fileInput.files[0].name;
            } else {
                fileName.textContent = 'No file selected';
            }
        })

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function alertDeleteModal(memberId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteForm').action = "/members/" + memberId;
        }

        function openEditModal(memberId) {
            fetch(`/members/${memberId}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data); // Debug log

                    document.getElementById('edit_member_team_name').value = data.member_team_name;
                    document.getElementById('edit_member_team_identity').value[0] = data.member_team_identity;
                    document.getElementById('edit_member_team_role').value = data.member_team_role;
                    document.querySelectorAll('.member-role').forEach(role => {
                        console.log(role.value, data.member_team_role)
                        if (role.value == data.member_team_role) {
                            role.selected = true;
                        }
                    })

                    document.getElementById('editModalMember').action = `/members/${memberId}`;

                    document.getElementById('editModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching member data:', error);
                    alert('Failed to load member data. Please try again.');
                });
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === deleteModal) {
                closeDeleteModal();
            }

            if (event.target === editModal) {
                closeEditModal();
            }
        }

        // copy button
        const copyButton = document.getElementById('copyButton');
        copyButton.addEventListener('click', copyToken);
        function copyToken() {
            const tokenText = document.getElementById('token').innerText;
            navigator.clipboard.writeText(tokenText).then(() => {
                const copiedText = document.getElementById('copiedText');
                copiedText.classList.remove('hidden');
                setTimeout(() => copiedText.classList.add('hidden'), 2000);
            });
        }
    </script>
</x-admin.layout>
