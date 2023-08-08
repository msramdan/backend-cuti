<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class FormPengajuanController extends Controller
{
    public function store(Request $request)
    {
        $store = DB::table('pengajuans')->insert([
            'karyawan_id' => $request->karyawan_id,
            'jenis_cuti' => $request->jenis_cuti,
            'alasan' => $request->alasan,
            'tanggal_awal' =>  date('Y-m-d'),
            'tanggal_akhir' =>  date('Y-m-d'),
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan' => 'Pending',
            'file' => 'coba.jpg',
        ]);
        if ($store) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan cuti berhasil dikirim',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan cuti gagal dikirim',
            ], 401);
        }
    }
}
