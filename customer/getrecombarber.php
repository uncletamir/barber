<?php

error_reporting(0);
require_once("../connection.inc.php");
require_once("../function.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = $mysqli->query("SELECT * FROM t_barbershop");
    $ketemu = $res->num_rows;
    $r      = $res->fetch_object();

    if ($ketemu == 1) {
        $br_id = $r->id_barbershop;
        $br_nama = $r->nama_barbershop;
        $datakirim = array("status" => 1, "br_id" => $br_id, "br_nama" => $nama_barbershop);
        mysqli_free_result($res);
        echo json_encode($datakirim);
    } else {
        echo '{"status":"0"}';
    }
}
