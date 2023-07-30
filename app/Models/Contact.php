<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['karyawan_id', 'judul', 'deskripsi', 'tanggal'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['judul' => 'string', 'deskripsi' => 'string', 'tanggal' => 'datetime:d/m/Y H:i', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];


	public function employee()
	{
		return $this->belongsTo(\App\Models\Employee::class,'karyawan_id');
    }
}
