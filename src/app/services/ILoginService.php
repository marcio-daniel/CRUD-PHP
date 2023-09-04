<?php 
namespace app\services;

interface ILoginService 
{
    public function login($_post);
    public function logout();
}