@props([
    'id' => null,
    'name' => null,
    'label' => 'Label Input',
    'type' => 'text',
    'default' => null,
    'class' => null,
])

<div class="{{ $class }}">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        value="{{ old($name, $default ?? '') }}"
        class="border mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        {{ $attributes }}>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
