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
                                    <?php var_dump($_POST); ?>
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p>Bayaran untuk <br>
                                                    Jenis Pembayaran: <br>
                                                    Transaction ID: <br>
                                                    Keterangan perbankan internet:</p>
                                                    
                                                    <p>Jumlah: RM </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><div class="alert alert-info">Sila semak e-mail anda untuk mendapatkan pautan muat-turun dokumen ini. Jika anda mempunyai sebarang pertanyaan, sila e-mail kepada klmycity2040@dbkl.gov.my atau klmycity2040@gmail.com atau hubungi talian 03–2617 9544 / 9545 / 9546 (Seksyen Perancangan Pelan Struktur, Jabatan Perancangan Bandaraya).</div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="alert alert-warning">Pembelian anda tidak berjaya. Sila cuba semula. Jika anda mempunyai sebarang pertanyaan, sila e-mail kepada klmycity2040@dbkl.gov.my atau klmycity2040@gmail.com atau hubungi talian 03–2617 9544 / 9545 / 9546 (Seksyen Perancangan Pelan Struktur, Jabatan Perancangan Bandaraya).</div></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="javascript:window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <label for="payment_type">Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="payment_type" placeholder="Masukkan jenis pembayaran yang ingin dibayar" aria-describedby="paymentHelp" required="">
                                        <small id="paymentHelp" class="form-text text-muted">Klik <a href>di sini</a> untuk melihat jenis pembayaran yang disediakan</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Jumlah (RM) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="amount" placeholder="Amoun/jumlah" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama pembayar" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Alamat e-mail anda" required="">
                                        <small id="emailHelp" class="form-text text-muted">Ruangan bertanda * adalah wajib diisi.</small>
                                    </div>
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