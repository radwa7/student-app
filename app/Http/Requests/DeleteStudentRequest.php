<?php

namespace App\Http\Requests;

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DeleteStudentRequest extends FormRequest
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
            'id'           => "exists:students,id"
        ];
    }


    public function messages()
    {
        return [
            'id.exists'      => "id doesn't exists"
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
