<?php

use App\Models\Laporan;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



function totalPengajuan($status)
{
    $totalStatus = Pengajuan::where('status_pengajuan', $status)
        ->get();
    return  $totalStatus->count();
}

function sisaCuti($id)
    {
        $tahun = date('Y');
        $getTotal = DB::select("SELECT * FROM daftar_cuti WHERE jenis_cuti='Cuti Tahunan' AND karyawan_id='$id' AND YEAR(tanggal)='$tahun'");
        if ($getTotal) {
            $jml = count($getTotal);
        } else {
            $jml = 0;
        }
        $sisa = 12 - $jml;
        return $sisa;
    }

