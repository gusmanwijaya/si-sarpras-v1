<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SumberDana extends Model
{
    use SoftDeletes;

    protected $table = 'sumber_dana';
    protected $primaryKey = 'id';
    protected $fillable = ['sumber_dana'];

    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function Barang()
    {
        return $this->hasMany(Barang::class, 'id', 'sumber_dana_id');
    }
}
