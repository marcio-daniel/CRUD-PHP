<?php

namespace app\controllers;


class HomeController
{
    public function index(){
        return view('home');
    }

    public function filter(){
        return view('filter');
    }
    
}
