<?php

return [
    'get' => [
        '/' => 'LoginController@index:logged',
        '/registration' => 'UserController@registration',
        '/home' => 'HomeController@index:auth',
        '/logout' => 'LoginController@logout:auth',
        '/weight/create' => 'WeightController@create:auth',
        '/user/profile' => 'UserController@profile:auth',
        '/user/filter' => 'HomeController@filter:auth'
    ],
    'post'=> [
        '/user/create' => 'UserController@create',
        '/user/update' => 'UserController@update:auth',
        '/login' => 'LoginController@login',
        '/weight/store' => 'WeightController@store:auth',
    ]
];