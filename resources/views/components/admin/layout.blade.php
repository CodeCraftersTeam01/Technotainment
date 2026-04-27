@props([
    'header' => null,
])

<x-layout>
    @include('sweetalert::alert')
    <section class="flex bg-white">
        <x-admin.sidebar />
        <main class="w-full md:w-[calc(100%-80px)] min-h-100 bg-[#f0f0ff] md:rounded-l-3xl md:p-5 flex flex-col">
            <x-admin.header :header="$header" />
            <div class="w-full bg-white shadow-lg h-full md:rounded-3xl p-5">
                {{ $slot }}
            </div>
        </main>
    </section>
</x-layout>
