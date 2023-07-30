<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;




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
                'message' => 'NIK Salah',
            ], 400);
        }
    }
}
