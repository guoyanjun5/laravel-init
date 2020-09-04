<?php

namespace App\Traits;

trait JsonResponse
{
    
    protected function success($code = 0, $data = [], $msg = null)
    {
        return $this->response($code, $msg, $data);
    }

    protected function error($code = 1, $data = [], $msg = null)
    {
        return $this->response($code, $msg, $data);
    }

    protected function data($data = [], $code = 0, $msg = null)
    {
        return $this->response($code, $msg, $data);
    }

    protected function response($code, $msg, $data)
    {
        return response()->json([
            'code'  => $code,
            'msg'   => $msg ?? __(COMMON_CODE[$code]),
            'data'  => $data,
        ]);
    }
}
