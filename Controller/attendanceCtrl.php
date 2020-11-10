<?php
/**
 * Created by PhpStorm.
 * User: Arif
 * Date: 4/14/2018
 * Time: 3:37 PM
 */
include_once "../url.php";
include_once "../Model/attendance.php";

 
$obj=new attendance();

try {
    $presnt = 0;
    foreach ($_POST['value'] as $val) {

        $a = trim($val['Attend']);
        if ($a == "1") {
            $presnt++;
            
        }
    }

  
    $absent = $_POST['count'] - $presnt;
    $_POST['present'] = $presnt;
    $_POST['absent'] = $absent;
    $obj->storeAtndMastr($_POST);
    $rs = $obj->last_id_of_atnd_master();
    $lastID = $rs->id;
    foreach ($_POST['value'] as $val) {
        $obj->storeAtndDetals($lastID, $val['id'], (int)$val['Attend']);
    }
    echo "success";
} catch (Exception $e) {
}

