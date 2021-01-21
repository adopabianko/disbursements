<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'role_id' => 'required',
                    'name' => 'required|unique:users',
                    'email' => 'required|email',
                    'password' => 'required|confirmed|min:8',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'role_id' => 'required',
                    'name' => ['required', Rule::unique('users')->ignore($this->POST('email'),'email')],
                    'email' => 'required|email',
                    'password' => 'nullable|confirmed|min:8|required_with:password_confirmation',
                ];
            default:break;
        }
    }
}
