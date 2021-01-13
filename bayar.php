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
                                    <h2 class="text-white">Pembayaran</h2>
                                    <p class="text-light">Maklumat Pembayaran</p>
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
                    <div class="col-lg-6">
                        <div class="border p-3 mb-3 rounded">
                            <form method="post" action="action.php?id=process-payment">
                            <h4>Maklumat Pembayaran</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="payment_type">Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="payment_type" placeholder="Masukkan jenis pembayaran yang ingin dibayar" aria-describedby="paymentHelp" required="">
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
                    <div class="col-lg-6">
                        <!-- Credit/Debit Card box-->
                        <div class="border p-3 mb-3 rounded">

                            <h4>Perbankan Atas Talian/Kad Debit</h4>
                            <p class="mb-3 pt-1">Pembayaran menggunakan akaun bank atau kad debit anda</p>
                            
                            <div class="row mb-3">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="fpx" name="payment_mode" class="custom-control-input" value="fpx">
                                        <label class="custom-control-label" for="fpx">Individu</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="fpx1" name="payment_mode" class="custom-control-input" value="fpx1">
                                        <label class="custom-control-label" for="fpx1">Korporat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select_bank"></div>
                                <div class="col">
                                    <select name="bank_code" id="bank_code" class="custom-select">
                                        <option>- Pilih Bank-</option>
                                    </select>
                                    <input type="hidden" name="be_message" id="be_message">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="agree" name="agree">
                                        <label class="custom-control-label" for="agree">Dengan memilih mode pembayaran ini, anda bersetuju dengan <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">terma dan syarat</a> Paynet.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-sm-right mt-2 mt-sm-0">
                                <button type="submit" class="btn btn-success">Pembayaran</button>
                            </div>

                            </form>
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
        <script>
            $('#fpx').on('change', function() {
                var mode = "01";
                get_list(mode);
                ajax_loading_image('.select_bank');
            });

            $('#fpx1').on('change', function() {
                var mode = "02";
                get_list(mode);
                ajax_loading_image('.select_bank');
            });

            // set a loading image
            function ajax_loading_image(div) {
                $(div).html('<div class="form-group"><div class="col-md-4"><label></label></div><div class="col-md-4"><img src="images/loading.gif"><span>Please wait...</span></div></div>');
            }

            // remove loading image
            function ajax_remove_loading_image(div) {
                $(div).html('');
                $('#bank_code').html('');
            }

            function get_list(mode){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "php/bank-list.php",
                    data:{
                        mode: mode,
                        env: 'staging'
                    },
                    success: function(response) {
                        ajax_remove_loading_image('.select_bank');
                        $.each(response.bank_list, function(key,value){
                            $('#bank_code').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#be_message').val(response.be_message);
                    }
                });
            }
        </script>
    </body>

</html>