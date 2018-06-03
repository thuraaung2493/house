<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'house_id', 'address', 'street', 'township', 'region_id'
    ];

    protected $with = ['region'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    /**
     * @param column_name, keyword
     * @return query object
     */
    public function scopeWithAllInfo($query, $column, $keyword)
    {
        return $query->with(['house', 'house.houseDetail', 'house.user',
            'house.galleries' => function ($query) {
                $query->where('is_featured', 1);
            }])->where($column, $keyword);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query);
        $filters->apply($query);
    }
}
