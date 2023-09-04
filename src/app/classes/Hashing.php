<?php 

namespace app\classes;

class Hashing 
{
    public static function encrypt($password) {
        return password_hash($password,PASSWORD_DEFAULT);
    }

    public static function decrypt($password, $encrypt_password){
        return password_verify($password,$encrypt_password);
    }
}
