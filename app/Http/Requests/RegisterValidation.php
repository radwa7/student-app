<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class RegisterValidation extends FormRequest
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
            "name"         => "required|string|min:3|max:15|unique:users,name",
            "email"        => "email|required|unique:users,email",
            "pass"         => "required|string|min:8",
            "re_pass"      => "required|string|min:8"
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => implode(',', $validator->errors()->all())
        ], 422));
    }
}
