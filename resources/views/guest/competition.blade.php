<x-layout>
    <x-web.section.navbar :event="$competition->event" />
    <div class="relative px-4 bg-gradient-to-br from-primary to-secondary min-h-screen py-16">
        <div class="relative z-10 container mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-extrabold text-quaternary mb-4 tracking-tight drop-shadow-lg">
                    {{ $competition->competition_name }}
                </h1>
                <div
                    class="w-40 h-2 bg-gradient-to-r from-secondary via-tertiary to-quaternary mx-auto rounded-full animate-pulse">
                </div>
                <p class="mt-6 text-white/80 text-lg max-w-3xl mx-auto">{{ $competition->competition_description }}</p>
            </div>

            <!-- Content Tabs -->
            <div class="bg-white/[0.05] backdrop-blur-xl rounded-3xl border border-white/[0.15] p-8 shadow-2xl">
                <!-- Tab Navigation -->
                <div class="flex justify-center mb-8">
                    <div class="inline-flex rounded-full bg-white/10 p-0 md:p-1.5 shadow-inner text-quaternary">
                        <button onclick="switchDetailTab('overview')" id="overviewTab"
                            class="tab-btn active px-4 md:px-6 py-3 rounded-full text-sm sm:text-base font-medium transition-all duration-200">Overview</button>
                        <button onclick="switchDetailTab('guidebook')" id="guidebookTab"
                            class="tab-btn px-4 md:px-6 py-3 rounded-full text-sm sm:text-base font-medium transition-all duration-200">Guidebook</button>
                        <button onclick="switchDetailTab('timeline')" id="timelineTab"
                            class="tab-btn px-4 md:px-6 py-3 rounded-full text-sm sm:text-base font-medium transition-all duration-200">Timeline</button>
                        <button onclick="switchDetailTab('prizes')" id="prizesTab"
                            class="tab-btn px-4 md:px-6 py-3 rounded-full text-sm sm:text-base font-medium transition-all duration-200">Prizes</button>
                    </div>
                </div>

                <!-- Tab Contents -->
                <x-web.section.contentCompetition :competition="$competition" />
            </div>

            <!-- Register Button -->
            @if($competition->competition_status == 'active' && \Carbon\Carbon::parse(now())->format('Y-m-d') <= $competition->competition_end_date)
                <div class="text-center mt-12">
                    <a href="/registration/{{ $competition->slug }}"
                        class="inline-flex items-center px-12 py-4 bg-gradient-to-r from-tertiary to-quaternary rounded-full text-xl font-bold hover:opacity-90 transition-all duration-300 transform hover:scale-105 hover:shadow-xl group">
                        Register Now
                        <x-icons.arrowRight width="20" height="20"
                            class="ml-2 group-hover:translate-x-1 transition-transform duration-300" />
                    </a>
                    <p class="mt-4 text-white/70">Tersedia slot terbatas. pendaftaran ditutup pada
                        {{ \Carbon\Carbon::parse($competition->competition_end_date)->format('d F Y') }}</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function switchDetailTab(tab) {
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            document.getElementById(`${tab}Content`).classList.remove('hidden');
            document.getElementById(`${tab}Content`).classList.add('active');
            document.getElementById(`${tab}Tab`).classList.add('active');
        }
    </script>
</x-layout>
