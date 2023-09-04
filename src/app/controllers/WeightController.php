<?php 

namespace app\controllers;

use app\services\IWeightService;

class WeightController
{
private $_weightService;

public function __construct(IWeightService $_weightService) {
    $this->_weightService = $_weightService;
}

    public function create(){
        return view('weight');
    }
    
    public function store()
    {
        $this->_weightService->store($_POST,$_SESSION['user']->getId());
        return redirect('/weight/create');
    }
}
