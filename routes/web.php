<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminWorkController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminSponsorController;
use App\Http\Controllers\Admin\WorkDeadlineController;
use App\Http\Controllers\Admin\AdminTimelineController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMemberTeamController;
use App\Http\Controllers\Admin\AdminAchievementController;
use App\Http\Controllers\Admin\AdminCompetitionController;
use App\Http\Controllers\Admin\AdminAnnouncementController;
use App\Http\Controllers\Admin\AdminMediaPartnerController;
use App\Http\Controllers\Admin\AdminDocumentController;

// Auth
Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'create']);
    Route::post('/auth/login', [AuthController::class, 'store'])->name('login');
});

// Admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::resource('competitions', AdminCompetitionController::class);
    Route::resource('timelines', AdminTimelineController::class);
    Route::resource('achievements', AdminAchievementController::class);
    Route::resource('sponsors', AdminSponsorController::class);
    Route::resource('media-partners', AdminMediaPartnerController::class);
    Route::resource('teams', AdminTeamController::class);
    Route::resource('members', AdminMemberTeamController::class);
    Route::resource('works', AdminWorkController::class);
    Route::resource('announcements', AdminAnnouncementController::class);
    Route::resource('work-deadlines', WorkDeadlineController::class);
    Route::get('/admin/documents/{path}', [AdminDocumentController::class, 'serve'])->name('admin.documents.serve')->where('path', '.*');
    Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
});

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/', [GuestController::class, 'index']);
    Route::get('/competition/{competition:slug}', [GuestController::class, 'competition']);
    Route::get('/registration/{competition:slug}', [GuestController::class, 'registration'])->middleware('throttle:60,1');
    Route::post('/registration{competition:slug}', [GuestController::class, 'registrationStore'])->middleware('throttle:60,1')->name('registration.store');
    Route::get('/success-registration', [GuestController::class, 'successRegistration'])->name('success.registration');
    Route::patch('/work/{team}', [GuestController::class, 'workStore'])->name('work.store');
    Route::get('/login', [GuestController::class, 'login'])->name('team.login');
    Route::post('/login', [GuestController::class, 'loginStore'])->name('team.login.store');
    Route::get('/team/dashboard', [GuestController::class, 'dashboard'])->name('team.dashboard');
    Route::get('/team/logout', [GuestController::class, 'logout'])->name('team.logout');
    Route::get('/show-announcements', [GuestController::class, 'showAnnouncements'])->name('show.announcements');
    Route::get('/show-announcements/{announcement:announcement_id}', [GuestController::class, 'showAnnouncement'])->name('show.announcement');
});
