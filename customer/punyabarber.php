<?php
require_once("../connection.inc.php");

$data=array();

if (isset($_GET['namabs']) and !empty($_GET['namabs'])){
	$nama = $_GET['namabs'];
	$sql = "select * from t_barbershop where nama_barbershop like '%$nama%' order by id_barbershop";
}
else if (isset($_GET['stataktivasi']) ){
	$stataktivasi = $_GET['stataktivasi'];
	$sql = "select * from t_barbershop where status_aktivasi = $stataktivasi order by id_barbershop";
}
else if (isset($_GET['statvalidasi']) ){
	$statvalidasi = $_GET['statvalidasi'];
	$sql = "select * from t_barbershop where status_validasi = $statvalidasi order by id_barbershop";
}
else if (isset($_GET['statlayanan']) ){
	$statlayanan = $_GET['statlayanan'];
	$sql = "select * from t_barbershop where status_layanan = $statlayanan order by id_barbershop";
}
else if (isset($_GET['getvalidasibs']) and $_GET['getvalidasibs'] == 1){
	$sql = "select * from t_barbershop where status_aktivasi = 1 and status_validasi = 0 order by id_barbershop limit 5";
}
else{
	$sql = "select * from t_barbershop order by id_barbershop";
}

//echo $sql;

$res = $mysqli->query($sql);
while ($row=$res->fetch_object()){
	$data[]=$row;
}
echo json_encode($data);
