<?php
require_once("../connection.inc.php");
require_once("../function.inc.php");

$data = array();
$sql = "select * from t_barbershop order by harga_layanan";
$res = $mysqli->query($sql);
while ($row = $res->fetch_object()) {
    $data[] = $row;
}
echo json_encode($data);
