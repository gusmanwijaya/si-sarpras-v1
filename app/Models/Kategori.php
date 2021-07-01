<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = ['kategori'];

    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'id', 'kategori_id');
    }
}
