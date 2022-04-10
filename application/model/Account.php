<?php

namespace app\model;

use king\lib\exception\BadRequestHttpException;
use king\Model;
use app\model\Role as RoleModel;

class Account extends Model
{
    protected static $table = 'sys_user';
    public static $date_time = ['create_time', 'update_time'];
    public static $insert_time = ['create_time', 'update_time'];
    public static $update_time = ['update_time'];
    public static $update_fields = ['username', 'realname', 'avatar', 'role_ids', 'status', 'admin'];

    public static function getStatusAttr($value)
    {
        $status = [1 => '正常', -1 => '锁定'];
        return [$status[$value] ?? '', 'status_text'];
    }

    public static function getRoleIdsAttr($value)
    {
        $roles = RoleModel::field(['name'])->where('id', 'in', $value)->column();
        return [implode(',', $roles), 'role_text'];
    }

    public static function getAdmin($id)
    {
        return self::field(['admin'])->where('id', $id)->value();
    }

    public static function checkUserExist($id)
    {
        $count = self::where('id', $id)->count();
        if ($count < 1) {
            throw new BadRequestHttpException('用户不存在');
        }
    }
}
