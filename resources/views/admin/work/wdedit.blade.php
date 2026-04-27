<x-admin.layout header="Works">

    <form id="updateWDForm" action="{{ route('work-deadlines.update', $wd->workdeadline_id) }}" method="POST"
        class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Work Deadline Name -->
        <x-form.input label="Work Deadline Name (Jangan diubah ya)" id="name" name="name" type="text" :default="$wd->name" disabled />

        <!-- Work Deadline Start Date -->
        <x-form.input label="Work Deadline Start Date" id="start_date" name="start_date" type="date" :default="$wd->start_date" required />

        <!-- Work Deadline End Date -->
        <x-form.input label="Work Deadline End Date" id="end_date" name="end_date" type="date" :default="$wd->end_date" required />

        <!-- Submit Button -->
        <div class="flex justify-end">
            <a href="{{ route('work-deadlines.index') }}"
                class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Work Deadline
            </button>
        </div>
    </form>

</x-admin.layout>
