<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreContactRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'phone' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.min' => 'Nome deve conter no mínimo 3 caracteres',
            'name.max' => 'Nome deve conter no máximo 255 caracteres',
            'name.string' => 'Nome deve ser um texto',
            'email.required' => 'Email é obrigatório',
            'email.min' => 'Email deve conter no mínimo 3 caracteres',
            'email.max' => 'Email deve conter no máximo 255 caracteres',
            'phone.required' => 'Telefone é obrigatório',
            'phone.min' => 'Telefone deve conter no mínimo 3 caracteres',
            'phone.max' => 'Telefone deve conter no máximo 255 caracteres',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' =>$validator->errors()->first(),
            'data' => null,
        ], 500));
    }

}
