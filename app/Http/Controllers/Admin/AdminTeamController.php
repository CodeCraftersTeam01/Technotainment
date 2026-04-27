<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Competition;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Team\StoreTeamRequest;
use App\Http\Requests\Admin\Team\UpdateTeamRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Team::query();

        $teams = $query
            ->with(['competition'])
            ->filter(request(['search', 'status', 'type', 'competition_status']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.team.index', [
            'teams' => TeamResource::collection($teams)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team->load(['members', 'competition']);

        return view('admin.team.show', [
            'team' => new TeamResource($team)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.team.team-edit', [
            'team' => new TeamResource($team),
            'competitions' => Competition::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            // if ($request->hasFile('team_logo')) {
            //     if ($team->team_logo && Storage::disk('public')->exists($team->team_logo)) {
            //         Storage::disk('public')->delete($team->team_logo);
            //     }

            //     $logoPath = $request->file('team_logo')->store('team-logos', 'public');
            //     $validated['team_logo'] = $logoPath;
            // } else {
            //     unset($validated['team_logo']);
            // }

            // team instance name null if team instance == NO
            // if ($request->team_instance == 'NO') {
            //     $validated['team_instance_name'] = null;
            // }

            // Update the team
            $team->update($validated);

            // Sweet alert
            Alert::success('Success', 'Team updated successfully.');

            // Redirect with success message
            return redirect()->route('teams.index', ['competition_status' => 'active'])
                ->with('success', 'Team updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating team: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to update team. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('teams.index')
                ->with('error', 'Failed to update team. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            // Delete the associated image file if it exists
            if ($team->team_logo && Storage::disk('public')->exists($team->team_logo)) {
                Storage::disk('public')->delete($team->team_logo);
            }

            // Delete the team
            $team->delete();

            // Sweet alert
            Alert::success('Success', 'Team deleted successfully.');

            // Redirect with success message
            return redirect()->route('teams.index', ['competition_status' => 'active'])
                ->with('success', 'Team deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting team: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete team. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('teams.index')
                ->with('error', 'Failed to delete team. Please try again.' . $e->getMessage());
        }
    }
}
