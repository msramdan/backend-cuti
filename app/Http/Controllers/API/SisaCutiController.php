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
    public function getSisaCuti(Request $request)
    {
        $count = 5;
        if ($count) {
            return response()->json([
                'success' => true,
                'message' => 'Get data sisa cuti berhasil',
                'data' => $count,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Get data sisa cuti error',
                'data' => 0,
            ], 401);
        }
    }
}
