<?php

namespace NanoCMS\Http\Requests;

use NanoCMS\Http\Requests\Request;
use NanoCMS\CMSUser;

class CMSUserRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $regras = [
            'name' => 'required|max:255',
            'password' => 'required|confirmed',
        ];

        if ($this->id) {
            $user = CMSUser::find($this->id);
            $regras['email'] = 'required|email|unique:users,email,' . $user->id;
        } else {
            $regras['email'] = 'required|email|unique:users,email';
        }

        return $regras;
    }

}
