<?php

namespace Josmarh\JVZooIPN\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class JVZooIPNRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cverify' => 'required|string',
            'ccustemail' => 'required|email',
            'cproditem' => 'required|string',
            'ctransreceipt' => 'required|string',
            'ctransaction' => 'required|string',
            'ctransamount' => 'required',
            'caffitid' => 'nullable',
            'ccustcc' => 'nullable',
            'ccustname' => 'nullable',
            'ccuststate' => 'nullable',
            'cprodtitle' => 'nullable',
            'cprodtype' => 'nullable',
            'ctransaffiliate' => 'nullable',
            'ctranspaymentmethod' => 'nullable',
            'ctranstime' => 'nullable',
            'ctransvendor' => 'nullable',
            'cupsellreceipt' => 'nullable',
            'cvendthru' => 'nullable'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}