<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //Extensive rules for Client creation
        //first_name and last_name always required
        //While phone or email are required if neither are provided
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];
        if($this->input('email')) {
            $rules = $rules + [
                'email' => 'email|max:255',
            ];
        } else if($this->input('phone')){
            $rules = $rules + [
                'phone' => 'string|max:15',
            ];
        } else {
            $rules = $rules + [
                'phone' => 'required_without:email',
                'email' => 'required_without:phone'
            ];
        }
        return $rules;
    }

    //custom validation message for user to see
    public function messages(): array
    {
        return [
            'phone.required_without' => 'Either phone or email must be provided.',
            'email.required_without' => 'Either phone or email must be provided.',
            'email.email' => 'The email must be a valid email address.',
        ];
    }
}
