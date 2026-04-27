<x-layout>
    <x-web.section.navbar :event="$event" />
    <x-web.section.hero :mediaPartners="$mediaPartners" :event="$event" :sponsors="$sponsors" />
    @if ($event)
    <x-web.section.about :event="$event" />
    <x-web.section.competition :esports="$esports" :nonesports="$nonesports" />
    <x-web.section.announcement :announcement="$announcement" />
    <x-web.section.mediaPartner :mediaPartners="$mediaPartners" :sponsors="$sponsors" :event="$event" />
    @endif
    <x-web.section.footer :event="$event" />
</x-layout>
