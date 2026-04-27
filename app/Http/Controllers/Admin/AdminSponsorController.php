<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\SponsorResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Sponsor\StoreSponsorRequest;
use App\Http\Requests\Admin\Sponsor\UpdateSponsorRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Sponsor::query();

        $sponsors = $query
            ->with(['event'])
            ->filter(request(['search', 'status']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.sponsor.index', [
            'sponsors' => SponsorResource::collection($sponsors)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sponsor.create', ['events' => Event::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('sponsor_logo')) {
                $logoPath = $request->file('sponsor_logo')->store('sponsor-logos', 'public');
                $validated['sponsor_logo'] = $logoPath;
            }
            // Create the event
            Sponsor::create($validated);

            // Sweet alert
            Alert::success('Success', 'Sponsor created successfully.');

            // Redirect with success message
            return redirect()->route('sponsors.index')
                ->with('success', 'Sponsor created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating sponsor: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create sponsor. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('sponsors.create')
                ->with('error', 'Failed to create sponsor. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        $events = Event::query();

        $events = $events->select(['event_id', 'event_name'])->get();

        return view('admin.sponsor.edit', [
            'sponsor' => new SponsorResource($sponsor),
            'events' => $events,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('sponsor_logo')) {
                if ($sponsor->sponsor_logo && Storage::disk('public')->exists($sponsor->sponsor_logo)) {
                    Storage::disk('public')->delete($sponsor->sponsor_logo);
                }

                $logoPath = $request->file('sponsor_logo')->store('sponsor-logos', 'public');
                $validated['sponsor_logo'] = $logoPath;
            } else {
                unset($validated['sponsor_logo']);
            }

            // Update the sponsor
            $sponsor->update($validated);

            // Sweet alert
            Alert::success('Success', 'Sponsor Updated Successfully.');

            // Redirect with success message
            return redirect()->route('sponsors.index')
                ->with('success', 'Sponsor Updated Successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating sponsor: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to update sponsor. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('sponsors.index')
                ->with('error', 'Failed to update sponsor. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        try {
            // Delete the associated image file if it exists
            if ($sponsor->sponsor_logo && Storage::disk('public')->exists($sponsor->sponsor_logo)) {
                Storage::disk('public')->delete($sponsor->sponsor_logo);
            }

            // Delete the sponsor
            $sponsor->delete();

            // Sweet alert
            Alert::success('Success', 'Sponsor deleted successfully.');

            // Redirect with success message
            return redirect()->route('sponsors.index')
                ->with('success', 'Sponsor deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting sponsor: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete sponsor. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('sponsors.index')
                ->with('error', 'Failed to delete sponsor. Please try again.' . $e->getMessage());
        }
    }
}
