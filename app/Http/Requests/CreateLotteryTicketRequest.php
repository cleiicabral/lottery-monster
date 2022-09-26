<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateLotteryTicketRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:80',
            'numbers' => 'required|array|size:6',
            'numbers.*' => 'integer|numeric'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error'=>$validator->errors()->first()],400));
    }

    public function messages()
    {
        return [
            'name.required' => 'It is mandatory to fill in the name field.',
            'name.string' => 'The name field must be of type String.',
            'name.min' => 'The name field must be at least 5 characters long.',
            'name.max' => 'The name field must have a maximum of 80 characters.',
            'numbers.required' => 'It is mandatory to fill in the name field.',
            'numbers.array' => 'The numbers field must be of type Array.',
            'numbers.size' => 'The numbers field must have at least 6 positions.',
            'numbers.*.numeric' => 'The numbers array data must be of type numerics and integers.',
            'numbers.*.integer' => 'The numbers array data must be of type numerics and integers.',
        ];
    }
}
