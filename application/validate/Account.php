<?php

namespace app\validate;

use king\lib\Valid;

class Account
{
    public static function check($data, $current = '')
    {
        $data = is_array($data) ? $data : ['id' => $data];
        $valid = Valid::getClass($data, $current);
        $scene = [
            'search' => ['status'],
            'update' => ['id', 'realname', 'avatar', 'role_ids', 'admin'],
            'password' => ['id', 'old_password', 'password', 'password2'],
            'reset' => ['id', 'password', 'password2'],
            'delete' => ['id'],
            'detail' => ['id']
        ];
        $valid->setScene($scene);
        $valid->hideSceneField('save', ['id', 'old_password']);
        if ($current == 'password') {
            $valid->addRule('id', 'checkId|checkMe', '用户id'); // 更新密码时需要判断是否是本人
        } else {
            $valid->addRule('id', 'checkId', '用户id');
        }
        
        $valid->addRule('status', 'in,[1,-1]', '用户状态');
        $valid->addRule('username', 'required|minLength,5|alphaNum', '用户名');
        $valid->addRule('realname', 'required|minLength,2|chs', '真实姓名');
        $valid->addRule('old_password', 'required|minLength,5', '原密码');
        $valid->addRule('password', 'required|minLength,6', '密码');
        $valid->addRule('password2', 'required|confirm,password', '确认密码');
        $valid->addRule('avatar', 'ext,[png,jpg]', '头像地址');
        $valid->addRule('admin', 'required|in,[0,1]', '是否超管');
        $valid->addRule('role_ids', 'requireIf,admin,0', '角色id');
        $valid->response();
    }
}
