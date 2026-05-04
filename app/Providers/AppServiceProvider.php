<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (str_contains(config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        if (!app()->runningInConsole()) {
            try {
                $event = \Illuminate\Support\Facades\Cache::remember('active_event_header', 3600, function () {
                    return Event::where('event_status', 'active')->first();
                });
                View::share('eventTitle', $event ? $event->event_name . ' - ' . $event->event_year : 'Coming Soon');
                View::share('eventLogo', $event ? ($event->event_logo ?? '') : '');
            } catch (\Exception $e) {
                View::share('eventTitle', 'Coming Soon');
                View::share('eventLogo', '');
            }
        }
    }
}
