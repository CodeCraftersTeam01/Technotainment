@props(['competition'])

<div class="bg-gradient-to-r from-blue-secondary to-blue-tertiary py-8 px-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-blue-primary/20 rounded-full blur-2xl">
    </div>
    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-24 h-24 bg-blue-quaternary/20 rounded-full blur-xl">
    </div>

    <div class="relative z-10 flex items-center">
        <div class="mr-6 bg-white/10 p-3 rounded-xl backdrop-blur-sm">
            <div class="w-16 h-16 bg-blue-quinary rounded-lg flex items-center justify-center overflow-hidden">
                <img class="w-16 h-16 object-cover" src="{{ Storage::url($competition->competition_logo) }}" alt="{{ $competition->competition_name }}">
            </div>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-quaternary">{{ $competition->competition_name }}</h1>
            <p class="text-blue-quaternary mt-1 opacity-90">Silakan lengkapi formulir pendaftaran di bawah
                ini</p>
        </div>
    </div>
</div>
