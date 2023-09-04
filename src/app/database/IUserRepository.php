<?php 

namespace app\database;

use app\models\User;

interface IUserRepository{
    public function save(User $user);

    public function edit(User $user,$values);
    public function findUserById($id);

    public function findUserByEmail($email);
}