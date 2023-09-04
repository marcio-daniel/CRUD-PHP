<?php

namespace app\classes;

use app\database\IUserRepository;
use Exception;

class Engine 
{
    public function updateLoggedInUser()
    {
        $_userRepository = $GLOBALS['container']->get(IUserRepository::class);;
        $_SESSION['user'] = ($_userRepository->findUserById($_SESSION['user']->getId()))[0];
    }

    public function render(string $targetView, array $data)
    {

        $view = dirname(__FILE__, 3) . "/app/views/{$targetView}.php";
        if (!file_exists($view)) {
            throw new Exception("{$view} not found");
        }

        ob_start();

        extract($data);

        require $view;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}
