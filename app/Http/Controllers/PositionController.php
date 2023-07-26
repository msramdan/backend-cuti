<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\{StorePositionRequest, UpdatePositionRequest};
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:position view')->only('index', 'show');
        $this->middleware('permission:position create')->only('create', 'store');
        $this->middleware('permission:position edit')->only('edit', 'update');
        $this->middleware('permission:position delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $positions = Position::query();

            return DataTables::of($positions)
                ->addColumn('action', 'positions.include.action')
                ->toJson();
        }

        return view('positions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionRequest $request)
    {
        
        Position::create($request->validated());

        return redirect()
            ->route('positions.index')
            ->with('success', __('The position was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        
        $position->update($request->validated());

        return redirect()
            ->route('positions.index')
            ->with('success', __('The position was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        try {
            $position->delete();

            return redirect()
                ->route('positions.index')
                ->with('success', __('The position was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('positions.index')
                ->with('error', __("The position can't be deleted because it's related to another table."));
        }
    }
}
