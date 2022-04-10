<?php

namespace app\model;

use king\Model;

class Dict extends Model
{
    protected static $table = 'sys_dict';
    public static $fields = ['id', 'name', 'cache_key', 'item'];
}