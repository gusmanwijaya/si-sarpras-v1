<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Ruangan extends Model
{
    use SoftDeletes;

    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_ruangan', 'kode_ruangan', 'image_url', 'guru_id'];

    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'id', 'ruangan_id');
    }

    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}
