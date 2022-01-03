<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class SellerLoginRequest extends FormRequest
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
            'email'      => 'required|max:255|email',
            'password'      => 'required|max:255',
        ];
    }
}
