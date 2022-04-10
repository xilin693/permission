<?php

return [
    // 登录
    'get::captcha$' => 'captcha/index',
    'post::session$' => 'login/index',
    'delete::session$' => 'login/logout',

    // 账号
    'get::accounts$' => 'account/get',
    'post::accounts$' => 'account/add',
    'put::accounts/(\d+)$' => 'account/edit',
    'get::accounts/(\d+)$' => 'account/detail',
    'delete::accounts/(\d+)$' => 'account/delete',
    'put::accounts/(\d+)/password$' => 'account/alterPassword',
    'put::accounts/(\d+)/reset$' => 'account/resetPassword',

    // 菜单
    'get::menus$' => 'menu/get',
    'post::menus$' => 'menu/add',
    'get::menus/(\d+)$' => 'menu/detail',
    'put::menus/(\d+)$' => 'menu/edit',
    'delete::menus/(\d+)$' => 'menu/delete',

    // 角色
    'get::roles$' => 'role/get',
    'post::roles$' => 'role/add',
    'put::roles/(\d+)$' => 'role/edit',
    'delete::roles/(\d+)$' => 'role/delete',
    'get::roles/(\d+)$' => 'role/detail',
    'get::roles/menu$' => 'role/menu',

    // 字典
    'get::dicts' => 'dict/get',
    'post::dicts$' => 'dict/add',
    'put::dicts/(\d+)$' => 'dict/edit',
    'delete::dicts/(\d+)$' => 'dict/delete',
    'get::dicts/(\d+)$' => 'dict/detail',
];