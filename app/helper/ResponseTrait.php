<?php

namespace app\helper;

trait ResponseTrait
{
    public function response($data, $msg, $code, $is_success): \support\Response
    {
        return json([
            'success' => $is_success,
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    // 成功！
    public function success($data = [], $msg = 'success'): \support\Response
    {
        return $this->response($data, $msg, 200, true);
    }

    public function msg($msg = ''): \support\Response
    {
        return $this->response([], $msg, 200, true);
    }

    public function created($data = [], $msg = 'created'): \support\Response
    {
        return $this->response($data, $msg, 201, true);
    }

    // 失败~
    public function fail($msg = 'fail', $code = 400, $data = []): \support\Response
    {
        return $this->response($data, $msg, $code, false);
    }

    // 422
    public function validator($msg = '验证失败', $errors = []): \support\Response
    {
        return $this->fail($msg, 422, $errors);
    }

    // 401 登录状态过期
    public function unauthorized($msg = '登录过期，请重新登录'): \support\Response
    {
        return $this->fail($msg, 401);
    }


    // 客户端错误
    public function badRequest($msg = '客户端错误'): \support\Response
    {
        return $this->fail($msg);
    }

    // 403 权限不足
    public function forbidden($msg = '权限不足'): \support\Response
    {
        return $this->fail($msg, 403);
    }

    public function notFound($msg = '资源不存在'): \support\Response
    {
        return $this->fail($msg, 404);
    }

    // 429 请求太频繁
    public function tooManyRequest($msg = '请求太频繁'): \support\Response
    {
        return $this->fail($msg, 409);
    }

    // 服务器内部错误
    public function serverError($msg = '服务器内部错误'): \support\Response
    {
        return $this->fail($msg, 500);
    }


}