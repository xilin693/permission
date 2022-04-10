<?php

namespace app\helper;

class Menu
{
    public static function getTree($rs)
    {
        $tree = [];
        $rs = array_column($rs, NULL, 'id');
        foreach ($rs as $value) {
            if (isset($rs[$value['pid']])) {
                $rs[$value['pid']]['sub_menu'][] = &$rs[$value['id']];
            } else {
                $tree[] = &$rs[$value['id']];
            }
        }

        return $tree;
    }
}