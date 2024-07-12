<?php

namespace app\middleware;

use app\helper\ResponseTrait;
use app\service\JwtService;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    use ResponseTrait;

    public function process(Request $request, callable $handler): Response
    {
        try {
            $user_id = JwtService::getCurrentId();
            $request->user_id = $user_id;
        } catch (\Exception $exception) {
            return $this->unauthorized();
        }

        return $handler($request);
    }


}