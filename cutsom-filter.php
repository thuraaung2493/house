<?php

public function setFilterValues(SearchRequest $request)
    {
        $this->min_price = $request->min_price;
        $this->max_price = $request->max_price;
        $this->type_id = $request->type_id;
        $this->min_area_range = $request->min_area_range;
        $this->max_area_range = $request->max_area_range;
        $this->region_id = $request->region_id;
    }

public function searching(SearchRequest $request, Array $keywords)
    {
        if (count($keywords) != 0) {
            // 6
            if ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // 5
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('min_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);

            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('region_id') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);

            } elseif ($request->filled('min_price') && $request->filled('region_id') && $request->filled('type_id') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);

            } elseif ($request->filled('region_id') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, max_price, min_area, type
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('region') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //4 min_price, max_price, min_area, type
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('min_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, max_price, max_area, type
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, max_price, type, region
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, min_area, max_area, region
            } elseif ($request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('region_id') && $request->filled('min_price')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['price', '>=', $this->min_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //max_price, min_area, max_area, region
            } elseif ($request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('region_id') && $request->filled('max_price')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['price', '<=', $this->max_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_area, max_area, type, region
            } elseif ($request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('region_id') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, min_area, type, region
            } elseif ($request->filled('min_price') && $request->filled('min_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //max_price, max_area, type, region
            } elseif ($request->filled('max_price') && $request->filled('max_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, max_area, type, region
            } elseif ($request->filled('min_price') && $request->filled('max_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //max_price, min_area, type, region
            } elseif ($request->filled('max_price') && $request->filled('min_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, max_price, min_area, region
            } elseif ($request->filled('min_price') && $request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                //min_price, max_price, min_area, max_area
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, min_area, max_area, type
            } elseif ($request->filled('min_price') && $request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //max_price, min_area, max_area, type
            } elseif ($request->filled('max_price') && $request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //3 min_price, max_price, type
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, max_price, min_area
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('min_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_price, min_area, max_area
            } elseif ($request->filled('min_price') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, max_area, type
            } elseif ($request->filled('min_price') && $request->filled('max_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                //min_price, type, region
            } elseif ($request->filled('min_price') && $request->filled('region_id') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // max_price, min_area, max_area
            } elseif ($request->filled('max_price') && $request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price, max_area, type
            } elseif ($request->filled('max_price') && $request->filled('type_id') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price, type, region
            } elseif ($request->filled('max_price') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_price, max_price, region
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_area, max_area, type
            } elseif ($request->filled('min_area_range') && $request->filled('max_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_area, type, region
            } elseif ($request->filled('min_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_price, min_area, region
            } elseif ($request->filled('min_price') && $request->filled('min_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // max_area, type, region
            } elseif ($request->filled('max_area_range') && $request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_price, max_area, region
            } elseif ($request->filled('min_price') && $request->filled('max_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_price, max_price, max_area
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price, min_area, type
            } elseif ($request->filled('max_price') && $request->filled('min_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price, min_area, region
            } elseif ($request->filled('max_price') && $request->filled('min_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_area, max_area, region
            } elseif ($request->filled('min_price') && $request->filled('max_price') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_price, max_price
            } elseif ($request->filled('min_price') && $request->filled('max_price')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['price', '<=', $this->max_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_price min_area
            } elseif ($request->filled('min_price') && $request->filled('min_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_price max_area
            } elseif ($request->filled('min_price') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price min_area
            } elseif ($request->filled('max_price') && $request->filled('min_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price max_area
            } elseif ($request->filled('max_price') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_price type
            } elseif ($request->filled('min_price') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price type
            } elseif ($request->filled('max_price') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_area max_area
            } elseif ($request->filled('min_area_range') && $request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // min_area type
            } elseif ($request->filled('min_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                        ['house_type_id', '<=', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_area type
            } elseif ($request->filled('max_area_range') && $request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '<=', $this->max_area_range],
                        ['house_type_id', '<=', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);
                // max_price region
            } elseif ($request->filled('max_price') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where('price', '<=', $this->max_price);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // min_area region
            } elseif ($request->filled('min_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where('area', '>=', $this->min_area_range);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // max_area region
            } elseif ($request->filled('max_area_range') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where('area', '<=', $this->max_area_range);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);
                // type region
            } elseif ($request->filled('type_id') && $request->filled('region_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where('house_type_id', $this->type_id);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);

            } elseif ($request->filled('min_price')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '>=', $this->min_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('max_price')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['price', '<=', $this->max_price],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('type_id')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['house_type_id', $this->type_id],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('min_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '>=', $this->min_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('max_area_range')) {

                $results = Location::with(['house' => function ($query) {
                    $query->where([
                        ['area', '<=', $this->max_area_range],
                    ]);
                }])->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            } elseif ($request->filled('region_id')) {

                $results = Location::with('house')->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->where('region_id', $this->region_id)->paginate(6);

            } else {

                $results = Location::with('house')->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    }
                })->paginate(6);

            }

        }

        return $results;
    }
