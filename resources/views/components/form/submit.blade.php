@props([
    'as' => 'a',
    'redirect' => '',
    'class' => '',
    'mode' => 'edit',
    'formId' => null,
    'method' => 'DELETE',
])

<{{ $mode == 'delete' ? 'form' : 'div' }} class="flex justify-end {{ $class }}"
    @if ($mode == 'delete') id="{{ $formId }}"
    method="POST" action="" @endif>
    @if ($mode == 'delete')
        @csrf
        @method($method)
    @endif
    <{{ $as }} @if ($as == 'a') href="{{ $redirect }}" @else type="button" @endif
        class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2"
        {{ $attributes }}>
        Cancel
        </{{ $as }}>
        <button type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ $slot }}
        </button>
        </{{ $mode == 'delete' ? 'form' : 'div' }}>
