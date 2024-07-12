<?php

namespace app\validate\admin\auth;

use think\Validate;

class RegisterValidate extends Validate
{
    // todo unique
    protected $rule = [
        'username' => 'require|min:2|max:10',
        'password' => 'require|min:6|max:12',
    ];

    protected $message = [
        'username.require' => '用户名必须',
        'username.unique' => '用户名已存在',
        'username.min' => '用户名最少不能超过2个字符',
        'username.max' => '用户名最多不能超过10个字符',
        'password.require' => '密码必须',
        'password.min' => '密码最少6个字符',
        'password.max' => '密码最多不能超过12个字符',
    ];
}