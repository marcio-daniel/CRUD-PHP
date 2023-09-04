<?php

use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\UserController;
use app\controllers\WeightController;
use app\database\IUserRepository;
use app\database\IWeightRepository;
use app\database\PostgreSQLDatabase;
use app\database\UserRepository;
use app\database\WeightRepository;
use app\services\ILoginService;
use app\services\IUserService;
use app\services\IWeightService;
use app\services\LoginService;
use app\services\UserServices;
use app\services\WeightService;
use app\classes\Container;
use app\database\IPostgreSQLDatabase;

$container = Container::getInstance();


$container->set(IUserRepository::class, UserRepository::class);
$container->set(IWeightRepository::class, WeightRepository::class);
$container->set(IUserService::class, UserServices::class);
$container->set(IWeightService::class, WeightService::class);
$container->set(ILoginService::class, LoginService::class);
$container->set(IPostgreSQLDatabase::class, PostgreSQLDatabase::class);
$container->set(HomeController::class, HomeController::class);
$container->set(LoginController::class, LoginController::class);
$container->set(UserController::class, UserController::class);
$container->set(WeightController::class, WeightController::class);

return $container;

