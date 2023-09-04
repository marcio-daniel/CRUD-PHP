<?php 

namespace app\services;

interface IUserService 
{
    public function create($_post);

    public function update($_post,$user_id);
}