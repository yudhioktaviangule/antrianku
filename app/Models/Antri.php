<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antri extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor',
        'pasien_id',
        'keperluan',
        'diproses_oleh',
        'status',
    ];
    public function getPasien()
    {
        return Pasien::find($this->pasien_id);
    }
}
