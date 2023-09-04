<?php

namespace app\database;

use app\models\Weight;
use DateTime;
use DateInterval;

class WeightRepository implements IWeightRepository
{

    private $db;

    public function __construct(IPostgreSQLDatabase $postgreSQLDatabase) {

        $this->db = $postgreSQLDatabase;
        $this->db->setTable('weights');
    }

    public function save(Weight $weight)
    {
        try {
            $values = [
                "weight_value" => $weight->getWeight_value(),
                "weight_date" => $weight->getWeight_date(),
                "user_id" => $weight->getUser_id()
            ];
            $weight->setId($this->db->insert($values));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fetchAllByUserId($user_id)
    {
        $where = "user_id = '" . $user_id . "'";
        $orderby = 'weight_date asc';
        return $this->db->select(Weight::class,$where,null,$orderby);
    }

    public function fetchByMonthAndUser_id($month,$user_id)
    {
        $dateLastDay = $this->findLastDayOfMonth($month);
        $where = "user_id=" . $user_id . " AND weight_date between'" . date('Y') . "-" . $month . "-01' AND '" . $dateLastDay->format('Y-m-d') . "'";
        $orderby = 'weight_date asc';
        return $this->db->select(Weight::class,$where,null,$orderby);
    }

    private function findLastDayOfMonth($month){
        $auxMonth = $month + 1;
        $auxYear = date('Y');
        if ($auxMonth == 13) {
            $auxMonth = '01';
            $auxYear++;
        }
        $dateLastDay = new DateTime();
        $dateLastDay->setDate($auxYear, $auxMonth, 01);
        $dateLastDay->sub(new DateInterval('P1D'));
        return $dateLastDay;
    }
}
