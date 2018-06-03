<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseDetail extends Model
{
    protected $fillable = [
        'house_id', 'building_year', 'bathrooms', 'bedrooms', 'parking',
        'water', 'exercise_room'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }


}
