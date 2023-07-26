<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\{StoreEmployeeRequest, UpdateEmployeeRequest};
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employee view')->only('index', 'show');
        $this->middleware('permission:employee create')->only('create', 'store');
        $this->middleware('permission:employee edit')->only('edit', 'update');
        $this->middleware('permission:employee delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $employees = Employee::with('department:id,id', 'position:id,id', );

            return DataTables::of($employees)
                ->addColumn('alamat', function($row){
                    return str($row->alamat)->limit(100);
                })
				->addColumn('department', function ($row) {
                    return $row->department ? $row->department->id : '';
                })->addColumn('position', function ($row) {
                    return $row->position ? $row->position->id : '';
                })->addColumn('action', 'employees.include.action')
                ->toJson();
        }

        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        
        Employee::create($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', __('The employee was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employee->load('department:id,id', 'position:id,id', );

		return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $employee->load('department:id,id', 'position:id,id', );

		return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        
        $employee->update($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', __('The employee was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return redirect()
                ->route('employees.index')
                ->with('success', __('The employee was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('employees.index')
                ->with('error', __("The employee can't be deleted because it's related to another table."));
        }
    }
}
