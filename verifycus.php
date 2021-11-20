<?php
//error_reporting(0);
require_once("connection.inc.php");
require_once("function.inc.php");

$key = trim(cleanall($_GET['key']));

$cekkode = $mysqli->query("SELECT * FROM t_customer WHERE hash_reg = '$key'") or die("query gagal dijalankan: " . $mysqli->error);

if ($cekkode && $cekkode->num_rows == 1) //jika key ditemukan
{
    $cekq = $mysqli->query("UPDATE t_customer SET status_validasi = 1, hash_reg = NULL WHERE hash_reg='$key'") or die("query gagal dijalankan: " . $mysqli->error);

    if ($cekq) {
        $flag = 1;
    } else {
        $flag = 0;
    }
} else {
    $flag = 0;
}

?>

<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>BarberApp | Status Aktivasi Akun</title>
    <link rel="stylesheet" type="text/css" media="all" href="asset/statstyle.css">
</head>

<body>
    <div id="w">
        <?php if ($flag == 1) { ?>
            <div class="notify successbox">
                <h1>Success!</h1>
                <span class="alerticon"><img src="asset/check.png" alt="checkmark" /></span>
                <p>Registrasi akun anda berhasil diaktivasi, selanjutnya anda dapat login ke aplikasi. Terima kasih.</p>
            </div>
        <?php } else { ?>
            <div class="notify errorbox">
                <h1>Warning!</h1>
                <span class="alerticon"><img src="asset/error.png" alt="error" /></span>
                <p align="center">Kode aktivasi anda tidak ditemukan atau anda telah melakukan aktivasi akun sebelumnya!</p>
            </div>
        <?php } ?>
    </div>
</body>

</html>