<?php

use app\database\IWeightRepository;

$_weightRepository = $GLOBALS['container']->get(IWeightRepository::class);;

if ($_GET['month'] === '0') {
    $auxWeight_lists = ($_weightRepository->fetchAllByUserId($_SESSION['user']->getId()));
} else {
    $auxWeight_lists = $_weightRepository->fetchByMonthAndUser_id($_GET['month'],$_SESSION['user']->getId());
}
$weight_lists = array();
for ($i = 0; $i < count($auxWeight_lists); $i++) {
    array_push($weight_lists, $auxWeight_lists[$i]->jsonSerialize());
}
header('Content-Type: application/json');
echo json_encode($weight_lists);
