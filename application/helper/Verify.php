<?php

namespace app\helper;

use king\lib\Cache;

class Verify
{
    public static function checkMe($id)
    {
        $uid = self::getMe();
        return ($uid == $id);
    }

    public static function getMe()
    {
        $key = H(C('permission.token_header'));
        return cache::get($key);
    }
}
