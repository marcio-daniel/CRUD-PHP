<?php

namespace app\models;

use app\classes\Hashing;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $height;
    private $current_weight;
    private $imc;

    public function initializeUser($name, $email, $password, $height, $current_weight)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = Hashing::encrypt($password);
        $height= (float) str_replace(',', '.', $height);
        $this->height= $height;
        $weight = (float) str_replace(',', '.', $current_weight);
        $this->current_weight = $weight;
        $this->imc = $this->current_weight / ($this->height * $this->height);
    }

    public function verifyPassword($password)
    {
        return Hashing::decrypt($password,$this->password);
    }

    public  function removePassword()
    {
        unset($this->password);
    }

    public function getImc()
    {
        return $this->imc;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCurrent_weight()
    {
        return $this->current_weight;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setId($id){
        $this->id = $id;
    }
}
