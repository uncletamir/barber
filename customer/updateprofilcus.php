<?php

require_once("../connection.inc.php");
require_once("../function.inc.php");


//$from =  $_SERVER['REMOTE_ADDR'];
$cIDCustomer = cleanall($_POST['cs_id']);
$cName = cleanall($_POST['cs_nama']);
$cEmail = cleanall($_POST['cs_email']);
$cNohp = cleanall($_POST['cs_nohp']);


$cekkode1 = $mysqli->query("SELECT * FROM t_customer WHERE email='$cEmail'") or die("query gagal dijalankan: " . $mysqli->error);

if ($cekkode1 && $cekkode1->num_rows == 1) {
    $r      = $cekkode1->fetch_object();
    $idcust = $r->id_customer;

    if ($idcust == $cIDCustomer) { //email yang sama untuk akun tsb atau tidak melakukan perubahan email update saja..
        $cekq = $mysqli->query("UPDATE t_customer SET nama = '$cName', email = '$cEmail', no_hp = '$cNohp' WHERE id_customer = '$cIDCustomer'") or die("query gagal dijalankan: " . $mysqli->error);
        if ($cekq) {
            echo '{"status":"1"}';
        } else {
            echo '{"status":"0"}';
        }
    } else {
        echo '{"status":"2"}'; //ada akun lain dengan email tsb.
    }
} else {
    $cekq = $mysqli->query("UPDATE t_customer SET nama = '$cName', email = '$cEmail', no_hp = '$cNohp' WHERE id_customer = '$aIDCustomer'") or die("query gagal dijalankan: " . $mysqli->error);
    if ($cekq) {
        echo '{"status":"1"}';
    } else {
        echo '{"status":"0"}';
    }
}
exit;
