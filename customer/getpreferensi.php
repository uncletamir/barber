<?php
error_reporting(0);
require_once("../connection.inc.php");
require_once("../function.inc.php");
//$from =  $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcustomer = strtolower(cleanall(trim($_POST["id"])));
    $res = $mysqli->query("SELECT * FROM `t_customer` WHERE `id_customer` = '$idcustomer'");
    $ketemu = $res->num_rows;
    $r      = $res->fetch_object();

    if ($ketemu == 1) {
        $cs_id = $r->id_customer;
        $cs_rating = $r->pref_rating;
        $cs_jarak = $r->pref_jarak;
        $cs_harga = $r->pref_harga;
        $datakirim = array("status" => 1, "cs_id" => $cs_id, "cs_rating" => $cs_rating, "cs_jarak" => $cs_jarak, "cs_harga" => $cs_harga);
        mysqli_free_result($res);
        echo json_encode($datakirim);
    } else {
        echo '{"status":"0"}';
    }
}
