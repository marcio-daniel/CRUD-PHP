<?php

namespace app\services;

use app\database\IWeightRepository;
use app\models\Weight;

class WeightService implements IWeightService
{

    private $_weightRepository;

    public function __construct(IWeightRepository $_weightRepository) {
        $this->_weightRepository = $_weightRepository;
    }
    public function store($_post,$user_id)
    {
        $weight = new Weight();
        $weight->initializeWeight($_post['weight_value'],$_post['weight_date'],$user_id);
        try {
            $this->_weightRepository->save($weight);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
