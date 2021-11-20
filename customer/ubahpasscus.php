<?php

require_once("../connection.inc.php");
require_once("../function.inc.php");

//$from =  $_SERVER['REMOTE_ADDR'];

if ((isset($_POST['passwordbaru']) and !empty($_POST['passwordbaru'])) and (isset($_POST['passwordlama']) and !empty($_POST['passwordlama']))) {
    $cIDCustomer = cleanall($_POST['cs_id']);
    $hasil = $mysqli->query("SELECT password FROM t_customer WHERE id_customer = '$cIDCustomer'");
    $data = $hasil->fetch_object();

    $passlama = cleanall(trim($_POST['passwordlama']));
    $passlamaEnkrip = md5($passlama);

    if ($data->password == $passlamaEnkrip) {

        $passbaru = cleanall(trim($_POST['passwordbaru']));
        $passbaruEnkrip = md5($passbaru);
        $eksekusi = $mysqli->query("UPDATE t_customer SET password = '$passbaruEnkrip' WHERE id_customer = '$cIDCustomer'");
        if ($eksekusi) {
            echo '{"status":"1"}';
        } else {
            echo '{"status":"0"}';
        }
    } else {
        echo '{"status":"2","pesan":"Maaf, Password lama anda salah!"}';
    }
    exit;
}
