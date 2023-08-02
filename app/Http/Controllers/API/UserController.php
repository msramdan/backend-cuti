<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $employee = Employee::where('nik', $request->nik)->first();
        if ($employee) {
            if (!Hash::check($request->password, $employee->password, [])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password Salah',
                ], 400);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil',
                    'data' => $employee,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'NIK tidak terdaftar',
            ], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        $bodyContent = json_decode(request()->getContent(), true);
        DB::table('employees')
            ->where('id', $request->id)
            ->update(
                [
                    'nama_karyawan' => $bodyContent['nama_karyawan'],
                    'no_hp' => $bodyContent['no_hp'],
                    'alamat' => $bodyContent['alamat'],
                ]
            );
        return response()->json([
            'success' => true,
            'message' => 'Profile Berhasil Diupdate!',
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        if (Hash::check($request->password, $employee->password)) {
           $employee->fill([
            'password' => Hash::make($request->newPassword)
            ])->save();
            return response()->json([
                'success' => true,
                'message' => 'Password Berhasil Diupdate!',
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Password lama tidak sesuai',
            ], 400);
        }

    }


}
