<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
			'postal_code' => ['required', 'integer', 'digits:7'],
			'region' => ['required', 'string', 'max:191'],
			'city' => ['required', 'string', 'max:191'],
			'street' => ['required', 'string', 'max:191'],
			'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
        ];
    }
}
