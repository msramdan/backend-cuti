<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class FormPengajuanController extends Controller
{
    public function store(Request $request)
    {
        if ($request->avatarForDB != '' || $request->avatarForDB != null) {
            $image_64 = $request->avatarForDB; //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = self::quickRandom() . '.' . $extension;
            Storage::disk('public')->put($imageName, base64_decode($image));
        } else {
            $imageName = '';
        }
        $store = DB::table('pengajuans')->insert([
            'karyawan_id' => $request->karyawan_id,
            'jenis_cuti' => $request->jenis_cuti,
            'alasan' => $request->alasan,
            'tanggal_awal' => $request->selectedStartDate,
            'tanggal_akhir' => $request->selectedEndDate,
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan' => 'Pending',
            'file' => $imageName,
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

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
