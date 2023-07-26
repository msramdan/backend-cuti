<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['karyawan_id', 'jenis_cuti', 'tanggal_akhir', 'tanggal_awal', 'alasan', 'file', 'tanggal_pengajuan', 'status_pengajuan', 'user_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['jenis_cuti' => 'boolean', 'tanggal_akhir' => 'date:d/m/Y', 'tanggal_awal' => 'date:d/m/Y', 'alasan' => 'string', 'file' => 'string', 'tanggal_pengajuan' => 'datetime:d/m/Y H:i', 'status_pengajuan' => 'boolean', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class,'karyawan_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
