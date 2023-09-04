<?php

namespace app\services;

use app\database\IUserRepository;
class LoginService implements ILoginService
{

    private $_userRepository;
    public function __construct(IUserRepository $_userRepository) {
        $this->_userRepository = $_userRepository;
    }
    public function login($_post)
    {
        $email = $_post['email'];
        $user = $this->_userRepository->findUserByEmail($email);
        $_SESSION['logged'] = true;
        $user[0]->removePassword();
        $_SESSION['user'] = $user[0];
    }
    public function logout()
    {
        session_destroy();
    }
}
