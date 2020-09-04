<?php

namespace App\Http\Requests\Api\V1\User;

use App\Http\Requests\Api\V1\BaseRequest;

/**
 * @property string   $name
 * @property string   $password
 */
class UserLoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required',
        ];
    }
}
