<?php
namespace App\Filters;

class HouseFilters extends Filters
{
    protected $filters = [
        'min_price', 'max_price', 'type_id', 'min_area_range',
        'max_area_range', 'region_id',
    ];

    public function min_price($price)
    {
        return $this->builder->where('price', '>=', $price);
    }

    public function max_price($price)
    {
        return $this->builder->where('price', '<=', $price);
    }

    public function type_id($type_id)
    {
        return $this->builder->where('house_type_id', $type_id);
    }

    public function min_area_range($area)
    {
        return$this->builder->where('area', '>=', $area);
    }

    public function max_area_range($area)
    {
        return$this->builder->where('area', '<=', $area);
    }

}
