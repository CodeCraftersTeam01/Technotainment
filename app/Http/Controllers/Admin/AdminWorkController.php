<?php

namespace App\Http\Controllers\Admin;

use App\Models\Work;
use App\Models\Competition;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\Work\StoreWorkRequest;
use App\Http\Requests\Admin\Work\UpdateWorkRequest;

class AdminWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Work::query();

        $competitions = Competition::select('*')
            ->distinct()
            ->where('competition_type', 'Non-E-Sports')
            ->get();

        $works = $query
            ->with(['team.competition'])
            ->whereHas('team.competition', function($query) {
                $query->where('competition_type', 'Non-E-Sports');
            })
            ->filter(request(['search', 'status', 'competition_slug']))
            ->paginate(10)
            ->onEachSide(1);

        return view('admin.work.index',
            [
                'works' => WorkResource::collection($works),
                'competitions' => $competitions
            ]
        );
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
    public function store(StoreWorkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        $work->with('team');
        return view('admin.work.show', [
            'work' => new WorkResource($work)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        try {
            // Delete the work
            $work->delete();

            // Sweet alert
            Alert::success('Success', 'Work deleted successfully.');

            // Redirect with success message
            return redirect()->route('works.index');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting work: ' . $e->getMessage());

            // Sweet alert
            Alert::error('Error', 'Failed to delete work. Please try again.' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('works.index')
                ->with('error', 'Failed to delete work. Please try again.' . $e->getMessage());
        }
    }
}
