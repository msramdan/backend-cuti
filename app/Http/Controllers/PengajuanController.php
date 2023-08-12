<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Requests\{StorePengajuanRequest, UpdatePengajuanRequest};
use Yajra\DataTables\Facades\DataTables;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajuan view')->only('index', 'show');
    }
    public function index()
    {
        if (request()->ajax()) {
            $pengajuans = DB::table('pengajuans')
                ->join('employees', 'pengajuans.karyawan_id', '=', 'employees.id')
                ->leftJoin('users', 'pengajuans.user_id', '=', 'users.id')
                ->select('pengajuans.*', 'employees.nama_karyawan', 'users.name')
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
                        return 'https://via.placeholder.com/350?text=No+Image+Avaiable';
                    }
                    return asset('storage/uploads/files/' . $row->file);
                })

                ->addColumn('action', 'pengajuans.include.action')
                ->toJson();
        }

        return view('pengajuans.index');
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load('employee:id,created_at', 'user:id,created_at',);

        return view('pengajuans.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request)
    {
        $laporan = Pengajuan::findOrFail($request->id);
        $laporan->update([
            'catatan' => $request->catatan,
            'user_review' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'status_pengajuan' => $request->status_pengajuan,
        ]);
        return redirect()
            ->route('pengajuans.index')
            ->with('success', __('Pengajuan cuti berhasil di update'));
    }
}
