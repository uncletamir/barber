<?php

require_once("../connection.inc.php");
require_once("../function.inc.php");

$cIDCustomer = cleanall($_POST['cs_id']);
$prefrating = cleanall(trim($_POST['cs_rating']));
$prefharga = cleanall(trim($_POST['cs_harga']));
$prefjarak = cleanall(trim($_POST['cs_jarak']));

if ((isset($_POST['cs_rating']) and !empty($_POST['cs_rating'])) and (isset($_POST['cs_harga']) and !empty($_POST['cs_harga'])) and (isset($_POST['cs_jarak']) and !empty($_POST['cs_jarak']))) {

    $hasil = $mysqli->query("SELECT * FROM t_customer WHERE id_customer = '$cIDCustomer'");
    $data = $hasil->fetch_object();




    $eksekusi = $mysqli->query("UPDATE t_customer SET pref_rating = '$prefrating', pref_harga = '$prefharga', pref_jarak = '$prefjarak' WHERE id_customer = '$cIDCustomer'");
    if ($eksekusi) {
        echo '{"status":"1"}';
    } else {
        echo '{"status":"0"}';
    }

    exit;
}
