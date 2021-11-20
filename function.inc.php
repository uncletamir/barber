<?php
function cleanall($data)
{
	global $mysqli;
	$filter = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
	return $filter;
}

function cleaninput($data)
{
	$filter = trim(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
	return $filter;
}

function randomPassword()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
