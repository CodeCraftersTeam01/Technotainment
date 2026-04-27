<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Competition;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Resources\CompetitionResource;
use App\Http\Requests\Admin\Competition\StoreCompetitionRequest;
use App\Http\Requests\Admin\Competition\UpdateCompetitionRequest;

class AdminCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Competition::query();

        $competitions = $query
            ->filter(request(['search', 'event', 'status', 'type', 'event_status']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.competition.index', [
            'competitions' => CompetitionResource::collection($competitions)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $query = Event::query();

        $events = $query->select(['event_id', 'event_name'])->get();

        return view('admin.competition.create', [
            'events' => EventResource::collection($events),
            'error' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetitionRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();

            // Generate the slug
            // $validated['slug'] = Str::random(10);

            // Handle file upload
            if ($request->hasFile('competition_logo')) {
                $logoPath = $request->file('competition_logo')->store('competition-logos', 'public');
                $validated['competition_logo'] = $logoPath;
            }

            if ($request->hasFile('competition_second_logo')) {
                $logoPath = $request->file('competition_second_logo')->store('competition-logos', 'public');
                $validated['competition_second_logo'] = $logoPath;
            }

            if ($request->hasFile('competition_third_logo')) {
                $logoPath = $request->file('competition_third_logo')->store('competition-logos', 'public');
                $validated['competition_third_logo'] = $logoPath;
            }

            if ($request->hasFile('competition_guide_book')) {
                $guideBookPath = $request->file('competition_guide_book')->store('competition-guide-books', 'public');
                $validated['competition_guide_book'] = $guideBookPath;
            }

            // nonactive if event nonactive
            $event = Event::where('event_id', $request->event_id)->first();
            if($request->competition_status == 'active' && $event->event_status == 'nonactive') {
                $validated['competition_status'] = 'nonactive';
            }

            Competition::create($validated);

            // Sweet alert
            Alert::success('Success', 'Competition created successfully.');

            // Redirect with success message
            return redirect()->route('competitions.index')
                ->with('success', 'Competition created successfully.');;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating competition: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create competition. Please try again.' . $e->getMessage());

            return redirect()->route('competitions.create')
                ->with('error', 'Failed to create competition. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        $query = Event::query();

        $events = $query->select(['event_id', 'event_name'])->get();

        return view('admin.competition.edit', [
            'competition' => new CompetitionResource($competition),
            'events' => EventResource::collection($events)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        try {
            // nonactive all event
            $event = Event::where('event_id', $request->event_id)->first();
            if($request->competition_status == 'active' && $event->event_status == 'nonactive') {
                // Sweet alert
                Alert::error('Error', 'You should turn the Event on');

                // Redirect with success message
                return redirect()->route('competitions.index')
                    ->with('error', 'Competition updated successfully.');
            }

            // nonactive all event
            if($request->event_status == 'active') {
                Event::where('event_status', 'active')->update(['event_status' => 'nonactive']);
            }
            // Validate the request
            $validated = $request->validated();

            // Handle file upload
            if ($request->hasFile('competition_logo')) {
                if ($competition->competition_logo && Storage::disk('public')->exists($competition->competition_logo)) {
                    Storage::disk('public')->delete($competition->competition_logo);
                }

                $logoPath = $request->file('competition_logo')->store('competition-logos', 'public');
                $validated['competition_logo'] = $logoPath;
            } else {
                unset($validated['competition_logo']);
            }

            if ($request->hasFile('competition_second_logo')) {
                if ($competition->competition_second_logo && Storage::disk('public')->exists($competition->competition_second_logo)) {
                    Storage::disk('public')->delete($competition->competition_second_logo);
                }

                $logoPath = $request->file('competition_second_logo')->store('competition-logos', 'public');
                $validated['competition_second_logo'] = $logoPath;
            } else {
                unset($validated['competition_second_logo']);
            }

            if ($request->hasFile('competition_third_logo')) {
                if ($competition->competition_third_logo && Storage::disk('public')->exists($competition->competition_third_logo)) {
                    Storage::disk('public')->delete($competition->competition_third_logo);
                }

                $logoPath = $request->file('competition_third_logo')->store('competition-logos', 'public');
                $validated['competition_third_logo'] = $logoPath;
            } else {
                unset($validated['competition_third_logo']);
            }

            if ($request->hasFile('competition_guide_book')) {
                if ($competition->competition_guide_book && Storage::disk('public')->exists($competition->competition_guide_book)) {
                    Storage::disk('public')->delete($competition->competition_guide_book);
                }

                $guideBookPath = $request->file('competition_guide_book')->store('competition-guide-books', 'public');
                $validated['competition_guide_book'] = $guideBookPath;
            } else {
                unset($validated['competition_guide_book']);
            }

            // Update the competition
            $competition->update($validated);

            // Sweet alert
            Alert::success('Success', 'Competition updated successfully.');

            // Redirect with success message
            return redirect()->route('competitions.index')
                ->with('success', 'Competition updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating competition: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to create competition. Please try again.' . $e->getMessage());

            return redirect()->route('competitions.index')
                ->with('error', 'Failed to create competition. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition)
    {
        try {
            // Delete the associated image file if it exists
            if ($competition->competition_logo && Storage::disk('public')->exists($competition->competition_logo)) {
                Storage::disk('public')->delete($competition->competition_logo);
            }

            if ($competition->competition_guide_book && Storage::disk('public')->exists($competition->competition_guide_book)) {
                Storage::disk('public')->delete($competition->competition_guide_book);
            }

            // Delete the competition
            $competition->delete();

            // Sweet alert
            Alert::success('Success', 'Competition deleted successfully.');

            // Redirect with success message
            return redirect()->route('competitions.index')
                ->with('success', 'Competition deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting competition: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete competition. Please try again.');
            // Redirect with error message
            return redirect()->route('competitions.index')
                ->with('error', 'Failed to delete competition. Please try again. ' . $e->getMessage());
        }
    }
}
