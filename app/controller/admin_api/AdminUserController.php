<?php

namespace app\controller\admin_api;

use app\controller\Controller;
use app\model\AdminUser;
use app\service\HashService;
use Illuminate\Support\Facades\Hash;
use support\Db;
use support\Request;

class AdminUserController extends Controller
{
    public function me(Request $request)
    {
        $id = $request->user_id;

        $user = AdminUser::query()->where('id', $id)->first();

        return $this->success($user);
    }

    public function show($id): \support\Response
    {
        $user = AdminUser::query()->where('id', $id)->first();
        return $this->success(['user' => $user]);
    }

    public function index(Request $request): \support\Response
    {
        $page_size = $request->get('page_size', 10);
        $page = $request->get('page', 1);

        $adminUsers = AdminUser::query()->paginate($page_size, ['*'], 'page', $page);
        return $this->success($adminUsers);
    }


    public function update($id, Request $request): \support\Response
    {
        $psw = $request->post('password', '');
        $avatar = $request->post('avatar', '');
        $data = [];
        if ($psw) $data['password'] = HashService::make($psw);
        if ($avatar) $data['avatar'] = $avatar;

        AdminUser::query()->where('id', $id)->update($data);
        return $this->success([], '更新信息成功~');
    }

    public function destroy($id): \support\Response
    {
        AdminUser::query()->where('id', $id)->delete();
        return $this->success([], '注销后台用户成功~');
    }


}