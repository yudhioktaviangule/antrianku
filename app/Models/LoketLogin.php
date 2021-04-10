<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoketLogin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'loket_id',
    ];

    public function getLoket()
    {
        return Loket::find($this->loket_id);
    }
}
