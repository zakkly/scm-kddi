<?php
require __DIR__."/../../vendor/autoload.php";
require __DIR__."/../../Classes/config/UserManagement/index.php";
use Manage\manage;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;
$mng = new manage;



$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => _SERVER_,
    'database'  => _DB_,      // データベース名を変更していたら合わせて変更
    'username'  => _USER_,          // xxxxを、データベースのユーザー名に変更
    'password'  => _PASS_,        // xxxxxxを、データベースのパスワードに変更
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);
$capsule->bootEloquent();

$role = Sentinel::getRoleRepository()->createModel()->create([
            "name" => "Moderator",
            "slug" => "moderator",
            "permissions" => [
                "user.create" => true,
                "user.delete" => false,
                "user.view" => true,
                "user.update" => false,
                "role.create" => false,
                "role.delete" => false,
                "role.view" => false,
                "role.update" => false,
            ]
]);


/*
return [
    "default_roles" => [
        "default_admin_roles" => [
            "name" => "Administrator",
            "slug" => "admin",
            "permissions" => [
                "user.create" => true,
                "user.delete" => true,
                "user.view" => true,
                "user.update" => true,
                "role.create" => true,
                "role.delete" => true,
                "role.view" => true,
                "role.update" => true,
            ]
        ],
        "default_moderator" => [
            "name" => "Moderator",
            "slug" => "moderator",
            "permissions" => [
                "user.create" => true,
                "user.delete" => false,
                "user.view" => true,
                "user.update" => false,
                "role.create" => false,
                "role.delete" => false,
                "role.view" => false,
                "role.update" => false,
            ]
        ]
    ]
];

*/