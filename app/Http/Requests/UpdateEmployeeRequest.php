<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'nik' => 'required|string|min:5|max:255',
			'nama_karyawan' => 'required|string|min:5|max:255',
			'tempat_lahir' => 'required|string|min:5|max:255',
			'tanggal_lahir' => 'required|date',
			'jenis_kelamin' => 'required|boolean',
			'no_hp' => 'required|string|min:10|max:15',
			'alamat' => 'required|string',
			'departemen_id' => 'required|exists:App\Models\Department,id',
			'jabatan_id' => 'required|exists:App\Models\Position,id',
			'password' => 'nullable|confirmed',
        ];
    }
}
