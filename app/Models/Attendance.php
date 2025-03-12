<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'check_in'];
    protected $casts = [
        'check_in' => 'datetime' // This ensures check_in is automatically cast to Carbon
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
