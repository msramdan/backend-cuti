<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\{StoreContactRequest, UpdateContactRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $dataCuti = DB::table('daftar_cuti')
            ->join('employees', 'daftar_cuti.karyawan_id', '=', 'employees.id')
            ->select('daftar_cuti.*', 'employees.nik', 'employees.nama_karyawan')
            ->where('tanggal', '=', date('Y-m-d'))
            ->get();
        return view('dashboard',[
            'dataCuti' =>  $dataCuti
        ]);
    }
}
