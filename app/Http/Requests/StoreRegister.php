<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreRegister extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => 'nullable|image',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:3',
            'name' => 'required|string', 
            'surname' => 'nullable|string|max:50',
            'age' => 'nullable|integer',
            'description' => 'nullable|string'
        ];
    }
}