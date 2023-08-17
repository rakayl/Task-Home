<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Withdrawal extends FormRequest
{
    public function rules()
    {
        return [
            'order_id'   => 'required|string|unique:wallets,order_id',
            'amount'   => 'required|numeric',
            'timestamp'   => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => 0, 'message'  => $validator->errors()->all()], 200));
    }

    public function validationData()
    {
        return $this->json()->all();
    }
}
