<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserUpdate extends FormRequest
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
        $id = Auth::user()->id;

        return [
            'name'                    => 'required|string|min:1',
            'username'                => 'required|string|min:2|max:60|not_in:www,support,admin|unique:users,username,'.$id,
            'email'                   => 'required|email|max:255|unique:users,email,'.$id,
        ];
    }
}
