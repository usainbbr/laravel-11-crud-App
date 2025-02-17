<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>['required','max:255','string'],
            'last_name'=>['required','max:255','string'],
            'phone'=>['required','max:255','string','max:14'],
            'bank_account_number'=>['required','numeric'],
            'image'=>['nullable','image','max:3000'],
            'about'=>['nullable','string','max:500'],
            'email'=>['required','email'],
        ];
    }
}
