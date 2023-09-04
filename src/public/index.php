<?php

require '../vendor/autoload.php';
session_start();

$container = require_once '../app/helpers/config.php';

routerExecute();