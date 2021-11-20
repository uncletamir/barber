<?php
//using mysqli
$mysqli = new mysqli("us-cdbr-east-04.cleardb.com", "bef139bdfd9ede", "1b2a3b8c", "heroku_6578c13f024066b");
//$mysqli = new mysqli("localhost", "root", "", "db_barber-new");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
