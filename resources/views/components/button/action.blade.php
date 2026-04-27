@props([
    'as' => 'a',
    'icon' => null,
    'href' => null,
    'class' => null,
    'type' => 'button',
])

<{{ $as }} @if ($as == 'a') href="{{ $href }}" @endif
    @if ($as == 'button') type="{{ $type }}" @endif
    class="inline-flex items-center rounded p-2 text-xs font-medium ring-1 ring-inset gap-2 {{ $class }}"
    {{ $attributes }}>
    @if ($icon)
        @include($icon)
    @endif
    {{ $slot }}
    </{{ $as }}>
