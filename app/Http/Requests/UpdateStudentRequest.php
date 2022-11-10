<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
     *
     */



    public function rules()
    {

        return [
            'id'           => "exists:students,id",
            "full_name"    => "required|string|min:3|max:15",
            "phone_number" => "required|string|". Rule::unique('students')->ignore($this->id),
            "country_code" => "string|nullable",
            "country"      => "string|nullable",
            "email"        => "email|". Rule::unique('students')->ignore($this->id),
            "gender"       => "required|integer|" . Rule::in([1, 2]),
            "is_married"   => "boolean",
            "have_child"   => "boolean|declined_if:is_married,0"

        ];
    }


    public function messages()
    {
        return [
            'id.exists'              => "id doesn't exists",
            'full_name.required'     => "Full name is required.",
            'full_name.string'       => "Full name must be string.",
            'full_name.min'          => "Full name should be at least 3 letters.",
            'full_name.max'          => "Full name should be at most 15 letters.",
            'phone_number.required'  => "Phone number is required.",
            'phone_number.digits'    => "Phone number must be exactly 11 numbers.",
            'phone_number.unique'    => "Phone number already taken.",
            'email.email'            => "Please enter a valid email.",
            'email.unique'           => "Email already taken.",
            'gender.unique'          => "Please enter your gender.",
            'gender.in'              => "Gender must be 1 or 2",
            'is_married.boolean'     => "Please enter a boolean",
            'have_child.boolean'     => "Please enter a boolean"
        ];
    }
    public function validationData()
    {
        return  array_merge($this->all(), ['id' => $this->route('id')]);
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'message' => implode(',', $validator->errors()->all())
        ], 422));
    }
}
