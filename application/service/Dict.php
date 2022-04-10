<?php

namespace app\service;

use king\lib\exception\BadRequestHttpException;
use app\model\Dict as DictModel;
use app\cache\Dict as DictCache;
use app\helper\Param as ParamHelper;

class Dict
{
    public static function getList($data)
    {
        return DictModel::field(['id', 'name', 'cache_key'])->page($data['per_page'], $data['page']);
    }

    public static function getInfo($id)
    {
        return DictModel::where('id', $id)->find();
    }

    public static function save($data)
    {
        $count = DictModel::where('name', $data['name'])->orWhere('cache_key', $data['cache_key'])->count();
        if ($count > 0) {
            throw new BadRequestHttpException('字典名称或key已存在');
        } else {
            $data['item'] = json_encode($data['item']);
            $rs = DictModel::save($data, DictModel::$fields);
            if ($rs) {
                return DictCache::set($data['cache_key'], $data['item']);
            }
        }
    }

    public static function update($data)
    {
        $count = DictModel::where('id', '<>', $data['id'])->andWhere(function ($query) use ($data) {
            $query->where('name', $data['name']);
            $query->orWhere('cache_key', $data['cache_key']);
        })->count();
        if ($count > 0) {
            throw new BadRequestHttpException('字典名称或key已存在');
        }

        $old_cache_key = DictModel::field(['cache_key'])->where('id', $data['id'])->value();
        $data['item'] = json_encode($data['item']);
        $rs = DictModel::save($data, DictModel::$fields);
        if ($rs) {
            DictCache::set($data['cache_key'], $data['item']);
            if ($old_cache_key != $data['cache_key']) { // 缓存key更新,则删除旧缓存
                DictCache::del($old_cache_key);
            }
        }
    }

    public static function delete($id)
    {
        $key = DictModel::field(['cache_key'])->where('id', $id)->value();
        $rs = DictModel::where('id', $id)->delete();
        if ($rs) {
            return DictCache::del($key);
        }
    }
}
