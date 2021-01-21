<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
                    'name' => 'required|unique:permissions',
                    'display_name' => 'required',
                    'description' => 'required',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => ['required', Rule::unique('permissions')->ignore($this->POST('name'),'name')],
                    'display_name' => 'required',
                    'description' => 'required',
                ];
            default:break;
        }
    }
}
