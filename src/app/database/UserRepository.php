<?php 

namespace app\database;

use app\models\User;

class UserRepository implements IUserRepository{
    
    private $db;

    public function __construct(IPostgreSQLDatabase $postgreSQLDatabase){
        $this->db = $postgreSQLDatabase;
        $this->db->setTable('users');
    }

    public function save(User $user)
    {
        try {
            $values = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "password" => $user->getPassword(),
                "height" =>  $user->getHeight(),
                "current_weight" => $user->getCurrent_weight()
            ];
            $user->setId($this->db->insert($values));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit(User $user,$values)
    {
        try {
            $this->db->update($values, $user->getId());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function findUserById($id)
    {
        $where = "id = '" . $id . "'";
        return $this->db->select(User::class,$where);
    }

    public function findUserByEmail($email)
    {

        $where = "email = '" . $email . "'";
        return $this->db->select(User::class,$where);

    }
}