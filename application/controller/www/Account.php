<?php

namespace app\controller\www;

use king\lib\Response;
use app\validate\Account as AccountValidate;
use app\validate\Page as PageValidate;
use app\service\Account as AccountService;
use app\helper\Param as ParamHelper;

class Account
{
    public function get()
    {
        $data = G();
        PageValidate::check($data);
        AccountValidate::check($data, 'search');
        $rs = AccountService::getList($data);
        $rs['rs'] = ParamHelper::hiddenField($rs['rs'], ['password']);
        Response::sendResponseJson(200, $rs);
    }

    public function add()
    {
        $data = P();
        AccountValidate::check($data, 'save');
        $rs = AccountService::save($data);
        Response::sendResponseJson(200, $rs);
    }

    public function edit($id)
    {
        $data = steam($id);
        AccountValidate::check($data, 'update');
        AccountService::update($id, $data);
        Response::sendResponseJson(200);
    }

    public function alterPassword($id)
    {
        $data = steam($id);
        AccountValidate::check($data, 'password');
        $rs = AccountService::updatePassword($id, $data);
        Response::sendResponseJson(200, $rs);
    }

    public function resetPassword($id)
    {
        $data = steam($id);
        AccountValidate::check($data, 'reset');
        $rs = AccountService::resetPassword($id, $data['password']);
        Response::sendResponseJson(200, $rs);
    }

    public function delete($id)
    {
        AccountValidate::check($id, 'delete');
        AccountService::delete($id);
        Response::sendResponseJson(200);
    }

    public function detail($id)
    {
        AccountValidate::check($id, 'detail');
        $row = AccountService::getInfo($id);
        $row = ParamHelper::hiddenField($row, ['password']);
        Response::sendResponseJson(200, $row);
    }
}
