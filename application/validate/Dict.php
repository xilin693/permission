<?php

namespace app\validate;

use king\lib\Valid;

class Dict
{
    public static function check($data, $current = '')
    {
        $data = is_array($data) ? $data : ['id' => $data];
        $valid = Valid::getClass($data, $current);
        $scene = [
            'only_id' => ['id'],
            'item' => ['id', 'item']
        ];
        $valid->setScene($scene);
        $valid->hideSceneField('save', ['id', 'item']);
        $valid->hideSceneField('update', ['item']);
        $valid->addRule('id', 'checkId', 'id');
        $valid->addRule('name', 'required|length,[2,20]', '字典名称');
        $valid->addRule('cache_key', 'required|notEmpty');
        $valid->addRule('item', 'required|json', '字典项');
        $valid->response();
    }
}