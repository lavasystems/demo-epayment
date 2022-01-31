<?php
$config_filename = 'config.json';
if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

require 'vendor/autoload.php';
//send email
use PHPMailer\PHPMailer\PHPMailer;
$purifier = new HTMLPurifier();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Bukti Pembayaran</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Gerbang Pembayaran" name="description" />
        <meta content="Fadli Saad" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.png">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

        <!--Material Icon -->
        <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>

        <!-- home start -->
        <section class="bg-home bg-biru d-print-none" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2 class="text-white">Bukti Pembayaran</h2>
                                    <p class="text-white">Sila semak bukti pembayaran berikut</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- home end -->

        <!-- content start -->
        <section class="section">
            <div class="container-fluid">

                <?php if(isset($_POST['TRANS_ID']) && isset($_POST['PAYMENT_DATETIME']) && isset($_POST['AMOUNT']) && isset($_POST['PAYMENT_TRANS_ID'])):
                    $trans_id = $purifier->purify($_POST['TRANS_ID']);
                    $merchant_order_no = $purifier->purify($_POST['MERCHANT_ORDER_NO']);
                    $receipt_no = $purifier->purify($_POST['RECEIPT_NO']);
                    $payment_datetime = $purifier->purify($_POST['PAYMENT_DATETIME']);
                    $amount = $purifier->purify($_POST['AMOUNT']);
                    $payment_mode = $purifier->purify($_POST['PAYMENT_MODE']);
                    $payment_trans_id = $purifier->purify($_POST['PAYMENT_TRANS_ID']);
                    $approval_code = $purifier->purify($_POST['APPROVAL_CODE']);
                    $buyer_bank = $purifier->purify($_POST['BUYER_BANK']);
                    $buyer_name = $purifier->purify($_POST['BUYER_NAME']);
                    $nama = $purifier->purify($_POST['nama']);
                    $nric = $purifier->purify($_POST['nric']);
                    $telefon = $purifier->purify($_POST['telefon']);
                    $email = $purifier->purify($_POST['email']);
                    $catatan = $purifier->purify($_POST['catatan']);
                ?>

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Bukti Pembayaran</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($_POST['STATUS'] == 1): $msg = "Pembayaran anda telah diterima."; $status = 'SUCCESS'; ?>
                                            <tr>
                                                <td><div class="alert alert-info"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php if($_POST['STATUS'] == 0): $msg = "Pembayaran anda tidak berjaya. Sila cuba semula."; $status = 'FAILED'; ?>
                                            <tr>
                                                <td><div class="alert alert-danger"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php if($_POST['STATUS'] == 3) : $msg = "Pembayaran anda sedang dikemaskini/perlu pengesahan. Sila semak dengan bank anda."; $status = 'PENDING APPROVAL'; ?>
                                            <tr>
                                                <td><div class="alert alert-danger"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php if($_POST['STATUS'] == 2) : $msg = "Pembayaran anda tidak berjaya. Sila semak baki anda"; ?>
                                            <tr>
                                                <td><div class="alert alert-danger"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li>No. Resit: <?php echo $receipt_no ?? '-' ?></li>
                                                        <li>ID Transaksi: <?php echo $trans_id ?? '-' ?></li>
                                                        <li>Status: <?php echo $status ?? '-' ?></li>
                                                        <li>Seller Order No: <?php echo $merchant_order_no ?? '-' ?></li>
                                                        <li>Tarikh/Masa: <?php echo $payment_datetime ?? '-' ?></li>
                                                        <li>Jumlah: RM <?php echo $amount ?? '-' ?></li>
                                                        <li>Mod Pembayaran: <?php echo strtoupper($payment_mode) ?? '-' ?></li>
                                                        <li>ID Pembayaran: <?php echo $payment_trans_id ?? '-' ?></li>
                                                        <li>Kod Pengesahan: <?php echo $approval_code ?? '-' ?></li>
                                                        <li>Bank Pembayar: <?php echo $buyer_bank ?? '-' ?></li>
                                                        <li>Nama Pembayar: <?php echo $buyer_name ?? '-' ?></li>
                                                        <li>Nama: <?php echo $nama ?? '-' ?></li>
                                                        <li>No. Kad Pengenalan: <?php echo $nric ?? '-' ?></li>
                                                        <li>Telefon: <?php echo $telefon ?? '-' ?></li>
                                                        <li>E-mail: <?php echo $email ?? '-' ?></li>
                                                        <li>Catatan: <?php echo $catatan ?? '-' ?></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="javascript:window.print()" class="btn bg-biru text-white d-print-none"><i class="fa fa-print"></i> Cetak</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <?php
                // prepare receipt
                $receipt = "<p>".$msg."</p><ul>
                    <li>No. Resit: ".$receipt_no."</li>
                    <li>ID Transaksi: ".$trans_id."</li>
                    <li>Seller Order No: ".$merchant_order_no."</li>
                    <li>Tarikh/Masa: ".$payment_datetime."</li>
                    <li>Jumlah: RM ".$amount."</li>
                    <li>Mod Pembayaran: ".strtoupper($payment_mode)."</li>
                    <li>ID Pembayaran: ".$payment_trans_id."</li>
                    <li>Kod Pengesahan: ".$approval_code."</li>
                    <li>Bank Pembayar: ".$buyer_bank."</li>
                    <li>Nama Pembayar: ".$buyer_name."</li>
                    <li>Nama: ".$nama."</li>
                    <li>No. Kad Pengenalan: ".$_POST['nric']."</li>
                    <li>Telefon: ".$telefon."</li>
                    <li>E-mail: ".$email."</li>
                    <li>Catatan: ".$catatan."</li>";
                $receipt .= "</ul>";
                
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
                $mail->addAddress($email, $nama);
                $mail->Subject = 'Status Pembayaran';
                $mail->isHTML(true);
                $mail->Body = $receipt;
                if (!$mail->send()) {
                    echo "<script>alert('Terdapat ralat dalam menghantar bukti pembayaran ini. Sila semak jika anda memasukkan alamat e-mail dengan tepat.');</script>";
                    echo $mail->ErrorInfo;
                } else {
                    echo "<script>alert('Sila semak e-mail anda untuk mendapatkan salinan bukti pembayaran ini.');</script>";
                }
            else:
                echo "<div class='alert alert-danger'>No data received</div>";
            endif;
                ?>
            </div>
        </section>

        <!-- footer start -->
        <footer class="footer d-print-none bg-biru">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="text-white">&copy; 2021 Hakcipta Terpelihara <?php echo $_POST['STATUS'] ?></p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </footer>
        <!-- footer end -->
        
        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

        <!-- javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <!-- custom js -->
        <script src="js/app.js"></script>
    </body>
</html>
