<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_detail_id',
        'product_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'transaction_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingDetail()
    {
        return $this->belongsTo(ShippingDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
