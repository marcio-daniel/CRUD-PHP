<?php

namespace app\models;


class Weight
{
    private $id;
    private $weight_value;
    private $weight_date;

    private $user_id;

    public function initializeWeight($weight_value, $weight_date, $user_id)
    {
        $weight = str_replace(',', '.', $weight_value);
        $this->weight_value = (float) $weight;
        $this->weight_date = $weight_date;
        $this->user_id = $user_id;
    }


    public function getWeight_value()
    {
        return $this->weight_value;
    }

    public function getWeight_date()
    {
        return $this->weight_date;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
