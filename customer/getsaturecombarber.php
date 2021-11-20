<?php
error_reporting(0);
require_once("../connection.inc.php");
require_once("../function.inc.php");
//$from =  $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbarbershop = strtolower(cleanall(trim($_POST["id"])));
    $res = $mysqli->query("SELECT * FROM `t_barbershop` WHERE `id_barbershop` = '$idbarbershop'");
    $ketemu = $res->num_rows;
    $r      = $res->fetch_object();

    if ($ketemu == 1) {
        $br_id = $r->id_barbershop;
        $br_username = $r->username;
        $br_nama = $r->nama_barbershop;
        $br_email = $r->email;
        $br_nohp = $r->no_telp;
        $datakirim = array("status" => 1, "br_id" => $br_id, "br_username" => $br_username, "br_nama" => $br_nama, "br_email" => $br_email, "br_nohp" => $br_nohp);
        mysqli_free_result($res);
        echo json_encode($datakirim);
    } else {
        echo '{"status":"0"}';
    }
}
