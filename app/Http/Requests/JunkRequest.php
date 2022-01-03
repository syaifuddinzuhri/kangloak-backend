<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class JunkRequest extends FormRequest
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
            'junk_category_id' => 'required',
            'name'             => 'required',
            'weight'           => 'required',
            'price'            => 'required',
            'photo'            => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
