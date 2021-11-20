<?php

require_once("../connection.inc.php");
require_once("../function.inc.php");


$vIDCS = cleanall($_POST['id_cus']);
$vIDBS = cleanall($_POST['bs_id']);
$vLat = cleanall($_POST['lat_cus']);
$vLng = cleanall($_POST['lng_cus']);
$vTotal = cleanall($_POST['total_bayar']);
$vRating = cleanall($_POST['bs_rating']);
//$vIDB = cleanall($_POST['b_id']);
$vStsorder = cleanall($_POST['stsorder']);
$vQTY = cleanall($_POST['qty']);


// $myquery = "INSERT INTO t_order(id_customer,id_barbershop,tgl_order,lat_cust,lng_cust,total_bayar,rating_order,status_order,qty) VALUES($vIDCS,$vIDBS,now(),$vLat,$vLng,$vTotal,$vRating,$vStsorder,$vQTY)";
// echo $myquery;
$cekq = $mysqli->query("INSERT INTO t_order(id_customer,id_barbershop,tgl_order,lat_cust,lng_cust,total_bayar,rating_order,status_order,qty) VALUES($vIDCS,$vIDBS,now(),$vLat,$vLng,$vTotal,$vRating,$vStsorder,$vQTY)") or die("query gagal dijalankan: " . $mysqli->error);

if ($cekq) {
    echo '{"status":"1"}';
} else {
    echo '{"status":"0"}';
}

exit;
