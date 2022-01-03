<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class JunkSellerRequest extends FormRequest
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
            'junk_id' => 'required',
            'seller_address_id' => 'required'
        ];
    }
}
