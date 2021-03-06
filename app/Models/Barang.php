<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'merek',
        'no_reg',
        'tahun',
        'unit',
        'kondisi',
        'image_url',
        'kategori_id',
        'ruangan_id'
    ];

    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function Ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
