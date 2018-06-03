<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['house_id', 'body'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
