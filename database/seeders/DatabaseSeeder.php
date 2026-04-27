<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Work;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Timeline;
use App\Models\MemberTeam;
use App\Models\Achievement;
use App\Models\Competition;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Models\MediaPartner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // user
        // bph
        User::factory()->create([
            'name' => 'Admin Techno',
            'email' => 'bphtechnogeminggas@gmail.com',
            'user_photo' => 'bph.png',
            'email_verified_at' => now(),
            'password' => Hash::make('whfuansfcnskcugHKJABC8221e2'),
            'remember_token' => Str::random(10),
        ]);
        // triple
        User::factory()->create([
            'name' => 'Triple Techno',
            'email' => 'tripletechnomantap@gmail.com',
            'user_photo' => 'triple.png',
            'email_verified_at' => now(),
            'password' => Hash::make('jawdJH*(Y@lj67HBJKanjas982k'),
            'remember_token' => Str::random(10),
        ]);
        // litbang
        User::factory()->create([
            'name' => 'Litbang',
            'email' => 'litbangkeren@gmail.com',
            'user_photo' => 'litbang.png',
            'email_verified_at' => now(),
            'password' => Hash::make('LiTbAnG1029384756'),
            'remember_token' => Str::random(10),
        ]);
        // kestari
        User::factory()->create([
            'name' => 'Kestari Techno',
            'email' => 'kestaritechno@gmail.com',
            'user_photo' => 'kestari.png',
            'email_verified_at' => now(),
            'password' => Hash::make('K3stArI1029384756'),
            'remember_token' => Str::random(10),
        ]);

        // Buat satu event
        $event = Event::factory()->create();

        $slugs = [
            "Ia1Dh6sZdQ",
            "dZ4AnskCXj",
            "7lTI2n5EDK",
            "I5njJtbe5J",
        ];

        $competition_names = [
            "Mobile Legend",
            "E-Football Console",
            "UI/UX",
            "Web Design",
        ];

        $competition_types = [
            "E-Sports",
            "E-Sports",
            "Non-E-Sports",
            "Non-E-Sports",
        ];

        $competitions = [];

        foreach ($slugs as $key => $slug) {
            // Buat 20 competition untuk event ini
            $competitions[] = Competition::factory()->create([
                'event_id' => $event->event_id,
                'slug' => $slug,
                'competition_name' => $competition_names[$key],
                'competition_type' => $competition_types[$key],
                'competition_status' => 'active',
            ]);
        }

        // Buat 20 media partner untuk event ini
        // MediaPartner::factory(30)->create(['event_id' => $event->event_id]);

        // Buat 20 sponsor untuk event ini
        // Sponsor::factory(5)->create(['event_id' => $event->event_id]);

        // Looping setiap competition untuk menambahkan achievement & timeline
        foreach ($competitions as $competition) {
            // Buat 3 achievement untuk setiap competition
            for ($i = 0; $i < 3; $i++) {
                Achievement::factory()->create([
                    'competition_id' => $competition->competition_id,
                    'achievement_name' => 'Juara ' . ($i + 1)
                ]);
            }

            // Buat 3 timeline untuk setiap competition
            // Timeline::factory(3)->create(['competition_id' => $competition->competition_id]);

            // Buat 3 announcement untuk setiap competition
            // Announcement::factory(3)->create(['event_id' => $event->event_id]);

            // $teams = Team::factory(3)
            //     ->create(['competition_id' => $competition->competition_id])
            //     ->each(function ($team) use ($competition) {
            //         if ($competition->competition_type == 'Non-E-Sports') {
            //             Work::factory()->create(['team_id' => $team->team_id]);
            //         }
            //     });

            // foreach ($teams as $team) {
            //     MemberTeam::factory(3)->create(['team_id' => $team->team_id]);
            // }
        }
    }
}
