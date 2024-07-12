<?php

namespace app\exception;

use app\helper\ResponseTrait;
use Throwable;
use Webman\Exception\ExceptionHandlerInterface;
use Webman\Http\Request;
use Webman\Http\Response;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use ResponseTrait;

    // 记录日志
    public function report(Throwable $exception)
    {
        // TODO: Implement report() method.
    }

    // 渲染返回
    public function render(Request $request, Throwable $exception): Response
    {
        $is_debug = config('app.debug');
        return $is_debug ? $this->fail($exception->getMessage(), $exception->getCode()) : $this->serverError();
    }
}