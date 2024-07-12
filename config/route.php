<?php

use Webman\Route;


require_once app_path('route/admin.php'); // 管理后台API
require_once app_path('route/user.php'); // 用户后台API
require_once app_path('route/web.php'); // web API

// 404
Route::fallback(function () {
    return json(['success' => false, 'code' => 404, 'msg' => "请求路径不存在", 'data' => []]);
});

// 关闭默认路由
Route::disableDefaultRoute();





