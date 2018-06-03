<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    protected $fillable = [
        'user_id', 'house_id', 'guest_name', 'guest_email', 'guest_phone',
        'guest_message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
