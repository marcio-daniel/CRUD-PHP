<?php

namespace app\controllers;

use app\services\IUserService;
use app\services\UserServices;

class UserController
{

    private $_userService;

    public function __construct(IUserService $_userService) {
        $this->_userService = $_userService;
    }
    public function registration()
    {
        return view('registration');
    }
    public function profile()
    {
        return view('profile');
    }

    public function create()
    {
        if (($_POST['password'] != $_POST['confirm_password'])) {
            return view('registration', ['erroMsg' => 'As senhas digitadas precisam ser iguais!']);
        }
        $result = $this->_userService->create($_POST);
        if($result == 23505){
            return view('registration', ["erroMsg" => "Ja existe um usuário cadastrado com o e-mail informado!"]);
        }
        return view('registration', ["successMsg" => "Usuário cadastrado com sucesso!"]);

    }

    public function update()
    {
        
        if (($_POST['password'] != $_POST['confirm_password'])) {
            return view('profile', ['erroMsg' => 'As senhas digitadas precisam ser iguais!']);
        }

        $this->_userService->update($_POST,$_SESSION['user']->getId());
        return redirect('/user/profile');
    }
}
