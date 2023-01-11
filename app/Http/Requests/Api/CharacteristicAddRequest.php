<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CharacteristicAddRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:characteristics',
            'name' => 'required|string',
            'validation' => 'required|string',
            'is_filterable' => 'required|boolean',
            'is_required' => 'required|boolean',
        ];
    }
}
