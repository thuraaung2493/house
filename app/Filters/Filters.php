<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
     * Construct filters for the request from your model
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Main filter apply
     */
    public function apply($builder)
    {
        // dd($builder);
        $this->builder = $builder;
        // dd($this->getFilter());
        foreach ($this->getFilter() as $filter => $value) {
            if (method_exists($this, $filter)) {
                // dd($this->$filter($value));
                $this->$filter($value); // keyword('yangon')
                // where('title', 'LIKE', "%{$value}%")
            }
        }
        // dd($this->builder);
        return $this->builder;
    }

    public function getFilter()
    {
        // dd($this->filters); //  [0 => "keyword", 1 => "min_price"]
        return array_filter($this->request->only($this->filters));
    }
}
