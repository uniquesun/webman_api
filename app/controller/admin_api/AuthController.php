<?php

namespace app\controller\admin_api;

use app\controller\Controller;
use app\model\AdminUser;
use app\service\HashService;
use app\service\JwtService;
use app\validate\admin\auth\LoginValidate;
use app\validate\admin\auth\RegisterValidate;
use support\Log;
use support\Request;

class AuthController extends Controller
{

    public function register(Request $request, RegisterValidate $validate): \support\Response
    {
        $username = $request->post('username');
        $password = $request->post('password');

        if (!$validate->check($request->all())) {
            return $this->validator($validate->getError());
        }

        $adminUser = AdminUser::create([
            'username' => $username,
            'password' => HashService::make($password)
        ]);

        return $this->generateToken($adminUser->toArray());
    }

    public function login(Request $request, LoginValidate $validate): \support\Response
    {
        $username = $request->post('username');
        $password = $request->post('password');

        if (!$validate->check($request->all())) {
            return $this->validator($validate->getError());
        }

        $adminUser = AdminUser::query()->where('username', $username)->first();
        if (!$adminUser) return $this->notFound('账号不存在');
        if (!HashService::check($password, $adminUser->password)) return $this->validator('密码错误');

        return $this->generateToken($adminUser->toArray());

    }

    public function refresh(): \support\Response
    {
        try {
            $token = JwtService::refreshToken();
            return $this->success($token);
        } catch (\Exception $exception) {
            return $this->unauthorized();
        }
    }

    public function logout(): \support\Response
    {
        // todo
        return $this->msg('退出登录成功');
    }

    protected function generateToken($user): \support\Response
    {
        $token = JwtService::generateToken($user);
        return $this->success([
            'token' => $token,
            'user' => $user,
        ]);
    }


}