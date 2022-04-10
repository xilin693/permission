<?php

use king\lib\Env;

return [
    'domain' => Env::get('app.domain'), // 配置站点名,前后端分离项目可不用配置
    'default_folder' => 'www',
    'default_page' => 'test/index',
    'suffix' => '.html',
    'auto_xss' => true,
    'show_error' => Env::get('app.show_error'),
    'error_file' => Env::get('app.error_file'),
    'sentry' => Env::get('sentry.enable', false),
    'log_error' => Env::get('app.log_error'),
    'use_composer'  => true,
    'only_route' => Env::get('app.only_route'),
    'timezone' => 'PRC',
    'valid_path' => 'Common',
    'locale' => 'en',
    'permission' => true, // 开启全局校验
    'auto_attr' => true,
    'post_json' => true
];
