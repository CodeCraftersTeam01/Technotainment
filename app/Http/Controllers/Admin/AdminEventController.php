<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Event\StoreEventRequest;
use App\Http\Requests\Admin\Event\UpdateEventRequest;
use App\Models\Competition;
use RealRashid\SweetAlert\Facades\Alert;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Event::query();

        $events = $query
            ->filter(request(['search']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.event.index', [
            'events' => EventResource::collection($events)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        try {
            // nonactive all event
            if($request->event_status == 'active') {
                Event::where('event_status', 'active')->update(['event_status' => 'nonactive']);
                Competition::where('competition_status', 'active')->update(['competition_status' => 'nonactive']);
            }

            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('event_logo')) {
                $logoPath = $request->file('event_logo')->store('event-logos', options: 'public');
                $validated['event_logo'] = $logoPath;
            }

            // Create the event
            Event::create($validated);

            // Sweet alert
            Alert::success('Success', 'Event created successfully.');

            // Redirect with success message
            return redirect()->route('events.index')
                ->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating event: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create event. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('events.create')
                ->with('error', 'Failed to create event. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', [
            'event' => new EventResource($event)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            // nonactive all event
            $eventActive = Event::where('event_status', 'active')
                ->whereKeyNot($event->getKey())
                ->with(['competitions' => function($query) {
                    $query->where('competition_status', 'active');
                }])->first();
            if($request->event_status == 'active') {
                if($eventActive) {
                    // Nonactive all competiton belongs to event
                    foreach($eventActive->competitions as $competition) {
                        $competition->update(['competition_status' => 'nonactive']);
                    }
                    $eventActive->update(['event_status' => 'nonactive']);
                }
            } elseif ($request->event_status == 'nonactive') {
                $event->update(['event_status' => 'nonactive']);
                // Nonactive all competiton belongs to event
                // if($eventActive) {
                //     foreach($eventActive->competitions as $competition) {
                //         $competition->update(['competition_status' => 'nonactive']);
                //     }
                // }
                Competition::where('event_id', $event->event_id)->update(['competition_status' => 'nonactive']);
            }

            // Validate the request
            $validated = $request->validated();

            // Handle file upload if a new file is provided
            if ($request->hasFile('event_logo')) {
                // Delete the old image if it exists
                if ($event->event_logo && Storage::disk('public')->exists($event->event_logo)) {
                    Storage::disk('public')->delete($event->event_logo);
                }

                // Store the new image
                $logoPath = $request->file('event_logo')->store('event-logos', 'public');
                $validated['event_logo'] = $logoPath;
            } else {
                // If no new file is uploaded, keep the existing one
                unset($validated['event_logo']);
            }

            // Update the event
            $event->update($validated);

            // Sweet alert
            Alert::success('Success', 'Event updated successfully.');

            // Redirect with success message
            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating event: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to update event. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('events.index')
                ->with('error', 'Failed to update event. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            // Delete the associated image file if it exists
            if ($event->event_logo && Storage::disk('public')->exists($event->event_logo)) {
                Storage::disk('public')->delete($event->event_logo);
            }

            // Delete the event
            $event->delete();

            // Sweet alert
            Alert::success('Success', 'Event deleted successfully.');

            // Redirect with success message
            return redirect()->route('events.index')
                ->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting event: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete event. Please try again.' . $e->getMessage());
            // Redirect with error message
            return redirect()->route('events.index')
                ->with('error', 'Failed to delete event. Please try again.' . $e->getMessage());
        }
    }
}
