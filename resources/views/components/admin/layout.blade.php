@props([
    'header' => null,
])

<x-layout theme="bg-white admin-theme">
    @vite(['resources/js/admin.js'])
    @include('sweetalert::alert')
    <section class="flex bg-white min-h-screen">
        <x-admin.sidebar />
        <main class="flex-1 min-h-screen bg-gray-50/50 md:rounded-tl-[2.5rem] overflow-hidden border-l border-t border-gray-100 flex flex-col">
            <x-admin.header :header="$header" />
            <div class="p-5 md:p-8 flex-1 overflow-auto">
                {{ $slot }}
            </div>
        </main>
    </section>
</x-layout>
