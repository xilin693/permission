<?php

namespace app\cache;

use king\lib\Cache;
use app\helper\Param as ParamHelper;

class Dict extends Cache
{
    private static $cache_prefix = 'dict:';

    public static function get($key)
    {
        return parent::get(self::$cache_prefix . $key);
    }

    public static function set($key, $value)
    {
        return parent::set(self::$cache_prefix . $key, $value);
    }

    public static function del($key)
    {
        return parent::del(self::$cache_prefix . $key);
    }
}