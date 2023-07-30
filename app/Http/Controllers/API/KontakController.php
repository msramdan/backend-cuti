<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class KontakController extends Controller
{
    public function store(Request $request)
    {
        $store = DB::table('contacts')->insert([
            'karyawan_id' => $request->karyawan_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => date('Y-m-d H:i:s'),
        ]);
        if ($store) {
            return response()->json([
                'success' => true,
                'message' => 'Store Berhasil Disimpan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Store Gagal Disimpan!',
            ], 401);
        }
    }
}
