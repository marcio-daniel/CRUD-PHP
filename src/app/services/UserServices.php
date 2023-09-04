<?php

namespace app\services;

use app\classes\Hashing;
use app\database\IUserRepository;
use app\models\User;


class UserServices implements IUserService
{

    private $_userRepository;

    public function __construct(IUserRepository $_userRepository)
    {
        $this->_userRepository = $_userRepository;
    }

    public function create($_post)
    {
        $user = new User();
        $user->initializeUser($_post["name"], $_post["email"], $_post["password"], $_post["height"], $_post["weight"]);
        try {
            $this->_userRepository->save($user);
            return 1;
        } catch (\Throwable $th) {
            if ($th->getCode() == 23505) {
                return $th->getCode();
            }
        }
    }

    public function update($_post, $user_id)
    {
        $user = $this->_userRepository->findUserById($user_id);
        $password = Hashing::encrypt($_post["password"]);
        $values = [
            'name' => $_POST["name"],
            'email' => $_POST["email"],
            'password' => $password,
            'height' => str_replace(',', '.', $_post["height"])
        ];
        if ($_post['password'] === '') {
            unset($values['password']);
        }
        $values['imc'] = $user[0]->getCurrent_weight() / ($values['height'] * $values['height']);
        $this->_userRepository->edit($user[0], $values);
    }
}
