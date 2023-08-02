<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'string|min:3|max:255',
            'email' => 'email|min:3|max:255',
            'phone' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id é obrigatório',
            'name.min' => 'Nome deve conter no mínimo 3 caracteres',
            'name.max' => 'Nome deve conter no máximo 255 caracteres',
            'name.string' => 'Nome deve ser um texto',
            'email.min' => 'Email deve conter no mínimo 3 caracteres',
            'email.max' => 'Email deve conter no máximo 255 caracteres',
            'phone.min' => 'Telefone deve conter no mínimo 3 caracteres',
            'phone.max' => 'Telefone deve conter no máximo 255 caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
            'data' => null,
        ], 500));
    }

}
