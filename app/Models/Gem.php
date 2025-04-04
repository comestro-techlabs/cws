<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gem extends Model
{
    protected $table = 'gem_transactions';

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description',
        'expires_at',
    ];
}
