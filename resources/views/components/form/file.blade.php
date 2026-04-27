@props([
    'id' => null,
    'name' => null,
    'label' => 'Label Input',
    'type' => 'file',
    'class' => null,
    'mode' => 'add',
    'fileName' => 'file-name',
    'preview' => 'logo-preview',
    'fileRequirement' => '*Image'
])

<div class="{{ $class }}">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    {{-- current preview --}}
    {{ $slot }}
    <div class="mt-1 flex items-center">
        <label
            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
            <span class="block px-4 py-2 border border-gray-300 rounded-md shadow-sm">Choose
                file</span>
            <input id="{{ $id }}" name="{{ $name }}" type="file" class="sr-only"
                {{ $attributes }}>
        </label>
        <span class="ml-3 text-sm text-gray-500 file-name-{{ $mode }}" id="{{ $fileName }}">No file selected</span>
    </div>
    <div class="mt-2">
        <img id="{{ $preview }}" class="hidden h-32 w-auto object-contain border rounded-md logo-preview-{{ $mode }}" alt="Logo preview">
    </div>
    <p class="text-sm text-gray-500 italic">{{ $fileRequirement }}</p>
    @if ($mode == 'edit')
        <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current image/file</p>
    @endif
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
