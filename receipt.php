<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Jabatan | Gerbang Pembayaran Negeri Perlis</title>
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

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="index.html">
                    <img src="images/logo.png" alt="" class="logo-light" height="50" />
                    <img src="images/logo.png" alt="" class="logo-dark" height="50" />
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#home" class="nav-link">Laman Utama</a>
                        </td>
                        <li class="nav-item">
                            <a href="#agency" class="nav-link">Agensi</a>
                        </td>
                        <li class="nav-item">
                            <a href="#faq" class="nav-link">Soalan Lazim</a>
                        </td>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Hubungi Kami</a>
                        </td>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- home start -->
        <section class="bg-home bg-gradient" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2 class="text-white">Resit</h2>
                                    <p class="text-light">Resit Pembayaran</p>
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Resit Pembayaran</h4>
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
                                                        <li>ID Transaksi: <?php echo $_POST['TRANS_ID'] ?? '' ?></li>
                                                        <li>Tarikh/Masa: <?php echo $_POST['PAYMENT_DATETIME'] ?? '' ?></li>
                                                        <li>Jumlah: RM <?php echo $_POST['AMOUNT'] ?? '' ?></li>
                                                        <li>Mod Pembayaran: <?php echo strtoupper($_POST['PAYMENT_MODE']) ?? '' ?></li>
                                                        <li>ID Pembayaran: <?php echo $_POST['PAYMENT_TRANS_ID'] ?? '' ?></li>
                                                        <li>Kod Pengesahan: <?php echo $_POST['APPROVAL_CODE'] ?? '' ?></li>
                                                        <li>Seller Order ID: <?php echo $_POST['MERCHANT_ORDER_NO'] ?? '' ?></li>
                                                        <li>Bank Pembayar: <?php echo $_POST['BUYER_BANK'] ?? '' ?></li>
                                                        <li>Nama Pembayar: <?php echo $_POST['BUYER_NAME'] ?? '' ?></li>
                                                        <li>Nama: <?php echo $_POST['payee_name'] ?? '' ?></li>
                                                        <li>E-mail: <?php echo $_POST['payee_email'] ?? '' ?></li>
                                                        <li>Jenis Pembayaran: <?php echo $_POST['payment_type'] ?? '' ?></li>
                                                        <li>Kod Pembayaran: <?php echo $_POST['kod'] ?? '' ?></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <?php if($_POST['STATUS'] == 1): ?>
                                            <tr>
                                                <td><div class="alert alert-info">Pembayaran anda telah diterima. Jika anda mempunyai sebarang pertanyaan, sila e-mail kepada .</div></td>
                                            </tr>
                                            <?php else: ?>
                                            <tr>
                                                <td><div class="alert alert-warning">Pembayaran anda tidak berjaya. Sila cuba semula. Jika anda mempunyai sebarang pertanyaan, sila e-mail kepada </div></td>
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

        <!-- footer start -->
        <footer class="bg-dark footer">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-left pull-none">
                            <p class="text-white">&copy; 2020 Kerajaan Negeri Perlis Indera Kayangan</p>
                        </div>
                        <div class="float-right pull-none">
                            <ul class="list-inline social-links">
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-google-plus"></i></a></li>
                            </ul>
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
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrollspy.min.js"></script>

        <!-- custom js -->
        <script src="js/app.js"></script>
    </body>
</html>