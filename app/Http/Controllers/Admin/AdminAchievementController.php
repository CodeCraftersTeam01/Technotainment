<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Http\Requests\Admin\Achievement\StoreAchievementRequest;
use App\Http\Requests\Admin\Achievement\UpdateAchievementRequest;
use App\Http\Resources\CompetitionResource;
use App\Models\Competition;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Competition::query();

        $competitions = $query
            ->filter(request(['search', 'event', 'status', 'type']))
            ->with('achievements')
            ->paginate(10)
            ->onEachSide(1);
        
        return view('admin.achievement.index', [
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
    public function store(StoreAchievementRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Create the achievement
            Achievement::create($validated);

            // Sweet alert
            Alert::success('Success', 'Achievement created successfully.');

            // Redirect with success message
            return redirect()->back()
                ->with('success', 'Achievement created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating achievement: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create achievement. Please try again.');

            // Redirect with error message
            return redirect()->back()
                ->with('error', 'Failed to create achievement. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition, $competition_id)
    {
        $competition = Competition::with('achievements')->find($competition_id);

        return view('admin.achievement.show', [
            'competition' => new CompetitionResource($competition),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        return response()->json([
            'achievement_id' => $achievement->achievement_id,
            'achievement_name' => $achievement->achievement_name,
            'achievement_logo' => $achievement->achievement_logo,
            'achievement_description' => $achievement->achievement_description,
            'achievement_price' => $achievement->achievement_price,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Update the achievement
            $achievement->update($validated);

            // Sweet alert
            Alert::success('Success', 'Achievement updated successfully.');

            // Redirect with success message
            return redirect()->back()
                ->with('success', 'Achievement updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating achievement: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Error updating achievement, please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()
                ->with('error', 'Error updating achievement, please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        try {
            // Delete the achievement
            $achievement->delete();

            // Sweet alert
            Alert::success('Success', 'Achievement deleted successfully.');
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Achievement deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting achievement: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Error deleting achievement, please try again.');
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error deleting achievement, please try again.');
        }
    }
}
