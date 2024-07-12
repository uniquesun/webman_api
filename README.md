# 为什么选择webman

* webman是常驻内存的框架
* 带数据库查询业务，webman单机吞吐量达到39万QPS，比传统php-fpm架构的laravel框架高出近80倍。
* 学习成本极低，代码书写与传统框架没有区别。

# 什么是webman

* webman是一款基于workerman开发的高性能HTTP服务框架。webman用于替代传统的php-fpm架构，提供超高性能可扩展的HTTP服务。
* 你可以用webman开发网站，也可以开发HTTP接口或者微服务。
* webman还支持自定义进程，可以做workerman能做的任何事情，例如websocket服务、物联网、游戏、TCP服务、UDP服务、unix socket服务等等。

特点：

* 高稳定性。webman基于workerman开发，workerman一直是业界bug极少的高稳定性socket框架
* 超高性能。webman性能高于传统php-fpm框架10-100倍左右，比go的gin echo等框架性能高一倍左右。
* 高复用。无需修改，可以复用绝大部分composer组件及类库。
* 高扩展性。支持自定义进程，可以做workerman能做的任何事情。
* 超级简单易用，学习成本极低，代码书写与传统框架没有区别。

注意点：

* 不要执行exit die语句。执行die或者exit会使得进程退出并重启，导致当前请求无法被正确响应。
* 不要执行pcntl_fork函数。pcntl_fork用户创建一个进程，这在webman中是不允许的。

# 怎么使用webman

## 路由
* 可以用默认路由：控制器 + 方法
* 闭包路由
```php
// 可选参数
Route::any('/user[/{name}]', function ($request, $name = null) {
   return response($name ?? 'tom');
});
```

## 中间件

## 控制器
app.controller_reuse 控制控制器复用与否
* 不复用控制器：每个请求都会重新new一个新的控制器实例，请求结束后释放该实例，并回收内存。所以性能会比复用控制器略差(helloworld压测性能差10%左右，带业务可以基本忽略)
* 复用控制器：复用的话一个进程只new一次控制器，请求结束后不释放这个控制器实例，当前进程的后续请求会复用这个实例

## 请求
```php
// 请求头
$request->header();
$request->header('host');
$request->host();
$request->method();
$request->uri(); // 包括path和queryString部分。
$request->path();
$request->queryString();
$request->url();
$request->fullUrl(); 
$request->getRemoteIp();
$request->getRemotePort();
$request->getRealIp($safe_mode=true);
$request->expectsJson();
// 请求体
$request->all(); // 获得所有输入
$request->input('name', $default_value); // 从post get 的集合中获取某个值
$only = $request->only(['username', 'password']);
$except = $request->except(['avatar', 'age']);
$request->get();
$name = $request->get('name', $default_name);
$request->post();
$request->post('name');
// cookie
$request->cookie();
$request->cookie('name');
// 文件
$request->file();
$request->file('avatar');
```

## 响应
```php
function response($body = '', $status = 200, $headers = array())
{
    return new Response($status, $headers, $body);
}

return json(['code' => 0, 'msg' => 'ok']);
```

## 配置
```php
config('app.debug');
```

## 数据库
### 查询构造器
```php
use support\Db;
$email = Db::table('users')->where('name', 'John')->value('email');
$titles = Db::table('roles')->pluck('title');
$roles = Db::table('roles')->pluck('title', 'id');
$user = Db::table('users')->where('name', 'John')->first();
$users = Db::table('user')->select('name', 'email as user_email')->get();
$users = Db::table('users')->get();
$email = Db::table('user')->select('nickname')->distinct()->get();

Db::table('users')->orderBy('id')->chunkById(100, function ($users) {
    foreach ($users as $user) {
        //
    }
});
```


# 项目API

* 验证码
    * 图像验证码
    * 手机验证码
    * 邮箱验证码
* 登录/注册
* 用户
    * id username email phone password avatar
* RBAC
* 评论
* 待办
* 消息通知
* 文件上传oss


