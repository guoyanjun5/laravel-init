<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Hashing\Hasher as Hash;
use App\Http\Requests\Api\V1\User\UserLoginRequest;

class AuthController extends BaseController
{
    private $hash;

    private $userService;

    public function __construct(UserService $userService, Hash $hash)
    {
        $this->hash = $hash;
        $this->userService = $userService;
    }

    /**
     * 登录
     *
     * @return json
     */
    public function login(UserLoginRequest $request)
    {
        if($userInfo = $this->userService->passwordLogin($request->name, $request->password)){
            $credentials = $request->only('name', 'password');
            if ($token = auth('api')->attempt($credentials)) {
                return $this->data(array_merge($this->respondWithToken($token), $userInfo));

            }
        }
        return $this->error();
    }

    /**
     * 获取通过身份验证的用户信息
     *
     * @return json
     */
    public function me()
    {
        return $this->data(auth('api')->user());
    }

    /**
     * 退出登录
     *
     * @return json
     */
    public function logout()
    {
        if ($token = auth('api')->getToken()) {
            try {
                auth('api')->invalidate($token);
            } catch (Exception $e) {
                return $this->error();
            }
        }

        return $this->success();
    }

    /**
     * 刷新token
     *
     * @return json
     */
    public function refresh()
    {
        return $this->data($this->respondWithToken(auth('api')->refresh()));
    }

    /**
     * 获取token
     *
     * @param  string  $token
     *
     * @return josn
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 12
        ];
    }
}
