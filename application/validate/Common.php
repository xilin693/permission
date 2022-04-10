<?php

namespace app\validate;

use king\lib\Valid;
use king\lib\Captcha;
use app\helper\Verify as VerifyHelper;

class Common
{
    public static function checkId($id)
    {
        $data['id'] = $id;
        $valid = Valid::getClass($data);
        $valid->addRule('id', 'required|int|gt,0', 'id');
        $valid->response();
    }

    public static function checkMe($id, $valid)
    {
        if (!VerifyHelper::checkMe($id)) {
            $valid->setError('只能修改自己的密码');
        }
    }

    public function checkCaptcha($value, $valid)
    {
        $capt = Captcha::getClass();
        if ($capt->valid($value, $valid->data['code']) != true) {
            $valid->setError('验证码错误');
        }
    }

    public static function checkRoleExist($value, $valid)
    {
        $keys = array_keys($valid->data);
        $intersect = array_intersect($keys, ['id','name', 'permission_ids', 'status']);
        if (count($intersect) < 2) {
            $valid->setError('更新的内容不能为空');
        }
    }
}