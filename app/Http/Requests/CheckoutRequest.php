<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            //............. The Request  Of The Checkout ............//
            'billing_email' => 'required|email',
            'billing_country' => 'required',
            'billing_first_name' => 'required',
            'billing_address_1' => 'required',
            'billing_address_2' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_company' => 'required',
            'billing_postcode' => 'required',
            'billing_phone' => 'required',
            //............. The Request  Of The Checkout ............//

        ];
    }
}
