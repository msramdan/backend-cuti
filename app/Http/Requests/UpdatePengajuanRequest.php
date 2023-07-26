<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengajuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'karyawan_id' => 'required|exists:App\Models\Employee,id',
			'jenis_cuti' => 'required|boolean',
			'tanggal_akhir' => 'required|date',
			'tanggal_awal' => 'required|date',
			'alasan' => 'required|string',
			'file' => 'nullable|image|max:4024',
			'tanggal_pengajuan' => 'required',
			'status_pengajuan' => 'required|boolean',
			'user_id' => 'required|exists:App\Models\User,id',
        ];
    }
}
