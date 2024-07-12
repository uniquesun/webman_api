<?php

namespace app\service;

use Tinywan\Jwt\JwtToken;

class JwtService
{
    public static function generateToken($user): array
    {
        return JwtToken::generateToken($user);
    }

    public static function getCurrentId()
    {
        return JwtToken::getCurrentId();
    }

    public static function getCurrentUser()
    {
        return JwtToken::getUser();
    }

    public static function refreshToken(): array
    {
        return JwtToken::refreshToken();
    }

    public static function clear(): array
    {
        $extend = [
            'access_exp' => 0,
            'refresh_exp' => 0,
        ];
        return JwtToken::generateToken($extend);
    }
}