<?php



use app\classes\Engine;
use app\classes\Router;

function path()
{
    $param = explode('?', $_SERVER['REQUEST_URI']);
    if (count($param) > 1) {
        for ($i = 1; $i < count($param); $i++) {
            $aux = explode('=', $param[$i]);
            $_GET[$aux[0]] = $aux[1] == '' ? '' : $aux[1];
        }
    }
    return strtolower($param[0]);
}



function dd($param = [], $die = true)
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    if ($die) {
        die();
    }
}

function request()
{
    return strtolower($_SERVER['REQUEST_METHOD']);
}

function routerExecute()
{
    try {
        $routes = require '../app/routes/routes.php';
        $router = new Router;
        $router->execute($routes);
    } catch (\Throwable $th) {
        print_r($th->getMessage());
    }
}

function view(string $view, array $data = [])
{

    try {
        $engine = new Engine;
        echo $engine->render($view, $data);
    } catch (\Throwable $th) {
        var_dump($th->getMessage());
    }
}

function redirect($to)
{
    return header('Location: '.$to);
}