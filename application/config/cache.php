<?php

use king\lib\Env;

return [
    'redis' => [
        'host' => Env::get('cache.host'),
        'port' => Env::get('cache.port'),
        'password' => Env::get('cache.password'),
        'prefix' => Env::get('cache.prefix'),
        'db' => Env::get('cache.db'),
        'size' => 20
    ],
    'file' => [
        'cache_type' => 'file'
    ]
];