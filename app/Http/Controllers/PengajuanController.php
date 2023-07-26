<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Requests\{StorePengajuanRequest, UpdatePengajuanRequest};
use Yajra\DataTables\Facades\DataTables;
use Image;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajuan view')->only('index', 'show');
    }
    public function index()
    {
        if (request()->ajax()) {
            $pengajuans = Pengajuan::with('employee:id,nama_karyawan', 'user:id,name', );

            return Datatables::of($pengajuans)
                ->addColumn('alasan', function($row){
                    return str($row->alasan)->limit(100);
                })
				->addColumn('employee', function ($row) {
                    return $row->employee ? $row->employee->nama_karyawan : '';
                })->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
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
        $pengajuan->load('employee:id,created_at', 'user:id,created_at', );

		return view('pengajuans.show', compact('pengajuan'));
    }
}
