<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\MediaPartner;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Resources\MediaPartnerResource;
use App\Http\Requests\Admin\MediaPart\StoreMediaPartnerRequest;
use App\Http\Requests\Admin\MediaPart\UpdateMediaPartnerRequest;

class AdminMediaPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = MediaPartner::query();

        $mediaPartners = $query
            ->with(['event'])
            ->filter(request(['search', 'status']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.mediapart.index', [
            'mediaPartners' => MediaPartnerResource::collection($mediaPartners),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mediapart.create', ['events' => Event::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaPartnerRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('media_partner_logo')) {
                $logoPath = $request->file('media_partner_logo')->store('media-partner-logos', 'public');
                $validated['media_partner_logo'] = $logoPath;
            }

            // Create the event
            MediaPartner::create($validated);

            // Sweet alert
            Alert::success('Success', 'Media Partner created successfully.');

            // Redirect with success message
            return redirect()->route('media-partners.index')
                ->with('success', 'Media Partner created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating media partner: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create media partner. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('media-partners.create')
                ->with('error', 'Failed to create media partner. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaPartner $mediaPartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaPartner $mediaPartner)
    {
        $query = Event::query();

        $events = $query->select(['event_id', 'event_name'])->get();

        return view('admin.mediapart.edit', [
            'media_partner' => new MediaPartnerResource($mediaPartner),
            'events' => EventResource::collection($events),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaPartnerRequest $request, MediaPartner $mediaPartner)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('media_partner_logo')) {
                if ($mediaPartner->media_partner_logo && Storage::disk('public')->exists($mediaPartner->media_partner_logo)) {
                    Storage::disk('public')->delete($mediaPartner->media_partner_logo);
                }

                $logoPath = $request->file('media_partner_logo')->store('media-partner-logos', 'public');
                $validated['media_partner_logo'] = $logoPath;
            } else {
                unset($validated['media_partner_logo']);
            }

            // Update the event
            $mediaPartner->update($validated);

            // Sweet alert
            Alert::success('Success', 'Media Partner Updated Successfully.');

            // Redirect with success message
            return redirect()->route('media-partners.index')
                ->with('success', 'Media Partner Updated Successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating media partner: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to update media partner. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('media-partners.index')
                ->with('error', 'Failed to update media partner. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaPartner $mediaPartner)
    {
        try {
            // Delete the associated image file if it exists
            if ($mediaPartner->media_partner_logo && Storage::disk('public')->exists($mediaPartner->media_partner_logo)) {
                Storage::disk('public')->delete($mediaPartner->media_partner_logo);
            }

            // Delete the sponsor
            $mediaPartner->delete();

            // Sweet alert
            Alert::success('Success', 'Media Partner deleted successfully.');

            // Redirect with success message
            return redirect()->route('media-partners.index')
                ->with('success', 'Media Partner deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting media partner: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete media partner. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('media-partners.index')
                ->with('error', 'Failed to delete media partner. Please try again.' . $e->getMessage());
        }
    }
}
