<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'user_id', 'host_name', 'host_email', 'host_phone', 'host_message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
