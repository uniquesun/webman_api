<?php

namespace app\controller\user_api;

use support\Request;

class CaptchaController
{
    public function phone(Request $request): \support\Response
    {
        return json([
            'code' => 0,
            'msg' => 'success',
            'data' => []
        ]);
    }

    public function email()
    {

    }

    public function image()
    {

    }

}