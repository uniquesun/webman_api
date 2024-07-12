<?php

namespace app\service;

class HashService
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check($password, $hashedPassword): bool
    {
        if (strlen($hashedPassword) === 0) return false;
        return password_verify($password, $hashedPassword);
    }

}