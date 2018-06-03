<?php

namespace App\Filters;

class LocationFilters extends Filters
{
    protected $filters = [
        'address', 'region_id'
    ];

    public function address($address)
    {
        // dd($address);
        $keywords = preg_split("/[\s,]+/", $address);
        // dd($keywords);
        return $this->builder->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('address', 'LIKE', "%{$keyword}%");
            }
        });
    }

    public function region_id($region_id)
    {
        return $this->builder->where('region_id', $region_id);
    }
}
