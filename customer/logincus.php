<?php
error_reporting(0);
require_once("../connection.inc.php");
require_once("../function.inc.php");
$from =  $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower(cleanall(trim($_POST["uname"])));
    $password = cleanall(trim($_POST["passwd"]));
    //$login = cleanall(trim($_POST["login"]));
    $passEnkrip = md5($password);

    //if (ctype_alnum($username) or ctype_alnum($password)) {

    // $res = $mysqli->query("SELECT * FROM `t_customer` WHERE `username` = '$username'
    // 							AND `password` = '$passEnkrip' AND status_validasi = 1");
    // $ketemu = $res->num_rows;
    // $r      = $res->fetch_object();

    // if ($ketemu == 1) {
    //     $cus_id = $r->id_customer;
    //     $cus_nama = $r->nama;
    //     $cus_username = $r->username;
    //     $datakirim = array("status" => 1,  "c_id" => $cus_id, "c_username" => $cus_username, "c_nama" => $cus_nama);
    //     mysqli_free_result($res);
    //     echo json_encode($datakirim);
    // } else {
    //     echo '{"status":"0"}';
    // }
    //   }
    $res = $mysqli->query("SELECT * FROM `t_customer` WHERE `username` = '$username'
    AND `password` = '$passEnkrip' AND status_validasi = 1");
    $ketemu = $res->num_rows;
    $r      = $res->fetch_object();

    if ($ketemu == 1) {
        $cs_id = $r->id_customer;
        $cs_username = $r->username;
        $cs_nama = $r->nama;
        $datakirim = array("status" => 1, "cs_id" => $cs_id, "cs_username" => $cs_username, "cs_nama" => $cs_nama);
        mysqli_free_result($res);
        echo json_encode($datakirim);
    } else {
        echo '{"status":"0"}';
    }
}
