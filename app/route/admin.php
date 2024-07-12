<?php

use Webman\Route;

Route::get('/admin/v1/test',[\app\controller\TestController::class,'index']);

Route::post('/admin/v1/auth/login', [\app\controller\admin_api\AuthController::class, 'login']);
Route::put('/admin/v1/auth/refresh', [\app\controller\admin_api\AuthController::class, 'refresh']);

Route::group('/admin/v1', function () {

    // auth
    Route::group('/auth', function () {
        Route::post('/register', [\app\controller\admin_api\AuthController::class, 'register']);
        Route::delete('/logout', [\app\controller\admin_api\AuthController::class, 'logout']);

    });

    // 后台用户
    Route::group('/admin', function () {
        Route::get('/me', [\app\controller\admin_api\AdminUserController::class, 'me']);
        Route::get('', [\app\controller\admin_api\AdminUserController::class, 'index']);
        Route::get('/{id}', [\app\controller\admin_api\AdminUserController::class, 'show']);
        Route::put('/{id}', [\app\controller\admin_api\AdminUserController::class, 'update']);
        Route::delete('/{id}', [\app\controller\admin_api\AdminUserController::class, 'destroy']);
    });

    // RBAC

    // 待办

    // 评论

    // 系统通知

    // 文件上传


})->middleware([
    app\middleware\AuthMiddleware::class,
]);