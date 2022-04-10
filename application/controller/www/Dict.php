<?php

namespace app\controller\www;

use king\lib\Response;
use app\validate\Page as PageValidate;
use app\validate\Dict as DictValidate;
use app\service\Dict as DictService;
use app\helper\Param as ParamHelper;

class Dict
{
    public function get()
    {
        $data = G();
        PageValidate::check($data);
        $rs = DictService::getList($data);
        Response::sendResponseJson(200, $rs);
    }

    public function add()
    {
        $data = P();
        DictValidate::check($data, 'save');
        $rs = DictService::save($data);
        Response::sendResponseJson(200, $rs);
    }

    public function edit($id)
    {
        $data = steam($id);
        DictValidate::check($data, 'update');
        DictService::update($data);
        Response::sendResponseJson(200);
    }

    public function delete($id)
    {
        DictValidate::check($id, 'only_id');
        DictService::delete($id);
        Response::sendResponseJson(200);
    }

    public function detail($id)
    {
        DictValidate::check($id, 'only_id');
        $rs = DictService::getInfo($id);
        $rs = ParamHelper::revertJson($rs, ['item']);
        Response::sendResponseJson(200, $rs);
    }
}
