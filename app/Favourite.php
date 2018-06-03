<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id', 'favourite_house_id'];

    public static function doesNotExitInFavourite($model)
    {
        return static::where('favourite_house_id', $model->id)
                    ->where('user_id', auth()->id())->count() < 1;
    }
}
