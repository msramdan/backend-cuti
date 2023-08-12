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


class DaftarCutiController extends Controller
{

    public function daftarCutiToday(Request $request)
    {
        $list = DB::table('daftar_cuti')
            ->join('employees', 'daftar_cuti.karyawan_id', '=', 'employees.id')
            ->join('departments', 'employees.departemen_id', '=', 'departments.id')
            ->join('positions', 'employees.jabatan_id', '=', 'positions.id')

            ->select('daftar_cuti.*', 'employees.nik', 'employees.nama_karyawan','departments.nama_departemen','positions.nama_jabatan')
            ->where('tanggal', '=', date('Y-m-d'))
            ->get();
        if ($list) {
            return response()->json([
                'success' => true,
                'message' => 'List Cuti',
                'data' => $list,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ada error kaka',
                'data' => '',
            ], 401);
        }
    }
}
