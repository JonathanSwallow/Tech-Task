<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class lookUpRequest extends FormRequest
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
            'username' => ['nullable', 'string', 'required_without:id', 'prohibits:id'],
            'id' => ['nullable', 'string', 'required_without:username', 'prohibits:username'],
        ];
    }

    public function messages()
    {
        return [
            'username.required_without' => 'Either a username or an ID must be provided.',
            'id.required_without' => 'Either an ID or a username must be provided.',
            'username.prohibits' => 'You cannot provide both a username and an ID.',
            'id.prohibits' => 'You cannot provide both an ID and a username.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
