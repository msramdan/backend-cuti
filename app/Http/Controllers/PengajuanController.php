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
                    return '<a href="'.asset('storage/' . $row->file).'" target="_blank">View</a>';
                })

                ->addColumn('action', 'pengajuans.include.action')
                ->rawColumns(['file', 'action'])
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
        $pengajuan = Pengajuan::findOrFail($request->id);
        if ($request->status_pengajuan == 'Approved') {
            $dates = $this->getBetweenDates($pengajuan->tanggal_awal, $pengajuan->tanggal_akhir);
            foreach ($dates as $value) {
                $dateName = date('l', strtotime($value));
                if ($dateName == 'Saturday' || $dateName == 'Sunday') {
                    // echo 'skip sabtu minggu';
                } else {
                    $tahun = date('Y');
                    // if cuti tahunan cek sisa cuti
                    if ($pengajuan->jenis_cuti == 'Cuti Tahunan') {
                        $getTotal = DB::select("SELECT * FROM daftar_cuti WHERE jenis_cuti='Cuti Tahunan' AND karyawan_id='$pengajuan->karyawan_id' AND YEAR(tanggal)='$tahun'");
                        if (count($getTotal) < 12) {
                            DB::table('daftar_cuti')->insert([
                                'karyawan_id' => $pengajuan->karyawan_id,
                                'jenis_cuti' => $pengajuan->jenis_cuti,
                                'tanggal' => $value,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    } else {
                        DB::table('daftar_cuti')->insert([
                            'karyawan_id' => $pengajuan->karyawan_id,
                            'jenis_cuti' => $pengajuan->jenis_cuti,
                            'tanggal' => $value,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        }
        $pengajuan->update([
            'catatan' => $request->catatan,
            'user_id' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'status_pengajuan' => $request->status_pengajuan,
        ]);
        return redirect()
            ->route('pengajuans.index')
            ->with('success', __('Pengajuan cuti berhasil di update'));
    }

    function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        for (
            $currentDate = $startDate;
            $currentDate <= $endDate;
            $currentDate += (86400)
        ) {

            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }
        return $rangArray;
    }
}
