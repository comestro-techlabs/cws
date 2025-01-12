<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //

    protected $guarded = [];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    

}
