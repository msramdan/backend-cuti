<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\{StoreEmployeeRequest, UpdateEmployeeRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:karyawan view')->only('index', 'show');
        $this->middleware('permission:karyawan create')->only('create', 'store');
        $this->middleware('permission:karyawan edit')->only('edit', 'update');
        $this->middleware('permission:karyawan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $employees = DB::table('employees')
                ->join('departments', 'employees.departemen_id', '=', 'departments.id')
                ->leftJoin('positions', 'employees.jabatan_id', '=', 'positions.id')
                ->select('employees.*', 'departments.nama_departemen', 'positions.nama_jabatan')
                ->get();


            return DataTables::of($employees)
                ->addColumn('alamat', function ($row) {
                    return str($row->alamat)->limit(100);
                })
                ->addColumn('department', function ($row) {
                    return $row->nama_departemen;
                })->addColumn('position', function ($row) {
                    return $row->nama_jabatan;
                })
                ->addColumn('sisa', function ($row) {
                    return sisaCuti($row->id) . ' Hari';
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
        $attr = $request->validated();
        $attr['password'] = bcrypt($request->password);

        Employee::create($attr);

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

        if (request()->ajax()) {
            $pengajuans = DB::table('pengajuans')
                ->join('employees', 'pengajuans.karyawan_id', '=', 'employees.id')
                ->leftJoin('users', 'pengajuans.user_id', '=', 'users.id')
                ->where('pengajuans.karyawan_id', '=', $employee->id)
                ->select('pengajuans.*', 'employees.nama_karyawan', 'users.name')
                ->orderBy('pengajuans.id', 'desc')
                ->get();

            return Datatables::of($pengajuans)
                ->addColumn('alasan', function ($row) {
                    return str($row->alasan)->limit(100);
                })
                ->addColumn('employee', function ($row) {
                    return $row->nama_karyawan;
                })->addColumn('user', function ($row) {
                    return $row->name;
                })
                ->addColumn('file', function ($row) {
                    if ($row->file == null) {
                        return '<a href="">-</a>';
                    }
                    return '<a href="' . asset('storage/' . $row->file) . '" target="_blank">View</a>';
                })

                ->addColumn('action', 'pengajuans.include.action')
                ->rawColumns(['file', 'action'])
                ->toJson();
        }

        $employee = DB::table('employees')
            ->join('departments', 'employees.departemen_id', '=', 'departments.id')
            ->leftJoin('positions', 'employees.jabatan_id', '=', 'positions.id')
            ->where('employees.id', '=', $employee->id)
            ->select('employees.*', 'departments.nama_departemen', 'positions.nama_jabatan')
            ->first();
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
        $employee->load('department:id,id', 'position:id,id',);

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
        $attr = $request->validated();

        switch (is_null($request->password)) {
            case true:
                unset($attr['password']);
                break;
            default:
                $attr['password'] = bcrypt($request->password);
                break;
        }

        $employee->update($attr);

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
