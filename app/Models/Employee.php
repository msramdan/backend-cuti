<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nik', 'nama_karyawan', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'alamat', 'departemen_id', 'jabatan_id', 'password'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['nik' => 'string', 'nama_karyawan' => 'string', 'tempat_lahir' => 'string', 'tanggal_lahir' => 'date:d/m/Y','no_hp' => 'string', 'alamat' => 'string', 'password' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
    */
    protected $hidden = ['password'];

	public function department()
	{
		return $this->belongsTo(\App\Models\Department::class);
	}
	public function position()
	{
		return $this->belongsTo(\App\Models\Position::class);
	}
}
