<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkDeadline;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Resources\WorkDeadlineResource;
use App\Http\Requests\StoreWorkDeadlineRequest;
use App\Http\Requests\UpdateWorkDeadlineRequest;

class WorkDeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wd = WorkDeadline::with('competitions')->get();
        return view('admin.work.wdindex',
        [
            'wds' => WorkDeadlineResource::collection($wd),
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
    public function store(StoreWorkDeadlineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkDeadline $workDeadline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkDeadline $workDeadline)
    {
        return view('admin.work.wdedit', [
            'wd' => new WorkDeadlineResource($workDeadline),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkDeadlineRequest $request, WorkDeadline $workDeadline)
    {
        try {
            $workDeadline->update($request->all());
            Alert::success('Success', 'Work deadline Updated Successfully.');
            return redirect()->route('work-deadlines.index')->with('success', 'Work deadline updated successfully');
        } catch (\Exception $e) {
            Alert::error('Error', 'Error updating work deadline: ' . $e->getMessage());
            return redirect()->route('work-deadlines.index')->with('error', 'Error updating work deadline: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkDeadline $workDeadline)
    {
        //
    }
}
