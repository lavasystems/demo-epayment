<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pengesahan Pembayaran</title>
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
        <section class="bg-home bg-biru" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2 class="text-white">Pengesahan Pembayaran</h2>
                                    <p class="text-white">Sila semak maklumat pembayaran berikut</p>
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
                    <div class="col-lg-6 offset-lg-3">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Pengesahan</h4>
                            <?php
                            #require ('conn.php');
                            require ('php/conn-sqlite.php');

                            $data = $_POST;

                            echo "<form id='confirm' action='action.php?id=process-payment' method='post'>";
                            if (is_array($data) || is_object($data))
                            {
                                foreach ($data as $key => $val) {
                                    echo "<input type='hidden' name='".$key."' value='".filter_var($val, FILTER_SANITIZE_STRING)."'>";
                                }
                            }
                            echo "</form>";

                            ?>

                            <dl class="row">

                                <dt class="col-md-4">Jumlah</dt>
                                <dd class="col-md-8">RM <?php echo number_format($_POST['amount'],2) ?? '' ?></dd>

                                <dt class="col-md-4">Nama</dt>
                                <dd class="col-md-8"><?php echo $_POST['nama'] ?? '' ?></dd>

                                <dt class="col-md-4">No. Kad Pengenalan</dt>
                                <dd class="col-md-8"><?php echo $_POST['nric'] ?? '' ?></dd>

                                <dt class="col-md-4">E-mail</dt>
                                <dd class="col-md-8"><?php echo $_POST['email'] ?? '' ?></dd>

                                <dt class="col-md-4">Telefon</dt>
                                <dd class="col-md-8"><?php echo $_POST['telefon'] ?? '' ?></dd>

                                <dt class="col-md-4">Catatan</dt>
                                <dd class="col-md-8"><?php echo $_POST['catatan'] ?? '' ?></dd>
                            </dl>
                            <a href="#" onclick="submitForm()" class="btn bg-biru text-white"><i class="fa fa-print"></i> Bayar</a>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>

        <!-- footer start -->
        <footer class="footer bg-biru">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="text-white">&copy; 2021 Hakcipta Terpelihara</p>
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
        <script type='text/javascript'>
            function submitForm() {
                document.getElementById('confirm').submit();
            }
        </script>
    </body>
</html>
