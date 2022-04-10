<?php

namespace app\validate;

use king\lib\Valid;

class Role
{
    public static function check($data, $current = '')
    {
        $data = is_array($data) ? $data : ['id' => $data];
        $valid = Valid::getClass($data, $current);
        $scene = [
            'save' => ['name', 'status'],
            'update' => ['id', 'name', 'permission_ids', 'status'],
            'menu' => ['id', 'permission_ids'],
            'delete' => ['id'],
            'detail' => ['id']
        ];
        $valid->setScene($scene);
        if ($current == 'update') {
            $valid->addRule('id', 'checkId|checkRoleExist', 'id'); // 更新时不能传空值,作单独判断
        } else {
            $valid->addRule('id', 'checkId', 'id');
        }
        $valid->addRule('name', 'required|length,[1,20]', '角色名称');
        $valid->addRule('permission_ids', 'json', '权限');
        $valid->addRule('status', 'in,[-1,1]', '状态');
        $valid->response();
    }
}
