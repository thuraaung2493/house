<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'address', 'phone_no', 'image_name', 'extension'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
