<?php

namespace app\classes;

use app\database\IUserRepository;

class Authenticator
{
    private $email;
    private $password;

    private $_userRepository;

    public function __construct($email,$password) {
        $this->email = $email;
        $this->password = $password;
        $this->_userRepository = $GLOBALS['container']->get(IUserRepository::class);;
    }

    public function verifyEmail()
    {
        $user = $this->_userRepository->findUserByEmail($this->email);
        return empty($user);
    }
    public function verifyPassword()
    {
        $user = $this->_userRepository->findUserByEmail($this->email);
        return $user[0]->verifyPassword($this->password);
    }

    
}
