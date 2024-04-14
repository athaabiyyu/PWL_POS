<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'level_id' => 'required',
            'username' => 'bail|required|unique:m_user|min:5',
            'nama' => 'bail|required|max:100',
            'password' => 'bail|required|min:6|max:10',
        ];
    }
}
