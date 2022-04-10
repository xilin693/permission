<?php

namespace app\validate;

use king\lib\Valid;

class Login
{
    public static function check($data)
    {
        $valid = Valid::getClass($data);
        $valid->addRule('code', 'required');
        $valid->addRule('username', 'required|length,[2,20]', '用户名');
        $valid->addRule('password', 'required|minLength,5', '密码');
        $valid->addRule('captcha', 'required|size,3|checkCaptcha', '验证码');
        $valid->response();
    }
}