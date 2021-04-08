<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subscription_token',
    ];
    public function getUser()
    {
        return User::find($this->user_id);
    }
}
