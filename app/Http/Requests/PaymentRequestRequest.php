<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => 'required|integer',
            'to_users_id' => 'nullable|regex:(^([0-9]+,?\s*)+$)',
            'currencies_id' => 'required',
            'requested_amount' => 'required|numeric|gt:0|regex:(^\d{0,10}(\.\d{1,2})$)',
            'description' => 'required|min:4',
            'request_type' => ['required', 'regex:(payment|donation)'],
            'media' => ['image'],
            'title' => 'required|min:1|max:30|string',
            'date_due' => 'date|after_or_equal:today',
        ];
    }
}
