<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title',
        'content',
        'recipient_type',
        'recipients',
    ];

    protected $casts = [
        'recipients' => 'array',
    ];
    
    public function setRecipientsAttribute($value)
    {
        // Ensure we store as a JSON string
        $this->attributes['recipients'] = json_encode($value);
    }

    /**
     * Accessor for recipients attribute to decode JSON.
     */
    public function getRecipientsAttribute($value)
    {
        // Decode JSON into an array when accessed
        return json_decode($value, true);
    }
    
}
