<?php

require_once("connection.inc.php");
require_once("function.inc.php");

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//$from =  $_SERVER['REMOTE_ADDR'];
$unamereset = cleanall(trim($_POST['resetuname']));
$emailreset = cleanall(trim($_POST['resetemail']));
//$loginas = cleanall(trim($_POST["loginas"]));

//if ($loginas == "barbershop") {
$cekkode = $mysqli->query("SELECT * FROM t_customer WHERE email='$emailreset' and username='$unamereset'") or die("query gagal dijalankan: " . $mysqli->error);
if ($cekkode && $cekkode->num_rows == 1) {
    $r = $cekkode->fetch_object();
    $idcustomer = $r->id_customer;
    $nama = $r->nama;
    $password = randomPassword();
    $passEnkrip = md5($password);

    $cekq = $mysqli->query("UPDATE t_customer SET password = '$passEnkrip' WHERE id_customer = '$idcustomer'") or die("query gagal dijalankan: " . $mysqli->error);

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

        $mail->setFrom('appbarber70@gmail.com', 'BarberApp - Reset Password Akun');
        //$mail->addReplyTo('cobaajaa@gmail.com', 'BarberApp - Registration');

        // Menambahkan penerima
        $mail->addAddress($emailreset);

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

        $mail->Subject = 'BarberApp: Reset Password Akun';

        $message = '<p>Hi ' . $nama . ',</p>';
        $message .= '<p>Kami menerima permintaan untuk melakukan reset password Anda.<br />';
        $message .= 'Password akun Anda dengan username: <b>' . $unamereset . '</b> telah direset menjadi: <b>' . $password . '</b><br /></p>';
        $message .= 'Anda dapat merubah password tersebut melalui fitur Ubah Password setelah berhasil login.<br />';
        $message .= 'Terima kasih</p>';
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
} else {
    echo '{"status":"0"}'; //email atau username tidak sesuai
}
//} 
exit;
