<?php
namespace app\controllers;

use app\classes\Authenticator;
use app\services\ILoginService;

class LoginController
{
    private $_loginService;

     function __construct(ILoginService $_loginService) {
        $this->_loginService = $_loginService;
    }

    public function index()
    {
       return view('login');
    }

    public function login(){
        $authenticator = new Authenticator($_POST['email'],$_POST['senha']);
        if($authenticator->verifyEmail()){
            return view('login',["erroMsg" => "Não existe usuário com o e-mail informado!"]);
        }
        if(!$authenticator->verifyPassword()){
            return view('login',["erroMsg" => "A senha informada está incorreta!"]);
        }
        $this->_loginService->login($_POST);
        return redirect('/home');
    }

    public function logout(){
        $this->_loginService->logout();
        return redirect('/');
    }

}