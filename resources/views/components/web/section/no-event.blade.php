<div id="home" class="relative min-h-screen bg-gradient-to-br from-primary to-secondary overflow-hidden">
    <x-web.section.background />
    <div
        class="relative container mx-auto px-4 py-16 flex flex-col items-center justify-center min-h-screen text-center">
        <div class="mb-8">
            <h2 class="text-quaternary font-semibold text-xl mb-2">UKMFT-ITC Present</h2>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 tracking-tight">
                {{ Str::upper('No Event') }}<span class="text-tertiary"> {{ date('Y') }}</span>
            </h1>
            <p class="text-quinary text-xl md:text-2xl max-w-2xl mx-auto">
                
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 w-full max-w-4xl">
            <div class="bg-secondary/30 backdrop-blur-lg rounded-xl p-6 text-quinary flex flex-col items-center">
                <x-icons.date width="32" height="32" />
                <h3 class="font-bold mb-2">Event Date</h3>
                <p>Coming Soon</p>
            </div>
            <div class="bg-secondary/30 backdrop-blur-lg rounded-xl p-6 text-quinary flex flex-col items-center">
                <x-icons.location width="32" height="32" />
                <h3 class="font-bold mb-2">Location</h3>
                <p>Universitas Trunojoyo Madura</p>
            </div>
            <div class="bg-secondary/30 backdrop-blur-lg rounded-xl p-6 text-quinary flex flex-col items-center">
                <x-icons.trophy width="32" height="32" />
                <h3 class="font-bold mb-2">Total Prize</h3>
                <p>1 Triliun</p>
            </div>
        </div>
    </div>
</div>
