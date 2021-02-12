<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Bukti Pembayaran | Gerbang Pembayaran Negeri Perlis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Gerbang Pembayaran Perlis" name="description" />
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

        <!-- content start -->
        <section class="section">
            <div class="container-fluid">

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
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li>No. Resit: <?php echo $_POST['RECIPT_NO'] ?? '' ?></li>
                                                        <li>ID Transaksi: <?php echo $_POST['TRANS_ID'] ?? '' ?></li>
                                                        <li>Tarikh/Masa: <?php echo $_POST['PAYMENT_DATETIME'] ?? '' ?></li>
                                                        <li>Jumlah: RM <?php echo $_POST['AMOUNT'] ?? '' ?></li>
                                                        <li>Mod Pembayaran: <?php echo strtoupper($_POST['PAYMENT_MODE']) ?? '' ?></li>
                                                        <li>ID Pembayaran: <?php echo $_POST['PAYMENT_TRANS_ID'] ?? '' ?></li>
                                                        <li>Kod Pengesahan: <?php echo $_POST['APPROVAL_CODE'] ?? '' ?></li>
                                                        <li>Seller Order ID: <?php echo $_POST['MERCHANT_ORDER_NO'] ?? '' ?></li>
                                                        <li>Bank Pembayar: <?php echo $_POST['BUYER_BANK'] ?? '' ?></li>
                                                        <li>Nama Pembayar: <?php echo $_POST['BUYER_NAME'] ?? '' ?></li>
                                                        <li>Nama: <?php echo $_POST['nama'] ?? '' ?></li>
                                                        <li>No. Kad Pengenalan: <?php echo $_POST['nric'] ?? '' ?></li>
                                                        <li>Telefon: <?php echo $_POST['telefon'] ?? '' ?></li>
                                                        <li>E-mail: <?php echo $_POST['email'] ?? '' ?></li>
                                                        <li>Jenis Pembayaran: <?php echo $_POST['jenis_pembayaran'] ?? '' ?></li>
                                                        <li>Agensi: <?php echo $_POST['nama_agensi'] ?? '' ?></li>
                                                        <li>Catatan: <?php echo $_POST['catatan'] ?? '' ?></li>
                                                        <?php if($_POST['kod_agensi'] == '011000'): ?>
                                                        <li>Alamat (Harumanis): <?php echo $_POST['alamat'] ?? '' ?></li>
                                                        <?php if($_POST['kod_agensi'] == '025000'): ?>
                                                        <?php endif; ?>
                                                        <li>No. Cukai Taksiran / No. Akaun: <?php echo $_POST['cukai'] ?? '' ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <?php if($_POST['STATUS'] == 1): ?>
                                            <tr>
                                                <td><div class="alert alert-info">Pembayaran anda telah diterima. Jika anda mempunyai sebarang pertanyaan, sila e-mail kepada .</div></td>
                                            </tr>
                                            <?php else: ?>
                                            <tr>
                                                <td><div class="alert alert-warning">Pembayaran anda tidak berjaya. Sila cuba semula. Jika anda mempunyai sebarang pertanyaan, sila hubungi seketariat e-Bayar Perlis.</div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <a href="javascript:window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
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
            </div>
        </section>
        
        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

        <!-- javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <!-- custom js -->
        <script src="js/app.js"></script>
    </body>
</html>