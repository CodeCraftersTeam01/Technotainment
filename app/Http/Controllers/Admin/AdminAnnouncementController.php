<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\Announcement\StoreAnnouncementRequest;
use App\Http\Requests\Admin\Announcement\UpdateAnnouncementRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;

class AdminAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query();

        $event = $query
            ->filter(request(['search', 'event', 'status']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.announcement.index', [
            'events' => EventResource::collection($event)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event_id = request('event_id');

        return view('admin.announcement.create', ['event_id' => $event_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        try {
            $validated = $request->validated();

            // handle file upload
            if ($request->hasFile('announcement_photo')) {
                $photoPath = $request->file('announcement_photo')->store('announcement-photos', 'public');
                $validated['announcement_photo'] = $photoPath;
            }

            Announcement::create($validated);

            Alert::success('Success', 'Announcement created successfully');

            return redirect()->route('announcements.show', $request->event_id)
                ->with('success', 'Announcement created successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error("Error creating announcement: " . $e->getMessage());

            Alert::error('Error', 'Something went wrong, please try again');

            // Redirect with error message
            return redirect()->route('announcement.show', $request->event_id)
                ->with('error', 'Something went wrong, please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, $event_id)
    {
        $event = Event::with(['announcements'])->find($event_id);

        return view('admin.announcement.show', [
            'event' => new EventResource($event),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', [
            'announcement' => $announcement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        try {
            // delete photo
            if($request->delete_photo_status && $request->delete_photo_status == 'a8Zx9BdL1mP0QwE') {
                if($announcement->announcement_photo && Storage::disk('public')->exists($announcement->announcement_photo)) {
                    Storage::disk('public')->delete($announcement->announcement_photo);
                }
                $announcement->announcement_photo = null;
            }

            // validate
            $validated = $request->validated();
            unset($validated['delete_photo_status']);

            // handle file upload
            if ($request->hasFile('announcement_photo')) {
                if($announcement->announcement_photo && Storage::disk('public')->exists($announcement->announcement_photo)) {
                    Storage::disk('public')->delete($announcement->announcement_photo);
                }

                $photoPath = $request->file('announcement_photo')->store('announcement-photos', 'public');
                $validated['announcement_photo'] = $photoPath;
            } else {
                unset($validated['announcement_photo']);
            }

            $announcement->update($validated);

            Alert::success('Success', 'Announcement updated successfully');

            return redirect()->route('announcements.show', $announcement->event_id)
                ->with('success', 'Announcement updated successfully');
        } catch (\Exception $e) {
            Log::error("Error updating announcement: " . $e->getMessage());

            Alert::error('Error', 'Something went wrong, please try again');

            // Redirect with error message
            return redirect()->route('announcements.show', $announcement->event_id)
                ->with('error', 'Something went wrong, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        try {
            $event_id = $announcement->event_id;
            $announcement->delete();

            Alert::success('Success', 'Announcement deleted successfully');

            return redirect()->route('announcements.show', $event_id)->with('success', 'Announcement deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting announcement: ' . $e->getMessage());

            Alert::error('Error', 'Something went wrong, please try again');

            return redirect()->back()->with('error', 'Something went wrong, please try again');
        }
    }
}
