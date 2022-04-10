<?php

namespace app\model;

use king\Model;

class Role extends Model
{
    protected static $table = 'sys_role';
    public static $date_time = ['create_time', 'update_time'];
    public static $insert_time = ['create_time', 'update_time'];
    public static $update_time = ['update_time'];
    public static $update_fields = ['name', 'permission_ids', 'status'];

    public static function getStatusAttr($value)
    {
        $status = ['-1' => '禁用', '1' => '正常'];

        return [$status[$value] ?? '', 'status_text'];
    }
}