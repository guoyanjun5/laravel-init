<?php

namespace App\Http\Requests\Api\V1\User;

use App\Http\Requests\Api\V1\BaseRequest;

/**
 * @property  int   $userId
 */
class UserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'userId' => 'required'
        ];
    }
}
