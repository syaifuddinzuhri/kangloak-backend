<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;
use Illuminate\Http\Request;

class PaymentAccountRequest extends FormRequest
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
        if (Request::isMethod('post')) {
            return [
                'name'              => 'required',
                'code'              => 'required|unique:payment_accounts',
                'account_name'      => 'required',
                'account_number'    => 'required|unique:payment_accounts',
                'logo'              => 'image|mimes:jpeg,png,jpg|max:2048',
            ];
        }
        if (Request::isMethod('put')) {
            return [
                'name'              => 'required',
                'code'              => 'required|unique:payment_accounts,id',
                'account_name'      => 'required',
                'account_number'    => 'required|unique:payment_accounts,id',
                'logo'              => 'image|mimes:jpeg,png,jpg|max:2048',
            ];
        }
    }
}
