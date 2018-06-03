<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'address' => 'required|string',
            'phone_no' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2000',
        ];
    }
}
