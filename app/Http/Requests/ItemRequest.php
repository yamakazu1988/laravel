<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
			'name' => ['required', 'string', 'max:191'],
			'description' => ['required', 'string', 'max:191'],
			'price' => ['integer', 'regex:/^[0-9]|[1-9][0-9]+$/', 'digits_between:1,10'],
			'stock' => ['integer', 'regex:/^[0-9]|[1-9][0-9]+$/', 'digits_between:1,10'],
        ];
    }
}
