<?php

use Ebcms\App;
use Ebcms\Router;

return App::getInstance()->execute(function (
    Router $router
): array {
    $res = [];
    $res[] = [
        'title' => '应用管理',
        'url' => $router->buildUrl('/ebcms/appm/index'),
        'priority' => 0,
        'icon' => '<svg t="1608973120330" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="46743" width="20" height="20"><path d="M460.8 344h299.2v64H460.8zM348.8 312c-35.2 0-64 28.8-64 64s28.8 64 64 64 64-28.8 64-64c0-36.8-28.8-64-64-64zM286.4 518.4h299.2v64H286.4zM697.6 486.4c-35.2 0-64 28.8-64 64s28.8 64 64 64 64-28.8 64-64c0-36.8-28.8-64-64-64z" fill="#FC7265" p-id="46744"></path><path d="M849.6 840H188.8c-72 0-131.2-52.8-131.2-118.4V203.2c0-65.6 59.2-118.4 131.2-118.4h660.8c72 0 131.2 52.8 131.2 118.4V720c0 65.6-59.2 120-131.2 120zM188.8 148.8c-36.8 0-67.2 25.6-67.2 54.4v518.4c0 30.4 30.4 54.4 67.2 54.4h660.8c36.8 0 67.2-25.6 67.2-54.4V203.2c0-30.4-30.4-54.4-67.2-54.4H188.8z" fill="#1F91F2" p-id="46745"></path><path d="M486.4 784h64v156.8h-64z" fill="#1F91F2" p-id="46746"></path><path d="M334.4 896H704v64H334.4z" fill="#1F91F2" p-id="46747"></path></svg>',
    ];
    return $res;
});
