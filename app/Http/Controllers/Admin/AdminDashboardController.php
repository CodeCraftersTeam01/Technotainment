<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Timeline;
use App\Models\Competition;
use App\Models\MediaPartner;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get counts from your database

        $event = Event::all();
        $competition = Competition::with('event');
        $team = Team::with('competition');
        $sponsor = Sponsor::with('event');
        $mediaPartner = MediaPartner::with('event');
        $timeline = Timeline::with('competition');

        $eventCount = $event->count();
        $competitionCount = $competition->count();
        $teamCount = $team->count();
        $sponsorCount = $sponsor->count();
        $mediaPartnerCount = $mediaPartner->count();
        $timelineCount = $timeline->count();

        // Calculate total for percentage calculation
        $total = $eventCount + $competitionCount + $teamCount +
            $sponsorCount + $mediaPartnerCount + $timelineCount;

        // Calculate percentages (avoid division by zero)
        $eventPercentage = $total > 0 ? round(($eventCount / $total) * 100) : 0;
        $competitionPercentage = $total > 0 ? round(($competitionCount / $total) * 100) : 0;
        $teamPercentage = $total > 0 ? round(($teamCount / $total) * 100) : 0;
        $sponsorPercentage = $total > 0 ? round(($sponsorCount / $total) * 100) : 0;
        $mediaPartnerPercentage = $total > 0 ? round(($mediaPartnerCount / $total) * 100) : 0;
        $timelinePercentage = $total > 0 ? round(($timelineCount / $total) * 100) : 0;

        // Create menu array with percentages and counts
        $menu = [
            [
                'icon' => 'components.icons.dashboard',
                'name' => 'Dashboard',
                'link' => route('dashboard'),
            ],
            [
                'icon' => 'components.icons.announcement',
                'name' => 'Announcements',
                'link' => route('announcements.index'),
            ],
            [
                'icon' => 'components.icons.event',
                'name' => 'Events',
                'link' => route('events.index'),
            ],
            [
                'icon' => 'components.icons.competition',
                'name' => 'Competitions',
                'link' => route('competitions.index'),
            ],
            [
                'icon' => 'components.icons.achievement',
                'name' => 'Achievements',
                'link' => route('achievements.index'),
            ],
            [
                'icon' => 'components.icons.sponsor',
                'name' => 'Sponsors',
                'link' => route('sponsors.index'),
            ],
            [
                'icon' => 'components.icons.medpart',
                'name' => 'Media Partners',
                'link' => route('media-partners.index'),
            ],
            [
                'icon' => 'components.icons.timeline',
                'name' => 'Timelines',
                'link' => route('timelines.index'),
            ],
            [
                'icon' => 'components.icons.team',
                'name' => 'teams',
                'link' => route('teams.index'),
            ],
            [
                'icon' => 'components.icons.work',
                'name' => 'Works',
                'link' => route('works.index'),
            ],
        ];

        // Create stats array for the dashboard
        $stats = [
            [
                'icon' => 'components.icons.event',
                'title' => 'Event',
                'value' => $eventCount,
                'trend' => ($eventPercentage > 0 ? '+' : '') . $eventPercentage . '%',
                'trend_up' => $eventPercentage >= 0,
                'colors' => [
                    'bg-50' => 'bg-blue-50',
                    'bg-100' => 'bg-blue-100',
                    'text-600' => 'text-blue-600',
                    'border-100' => 'border-blue-100',
                    'bg-up' => 'bg-blue-500',
                    'bg-down' => 'bg-blue-300',
                ],
                'percentage' => $eventPercentage,
            ],
            [
                'icon' => 'components.icons.competition',
                'title' => 'Competition',
                'value' => $competitionCount,
                'trend' => ($competitionPercentage > 0 ? '+' : '') . $competitionPercentage . '%',
                'trend_up' => $competitionPercentage >= 0,
                'colors' => [
                    'bg-50' => 'bg-purple-50',
                    'bg-100' => 'bg-purple-100',
                    'text-600' => 'text-purple-600',
                    'border-100' => 'border-purple-100',
                    'bg-up' => 'bg-purple-500',
                    'bg-down' => 'bg-purple-300',
                ],
                'percentage' => $competitionPercentage,
            ],
            [
                'icon' => 'components.icons.team',
                'title' => 'Team',
                'value' => $teamCount,
                'trend' => ($teamPercentage > 0 ? '+' : '') . $teamPercentage . '%',
                'trend_up' => $teamPercentage >= 0,
                'colors' => [
                    'bg-50' => 'bg-green-50',
                    'bg-100' => 'bg-green-100',
                    'text-600' => 'text-green-600',
                    'border-100' => 'border-green-100',
                    'bg-up' => 'bg-green-500',
                    'bg-down' => 'bg-green-300',
                ],
                'percentage' => $teamPercentage,
            ],
            [
                'icon' => 'components.icons.sponsor',
                'title' => 'Sponsor',
                'value' => $sponsorCount,
                'trend' => ($sponsorPercentage > 0 ? '+' : '') . $sponsorPercentage . '%',
                'trend_up' => $sponsorPercentage >= 0,
                'colors' => [
                    'bg-50' => 'bg-red-50',
                    'bg-100' => 'bg-red-100',
                    'text-600' => 'text-red-600',
                    'border-100' => 'border-red-100',
                    'bg-up' => 'bg-red-500',
                    'bg-down' => 'bg-red-300',
                ],
                'percentage' => $sponsorPercentage,
            ],
            [
                'icon' => 'components.icons.medpart',
                'title' => 'Media Partner',
                'value' => $mediaPartnerCount,
                'trend' => ($mediaPartnerPercentage > 0 ? '+' : '') . $mediaPartnerPercentage . '%',
                'trend_up' => $mediaPartnerPercentage >= 0,
                'colors' => [
                    'bg-50' => 'bg-yellow-50',
                    'bg-100' => 'bg-yellow-100',
                    'text-600' => 'text-yellow-600',
                    'border-100' => 'border-yellow-100',
                    'bg-up' => 'bg-yellow-500',
                    'bg-down' => 'bg-yellow-300',
                ],
                'percentage' => $mediaPartnerPercentage,
            ],
        ];

        $activeTemp = [
            $eventActive = $event->where('event_status', 'active'),
            $competitionActive = $competition
                ->where('competition_status', 'active'),
            $teamActive = $team
                ->whereHas('competition', fn($query) => $query->where('competition_status', 'active')),
            $sponsorActive = $sponsor
                ->whereHas('event', fn($query) => $query->where('event_status', 'active')),
            $mediaPartnerActive = $mediaPartner
                ->whereHas('event', fn($query) => $query->where('event_status', 'active')),
        ];

        // dd($teamActive);
        
        $statsActive = [];

        for($i = 0; $i < count($stats); $i++) {
            $statsActive[] = $stats[$i];
            $statsActive[$i]['value'] = $activeTemp[$i]->count();
        }

        return view('admin.dashboard', compact(['menu', 'stats', 'statsActive']));
    }
}
