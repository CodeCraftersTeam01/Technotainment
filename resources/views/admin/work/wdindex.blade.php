<x-admin.layout header="Works">
    @if($wds)
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr class="overflow-y-hidden">
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">NAME</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">START DATE</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">END DATE</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">COMPETITION NAME</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @foreach($wds as $wd)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ $wd->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($wd->start_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($wd->end_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $wd->competitions->competition_name }}
                            </td>
                            <td class="px-6 py-4">
                                <x-button.action icon="components.icons.edit"
                                    href="{{ route('work-deadlines.edit', $wd->workdeadline_id) }}"
                                    class="bg-indigo-50 text-indigo-700 ring-indigo-700/10 hover:bg-indigo-100">
                                    Edit
                                </x-button.action>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="">Tidak ditemukan</p>
    @endif
</x-admin.layout>
