<?php
$config_filename = 'config.json';
if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

if($_POST['STATUS'] == 1): $msg = "Pembayaran anda telah diterima. Jika anda mempunyai sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di ebayar@perlis.gov.my";
else: $msg = "Pembayaran anda tidak berjaya. Sila cuba semula. Jika anda mempunyai sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di ebayar@perlis.gov.my";
endif;
                                            
// prepare receipt
$receipt = "<p>".$msg."</p><ul>
    <li>No. Resit: ".$_POST['RECEIPT_NO']."</li>
    <li>ID Transaksi: ".$_POST['TRANS_ID']."</li>
    <li>Tarikh/Masa: ".$_POST['PAYMENT_DATETIME']."</li>
    <li>Jumlah: RM ".$_POST['AMOUNT']."</li>
    <li>Mod Pembayaran: ".strtoupper($_POST['PAYMENT_MODE'])."</li>
    <li>ID Pembayaran: ".$_POST['PAYMENT_TRANS_ID']."</li>
    <li>Kod Pengesahan: ".$_POST['APPROVAL_CODE']."</li>
    <li>Bank Pembayar: ".$_POST['BUYER_BANK']."</li>
    <li>Nama Pembayar: ".$_POST['BUYER_NAME']."</li>
    <li>Nama: ".$_POST['nama']."</li>
    <li>No. Kad Pengenalan: ".$_POST['nric']."</li>
    <li>Telefon: ".$_POST['telefon']."</li>
    <li>E-mail: ".$_POST['email']."</li>
    <li>Jenis Pembayaran: ".$_POST['jenis_pembayaran']."</li>
    <li>Agensi: ".$_POST['nama_agensi']."</li>
    <li>Catatan: ".$_POST['catatan']."</li>";
    if($_POST['alamat'] != NULL):
$receipt .= "<li>Alamat (Harumanis): ".$_POST['alamat']."</li>";
    endif;
    if($_POST['cukai'] != NULL):
$receipt .= "<li>No. Cukai Tanah / No. Akaun: ".$_POST['cukai']."</li>";
    endif;
$receipt .= "</ul>";

//send email
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = $config['email']['debug'];
$mail->Host = $config['email']['host'];
$mail->Port = $config['email']['port'];
$mail->SMTPAuth = true;
$mail->Username = $config['email']['username'];
$mail->Password = $config['email']['password'];
$mail->setFrom($config['email']['username'], $config['email']['from']);
$mail->addReplyTo($config['email']['username'], $config['email']['from']);
$mail->addAddress($_POST['email'], $_POST['nama']);
$mail->addCC($_POST['agency_email']);
$mail->Subject = 'Status Pembayaran di E-Bayar Perlis';
$mail->isHTML(true);
$mail->Body = $receipt;
if (!$mail->send()) {
    echo "<script>alert('Terdapat ralat dalam menghantar bukti pembayaran ini. Sila semak jika anda memasukkan alamat e-mail dengan tepat.');</script>";
    echo $mail->ErrorInfo;
} else {
    echo "<script>alert('Sila semak e-mail anda untuk mendapatkan salinan bukti pembayaran ini.');</script>";
}