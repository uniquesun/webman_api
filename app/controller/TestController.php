<?php

namespace app\controller;

use app\model\AdminUser;

class TestController extends Controller
{
    public function index()
    {
        $user = AdminUser::query()->where('id', 2)->first();
        return $this->success($user);
    }
}