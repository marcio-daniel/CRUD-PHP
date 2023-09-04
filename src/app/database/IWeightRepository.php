<?php 

namespace app\database;
use app\models\Weight;

interface IWeightRepository {

    public function save(Weight $weight);

    public function fetchAllByUserId($user_id);

    public function fetchByMonthAndUser_id($month,$user_id);

}