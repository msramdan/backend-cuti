<?php

use App\Models\Laporan;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;



function totalPengajuan($status)
{
    $totalStatus = Pengajuan::where('status_pengajuan', $status)
        ->get();
    return  $totalStatus->count();
}
