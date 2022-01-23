<?php

namespace App\Http\Requests;

use App\Rules\UserAccountType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AccountRequest extends FormRequest
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
            'agency' => 'required|numeric',
            'number' => 'required|numeric',
            'digit' => 'required|numeric',
            'name' => 'required',
            'social_reason' => 'nullable',
            'type' => ['required',Rule::in(['Company', 'Person'])],
            'document' => 'required|numeric|unique:accounts',
            'user_id' => ['required','exists:App\User,id', new UserAccountType()]
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
