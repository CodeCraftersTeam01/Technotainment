<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\MemberTeam;
use App\Http\Requests\Admin\MemberTeam\StoreMemberTeamRequest;
use App\Http\Requests\Admin\MemberTeam\UpdateMemberTeamRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMemberTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = request('id');

        $team = Team::find($id);

        return view('admin.team.member-create', [
            'team' => new TeamResource($team)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberTeamRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('member_team_identity')) {
                // buat upload ke private
                $logoPath = Storage::disk('local')->put('member-team-identity', $request->file('member_team_identity'));
                $validated['member_team_identity'] = $logoPath;
            }

            MemberTeam::create($validated);

            Alert::success('Success', 'Team created successfully.');

            return redirect()->back()
                ->with('success', 'Team created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating team: ' . $e->getMessage());

            Alert::error('Error', 'Failed to create team. Please try again.' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to create team. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberTeam $memberTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($member_team_id)
    {
        try {
            $memberTeam = MemberTeam::findOrFail($member_team_id);

            return response()->json([
                'member_team_name' => $memberTeam->member_team_name,
                'member_team_identity' => $memberTeam->member_team_identity,
                'member_team_role' => $memberTeam->member_team_role,
                'team_id' => $memberTeam->team_id
            ]);
        } catch (\Exception $e) {
            Log::error('Error editing team: ' . $e->getMessage());

            Alert::error('Error', 'Failed to edit team. Please try again.' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to edit team. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberTeamRequest $request, MemberTeam $memberTeam, $member_team_id)
    {
        try {
            $memberTeam = MemberTeam::findOrFail($member_team_id);

            $validated = $request->validated();

            if ($request->hasFile('member_team_identity')) {

                if ($memberTeam->member_team_identity && Storage::disk('public')->exists($memberTeam->member_team_identity)) {
                    Storage::disk('public')->delete($memberTeam->member_team_identity);
                }

                $logoPath = $request->file('member_team_identity')->store('member-team-identity', 'public');
                $validated['member_team_identity'] = $logoPath;
            }

            $memberTeam->update($validated);

            Alert::success('Success', 'Team updated successfully.');

            return redirect()->back()
                ->with('success', 'Team updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating team: ' . $e->getMessage());

            Alert::error('Error', 'Failed to update team. Please try again.' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to update team. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberTeam $memberTeam, $member_team_id)
    {
        try {
            $memberTeam = MemberTeam::findOrFail($member_team_id);

            if ($memberTeam->member_team_identity && Storage::disk('public')->exists($memberTeam->member_team_identity)) {
                Storage::disk('public')->delete($memberTeam->member_team_identity);
            }

            $memberTeam->delete();

            Alert::success('Success', 'Team deleted successfully.');

            return redirect()->back()
                ->with('success', 'Team deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting team: ' . $e->getMessage());

            Alert::error('Error', 'Failed to delete team. Please try again.' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to delete team. Please try again.' . $e->getMessage());
        }
    }
}
