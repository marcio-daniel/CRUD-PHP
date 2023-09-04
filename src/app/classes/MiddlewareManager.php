<?php

namespace app\classes;

class MiddlewareManager 
{
    public static function verify(string $middlewareType)
    {
        switch ($middlewareType) {
            case 'auth':
                if(!isset($_SESSION['logged'])){
                    return redirect('/');
                }
                break;
            case 'logged':
                if(isset($_SESSION['logged'])){
                    return redirect('/home');
                }
                break;
            default: 
            break;
        }
    }
}
