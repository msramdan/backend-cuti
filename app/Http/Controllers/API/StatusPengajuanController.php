<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class StatusPengajuanController extends Controller
{

    public function getListPengajuan(Request $request)
    {
        $listPengajuan = Pengajuan::where('karyawan_id', $request->id)->orderBy('id', 'DESC')->get();
        if ($listPengajuan) {
            return response()->json([
                'success' => true,
                'message' => 'Get Data Status Pengajuan Berhasil',
                'data' => $listPengajuan,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ada Error',
            ], 400);
        }
    }
}
