<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use SoftDeletes;

    protected $table = 'guru';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'nip',
        'golongan',
        'keterangan'
    ];

    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function Ruangan()
    {
        return $this->hasOne(Ruangan::class, 'id', 'guru_id');
    }
}
