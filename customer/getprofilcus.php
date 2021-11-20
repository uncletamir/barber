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
        $cs_username = $r->username;
        $cs_nama = $r->nama;
        $cs_email = $r->email;
        $cs_nohp = $r->no_hp;
        $datakirim = array("status" => 1, "cs_id" => $cs_id, "cs_username" => $cs_username, "cs_nama" => $cs_nama, "cs_email" => $cs_email, "cs_nohp" => $cs_nohp);
        mysqli_free_result($res);
        echo json_encode($datakirim);
    } else {
        echo '{"status":"0"}';
    }
}
