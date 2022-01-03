<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class SellerAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'district' => 'required',
            'city' => 'required',
            'provincy' => 'required',
            'postal_code' => 'required',
            'address' => 'required'
        ];
    }
}
