<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class SisaCutiController extends Controller
{
    public function sisaCuti(Request $request)
    {
        $tahun = date('Y');
        $getTotal = DB::select("SELECT * FROM daftar_cuti WHERE jenis_cuti='Cuti Tahunan' AND karyawan_id='$request->id' AND YEAR(tanggal)='$tahun'");

        if ($getTotal) {
            $jml = count($getTotal);
        } else {
            $jml = 0;
        }
        $sisa = 12 - $jml;
        return response()->json([
            'success' => true,
            'message' => 'Get data sisa cuti berhasil',
            'data' => $sisa,
        ], 200);
    }
}
