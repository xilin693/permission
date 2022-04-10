<?php

namespace app\service;

use king\lib\exception\BadRequestHttpException;
use app\model\Role as RoleModel;
use app\model\Account as AccountModel;
use app\model\Menu as MenuModel;
use app\helper\Menu as MenuHelper;
use app\helper\Verify as VerifyHelper;
use king\lib\permission\RoleCache;

class Role
{
    public static function getList($status)
    {
        $query = RoleModel::field(['id', 'name', 'status', 'create_time', 'update_time']);
        if ($status !== null) {
            $query->where('status', $status);
        }

        return $query->orderby(['id' => 'desc'])->get();
    }
    
    public static function save($data)
    {
        $count = RoleModel::where('name', $data['name'])->count();
        if ($count < 1) {
            $time = time();
            $data['create_time'] = $time;
            $data['update_time'] = $time;
            return RoleModel::save($data);
        } else {
            throw new BadRequestHttpException('角色已存在');
        }
    }

    public static function update($id, $data)
    {
        $count = RoleModel::where('id', $id)->count();
        if ($count > 0) {
            $data['update_time'] = time();
            $rs = RoleModel::save($data);
            if ($rs && $data['permission_ids']) {
                RoleCache::setMenu($id, $data['permission_ids']);
            }
        } else {
            throw new BadRequestHttpException('角色不存在');
        }
    }

    public static function delete($id)
    {
        $count = AccountModel::whereRaw('find_in_set(?, role_ids)', [$id])->count();
        if ($count < 1) {
            return RoleModel::where('id', $id)->delete();
        } else {
            throw new BadRequestHttpException('该用户组下还有用户存在,无法删除');
        }
    }
    
    public static function getInfo($id)
    {
        return RoleModel::where('id', $id)->find();
    }

    public static function setStatus($id, $data, $allow)
    {
        return RoleModel::where('id', $id)->update($data, $allow);
    }

    public static function getRoleMenu()
    {
        $user_id = VerifyHelper::getMe();
        $role_ids = RoleCache::getRole($user_id);
        if ($role_ids == 'admin') {
            $rs = MenuModel::where('status', 1)->order(['sort' => 'desc'])->get();
        } else {
            $role_ids = explode(',', $role_ids);
            $permission_ids = RoleCache::getMenu($role_ids);
            $rs = MenuModel::where('id', 'in', $permission_ids)->order(['sort' => 'desc'])->get();
        }

        return MenuHelper::getTree($rs);
    }
}
