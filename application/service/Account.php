<?php

namespace app\service;

use king\lib\permission\LoginHelper;
use app\helper\Verify as VerifyHelper;
use king\lib\permission\RoleCache;
use king\lib\exception\BadRequestHttpException;
use app\model\Account as AccountModel;

class Account
{
    public static function getList($data)
    {
        $query = AccountModel::field();
        if (!empty($data['status'])) {
            $query->where('status', $data['status']);
        }

        return $query->page($data['per_page'], $data['page']);
    }

    public static function save($data)
    {
        $count = AccountModel::where('username', $data['username'])->count();
        if (!$count) {
            unset($data['password2']);
            $data['password'] = LoginHelper::crypt($data['password']);
            return AccountModel::save($data);
        } else {
            throw new BadRequestHttpException('用户名已存在');
        }
    }

    public static function update($id, $data)
    {
        AccountModel::checkUserExist($id);
        $rs = AccountModel::save($data, AccountModel::$update_fields);
        if ($rs && !empty($data['role_ids'])) {
            RoleCache::setRole($id, $data['role_ids']);
        }
    }

    public static function updatePassword($id, $data)
    {
        $count = AccountModel::where('id', $id)->where('password', LoginHelper::crypt($data['old_password']))->count();
        if ($count > 0) {
            unset($data['password2']);
            $data['password'] = LoginHelper::crypt($data['password']);
            return AccountModel::save($data, ['password']);
        } else {
            throw new BadRequestHttpException('旧密码错误');
        }
    }

    public static function resetPassword($id, $password)
    {
        AccountModel::checkUserExist($id);
        if (AccountModel::getAdmin(VerifyHelper::getMe())) {
            return AccountModel::where('id', $id)->update(['password' => LoginHelper::crypt($password)]);
        } else {
            throw new BadRequestHttpException('管理员才能重置密码');
        }
    }

    public static function delete($id)
    {
        if (!AccountModel::getAdmin($id)) {
            return AccountModel::where('id', $id)->delete();
        } else {
            throw new BadRequestHttpException('管理员不能删除');
        }
    }

    public static function getInfo($id)
    {
        return AccountModel::where('id', $id)->find();
    }
}
