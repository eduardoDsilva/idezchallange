<?php

namespace App\Http\Requests;

use App\Rules\TransactionAccountType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'type' => ['required', Rule::in(['Pagamento de Conta', 'Depósito', 'Transferência', 'Recarga de Celular', 'Compra (Crédito)'])],
            'account_id' => ['required', 'exists:App\Account,id'],
            'password' => ['required',  new TransactionAccountType()]
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'data' => $validator->errors()
        ]));
    }
}
