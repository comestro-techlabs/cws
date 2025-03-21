<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email',
        'address_line', 'city', 'state',
        'postal_code', 'country', 'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
        public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
