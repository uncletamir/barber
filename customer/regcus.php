<?php

require_once("../connection.inc.php");
require_once("../function.inc.php");

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//$from =  $_SERVER['REMOTE_ADDR'];
$cusname = cleanall($_POST['cusname']);
$cusalamat = cleanall($_POST['cusalamat']);
$cusnohp = cleanall($_POST['cusnohp']);
$cusmail = cleanall($_POST['cusmail']);
$cusuname = cleanall($_POST['cusuname']);
$cuspass = cleanall($_POST['cuspass']);


$cekkode1 = $mysqli->query("SELECT username FROM t_customer WHERE username='$cusuname'") or die("query gagal dijalankan: " . $mysqli->error);
$cekkode2 = $mysqli->query("SELECT email FROM t_customer WHERE email='$cusmail'") or die("query gagal dijalankan: " . $mysqli->error);
if ($cekkode1 && $cekkode1->num_rows == 1) {
    echo '{"status":"2"}'; //username sudah terdaftar
} else if ($cekkode2 && $cekkode2->num_rows == 1) {
    echo '{"status":"3"}'; //email telah terdaftar
} else {
    $password = trim($cuspass);
    $passEnkrip = md5($password);
    $hash = md5(uniqid(rand(), true));

    $cekq = $mysqli->query("INSERT INTO t_customer(username,password,nama,email,no_hp,hash_reg) VALUES('$cusuname','$passEnkrip','$cusname','$cusmail','$cusnohp','$hash')") or die("query gagal dijalankan: " . $mysqli->error);

    $mail = new PHPMailer(true);
    try {

        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'appbarber70@gmail.com';
        $mail->Password = '7676Barberapp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('appbarber70@gmail.com', 'BarberApp - Registration');
        //$mail->addReplyTo('cobaajaa@gmail.com', 'BarberApp - Registration');

        // Menambahkan penerima
        $mail->addAddress($cusmail);

        // Menambahkan beberapa penerima
        //$mail->addAddress('penerima2@contoh.com');
        //$mail->addAddress('penerima3@contoh.com');

        // Menambahkan cc atau bcc 
        $mail->addCC('appbarber70@gmail.com');
        //$mail->addBCC('bcc@contoh.com');

        // Subjek email
        //$mail->Subject = 'Kirim Email via SMTP Server di PHP menggunakan PHPMailer';

        // Mengatur format email ke HTML
        $mail->isHTML(true);


        $mail->Subject = 'BarberApp: Registrasi Akun';
        $url = 'http://localhost:8000/barber/backend/verifycus.php?key=' . $hash . '';

        $message = '<p>Hi ' . $cusname . ',</p>';
        $message .= '<p>Terima kasih telah melakukan registrasi akun. Untuk mengaktifkan akun anda silahkan klik tautan berikut ini. <br />';
        $message .= '<a href="' . $url . '">' . $url . '</a></p>';
        $message .= '<p><br />Salam, <br /><br />
                    BarberApp
                    </p>';
        $message .= '<p><br />*Mohon untuk tidak me-reply email ini.</p>';

        $mail->Body  = $message;
        $mail->send();
        //echo 'Message has been sent';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    if ($cekq) {
        echo '{"status":"1"}';
    } else {
        echo '{"status":"0"}';
    }
}
exit;
