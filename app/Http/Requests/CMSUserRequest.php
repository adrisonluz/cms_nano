<?php

namespace NanoCMS\Http\Requests;

use NanoCMS\Http\Requests\Request;
use NanoCMS\User;

class UserRequest extends Request
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
        /*
        $user = User::find($this->users);

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,' . $user->id,
            'password' => 'required|confirmed|min:6,' . $user->id,
        ];
        */

        $regras = [
            'name'       => 'required|max:255',
            'password'   => 'required|confirmed',
        ];

        if ( $this->id) {
            $user = User::find($this->id);
            $regras['email']      = 'required|email|unique:users,email,' . $user->id;
        }else{
            $regras['email']      = 'required|email|unique:users,email';
        }

        return $regras;
    }
}