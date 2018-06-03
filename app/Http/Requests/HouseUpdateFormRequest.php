<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'house_type_id' => 'required|integer',
            'period' => 'required',
            'price' => 'required|integer',
            'area' => 'required',
            'rooms' => 'required',
            'description' => 'required',
            'address' => 'required',
            'street' => 'required',
            'township' => 'required',
            'region' => 'required|integer',
            'building_year' => 'required',
            'bathrooms' => 'required',
            'bedrooms' => 'required',
            'parking' => 'required|boolean',
            'water' => 'required|boolean',
            'exercise_room' => 'required|boolean',
            'features' => 'required|nullable',
            'feature_image' => 'image|mimes:jpeg,jpg,png|max:2000',
            'images*' => 'image|mimes:jpeg,jpg,png|max:2000',
            // 'floor_images*' => 'required|image|mimes:jpeg,jpg,png|max:2000','
        ];
    }
}
