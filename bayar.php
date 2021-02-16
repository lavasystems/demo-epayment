<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Bayaran | Gerbang Pembayaran Negeri Perlis</title>
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
                    <ul class="navbar-nav ml-auto" id="mySidenav">
                        <li class="nav-item active">
                            <a href="http://ebayar.perlis.gov.my" class="btn btn-secondary">Laman Utama</a>
                        </li>
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
                                    <p class="text-light">Isikan maklumat pembayaran seperti dibawah</p>
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
                            <form method="post" action="action.php?id=confirm-payment" id="form-bayar">
                            <h4>Maklumat Pembayaran</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="payment_type">Agensi <span class="text-danger">*</span></label>
                                        <select name="agency" id="agency" class="custom-select agency" required="">
                                            <option value="0">- Pilih Agensi -</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_type">Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <select name="service" id="service" class="custom-select service" required="">
                                            <option value="0">- Pilih Jenis Pembayaran -</option>
                                        </select>
                                        <input type="hidden" name="TRANS_ID" id="TRANS_ID">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Jumlah (RM) <span class="text-danger">*</span></label>
                                        <input type="number" min="1.00" step="0.01" class="form-control" name="amount" placeholder="Amoun/jumlah" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama pembayar" required="">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="nric">No. Kad Pengenalan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nric" placeholder="XXXXXX-XX-XXXX" required="">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="telefon">No. Telefon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="telefon" placeholder="01XXXXXXXX" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Alamat e-mail anda" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <input type="text" class="form-control" name="catatan" placeholder="jika ada">
                                    </div>
                                    <div class="form-group" id="alamat" style="display:none;">
                                        <label for="alamat">Alamat Rumah (Harumanis) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat penghantaran (Harumanis)">
                                    </div>
                                    <div class="form-group" id="cukai" style="display:none;">
                                        <label for="cukai">No. Cukai Taksiran / No. Akaun <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="cukai" placeholder="No. Cukai Taksiran / No. Akaun">
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Ruangan bertanda * adalah wajib diisi.</small>
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
                                <div class="select_bank"></div>
                                <div class="col">
                                    <select name="bank_code" id="bank_code" class="custom-select" required="">
                                        <option>- Pilih Bank-</option>
                                    </select>
                                    <input type="hidden" name="be_message" id="be_message">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="agree" name="agree" required="">
                                        <label class="custom-control-label" for="agree">Dengan memilih mod pembayaran ini, anda bersetuju dengan <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">terma dan syarat</a> FPX.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
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
        <footer class="footer">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="">&copy; 2021 Hakcipta Terpelihara Kerajaan Negeri Perlis</p>
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
        <script src="https://www.google.com/recaptcha/api.js?render=6LfUYlgaAAAAAOUaTl007VxYInWIDFb1nHBHpt1G"></script>
        <script>

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
                        $.each(response.bank_list, function(key,value){
                            $('#bank_code').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#be_message').val(response.be_message);
                    }
                });
            }

            $('#form-bayar').submit(function(event) {
                event.preventDefault();
         
                grecaptcha.ready(function() {
                    grecaptcha.execute('6LfUYlgaAAAAAOUaTl007VxYInWIDFb1nHBHpt1G', {action: 'submit_payment'}).then(function(token) {
                        $('#form-bayar').prepend('<input type="hidden" name="token" value="' + token + '">');
                        $('#form-bayar').prepend('<input type="hidden" name="action" value="submit_payment">');
                        $('#form-bayar').unbind('submit').submit();
                    });;
                });
            });

            $(document).ready(function(){

                $.ajax({
                    type: "GET",
                    url: "php/agency-list.php",
                    success: function(data) {
                        $('#agency').append(data);
                    }
                });

                $('select.agency').on('change', function(){
                    $('select.service').val('');
                    var agency_code = $(this).find('option:selected').data('id');
                    $.ajax({
                        type: "POST",
                        url: "php/service-list.php",
                        data: {
                            'agency_id' : agency_code
                        },
                        success: function(data) {
                            $('#service').find('option').not('[value=0]').remove();
                            $('#service').append(data);
                        }
                    });
                });
                    

                $('select.service').on('change', function(){
                    var agency_code = $('select.agency').find('option:selected').data('id');
                    var agency = $('select.agency').find('option:selected').val();
                    var service_code = $(this).find('option:selected').val();

                    if(agency_code == 6 && service_code == 2){
                        $('#alamat').show();
                    } else {
                        $('#alamat').hide();
                    }
                    if(agency_code == 16 && service_code == 1){
                        $('#cukai').show();
                    } else {
                        $('#cukai').hide();
                    }
                    var timestamp = '<?php echo date("YmdHis",time()) ?>';
                    $('#TRANS_ID').val(agency + '-' + service_code + '-' + timestamp);
                });

                var mode = "01"; //Individual
                    get_list(mode);
                });
        </script>
    </body>

</html>