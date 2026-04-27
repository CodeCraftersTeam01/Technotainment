<?php

namespace App\Http\Controllers\Admin;

use App\Models\Timeline;
use App\Models\Competition;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\Timeline\StoreTimelineRequest;
use App\Http\Requests\Admin\Timeline\UpdateTimelineRequest;
use App\Http\Resources\CompetitionResource;

class AdminTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Competition::query();

        $competitions = $query
            ->filter(request(['search', 'event', 'status', 'type']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.timeline.index', [
            'competitions' => CompetitionResource::collection($competitions)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create from modal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimelineRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Create the timeline
            Timeline::create($validated);

            // Sweet alert
            Alert::success('Success', 'Timeline added successfully.');

            // Log the success
            return redirect()->route('timelines.show', $request->competition_id)
                ->with('success', 'Timeline added successfully.');
        } catch (\Exception $e) {
            // Sweet alert
            Alert::error('Error', 'Error adding timeline: ' . $e->getMessage());
            // Log the error
            return redirect()->route('timelines.show', $request->competition_id)
                ->with('error', 'Error adding timeline: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition, $competition_id)
    {
        $competition = Competition::with(['timelines', 'event'])->find($competition_id);

        return view('admin.timeline.show', [
            'competition' => new CompetitionResource($competition),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timeline $timeline)
    {
        return response()->json([
            'timeline_id' => $timeline->timeline_id,
            'timeline_name' => $timeline->timeline_name,
            'timeline_description' => $timeline->timeline_description,
            'timeline_start' => $timeline->timeline_start,
            'timeline_end' => $timeline->timeline_end,
            'timeline_logo' => $timeline->timeline_logo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimelineRequest $request, Timeline $timeline)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Update the timeline
            $timeline->update($validated);

            // Sweet alert
            Alert::success('Success', 'Timeline updated successfully.');

            // Log the success
            return redirect()->route('timelines.show', $timeline->competition_id)
                ->with('success', 'Timeline updated successfully.');
        } catch (\Exception $e) {
            // Sweet alert
            Alert::error('Error', 'Error updating timeline: ' . $e->getMessage());
            // Log the error
            return redirect()->route('timelines.show', $timeline->competition_id)
                ->with('error', 'Error updating timeline: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        try {
            // Delete the timeline
            $timeline->delete();

            // Sweet alert
            Alert::success('Success', 'Timeline deleted successfully.');

            // Log the success
            return redirect()->back()->with('success', 'Timeline deleted successfully.');
        } catch (\Exception $e) {
            // Sweet alert
            Alert::error('Error', 'Error deleting timeline, please try again.' . $e->getMessage());
            // Log the error
            return redirect()->back()->with('error', 'Error deleting timeline, please try again.' . $e->getMessage());
        }
    }
}
