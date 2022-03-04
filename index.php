<?php
$config_filename = 'config.json';
if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

if($config['fpx']['environment'] == 'Staging'){
    $env = 'staging';
    $merchant_code = '001000STG';
} else {
    if($config['maintenance'] == 'on'){
        header('Location:maintenance.php');
        exit;
    }
    $env = 'production';
    $merchant_code = '';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>E-Payment Demo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
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
                                    <h2 class="text-white">Pembayaran</h2>
                                    <p>Isikan maklumat pembayaran seperti dibawah</p>
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
                                        <label for="merchant">Merchant <span class="text-danger">*</span></label>
                                        <select name="merchant" id="merchant" class="custom-select" required>
                                            <option value="">- Pilih Merchant -</option>
                                            <option value="pearl">Mutiara Technology Sdn Bhd</option>
                                            <option value="assofa">Yayasan Sofa Negeri Sembilan</option>
                                            <option value="WEBAFF">Mutiara Technology Sdn Bhd - Affin</option>
                                            <option value="amanpalestine">Aman Palestin Berhad</option>
                                            <option value="aldzikr">AL DZIKR ILM</option>
<option value="mvm">Muslim Volunteer Malaysia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Jumlah (RM) <span class="text-danger">*</span></label>
                                        <input type="number" min="1.00" step="0.01" class="form-control" name="amount" placeholder="Amaun/jumlah" required="" pattern="[-+]?[0-9]*[.,]?[0-9]+" id="amount">
                                        <p id="warning-message" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama pembayar" required="" pattern=".{3,}">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="nric">No. Kad Pengenalan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nric" placeholder="XXXXXX-XX-XXXX" required="" pattern=".{12,}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="telefon">No. Telefon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="telefon" placeholder="01XXXXXXXX" required="" pattern=".{7,}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Alamat e-mail anda" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea class="form-control" name="catatan" rows="5"></textarea>
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Ruangan bertanda * adalah wajib diisi.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Credit/Debit Card box-->
                        <div class="border p-3 mb-3 rounded">

                            <h4>Perbankan Internet dan Kad Kredit/Debit</h4>
                            <img src="images/fpx.svg" height="64px" class="float-right">
                            <p class="mb-4 pt-1">Pembayaran menggunakan akaun bank anda</p>

                            <div class="alert alert-info">Individu: Minimum RM 1.00 dan maksimum RM 30,000.00<br>Korporat: Minimum RM 2.00 dan maksimum RM 1,000,000.00</div>

                            <div class="row mb-3">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="fpx" name="payment_mode" class="custom-control-input" value="fpx">
                                        <label class="custom-control-label" for="fpx">Perbankan Internet (Individu)</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="fpx1" name="payment_mode" class="custom-control-input" value="fpx1">
                                        <label class="custom-control-label" for="fpx1">Perbankan Internet (Korporat)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="select_bank"></div>
                                <div class="col">
                                    <select name="bank_code" id="bank_code" class="custom-select" required="">
                                        <option>- Pilih Bank-</option>
                                    </select>
                                    <input type="hidden" name="be_message" id="be_message">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="agree" name="agree" required="">
                                        <label class="custom-control-label" for="agree">Dengan memilih mod pembayaran ini, anda bersetuju dengan <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">terma dan syarat</a> FPX.</label>
                                    </div>
                                </div>
                            </div>

                            <img src="images/visa.svg" height="64px" class="float-right">
                            <img src="images/mastercard.svg" height="64px" class="float-right">
                            <p class="mb-3 pt-1">Pembayaran menggunakan kad kredit/debit</p>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="migs" name="payment_mode" class="custom-control-input" value="migs">
                                        <label class="custom-control-label" for="migs">Kad Kredit/Debit</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn bg-biru text-white">Pembayaran</button>
                            </div>

                            </form>
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
        <script>

            var minAmount = 1;
            var maxAmount = 30000;

            $('#amount').attr('min', minAmount);
            $('#amount').attr('max', maxAmount);

            $('#amount').on('keydown keyup change', function(){
                var char = $(this).val();
                if(char < minAmount){
                    $('#warning-message').text('Jumlah minimum adalah RM '+minAmount+'');
                }else if(char > maxAmount){
                    $('#warning-message').text('Jumlah maksimum adalah RM '+maxAmount+'');
                    $(this).val(char.substring(0, maxAmount));
                }else{
                    $('#warning-message').text('');
                }
            });

            $('#fpx').on('change', function() {

                var mode = "01";
                minAmount = 1;
                maxAmount = 30000;

                $('#amount').attr('min', minAmount);
                $('#amount').attr('max', maxAmount);

                $('#bank_code').empty();
                get_list(mode);
            });

            $('#fpx1').on('change', function() {

                var mode = "02";
                minAmount = 2;
                maxAmount = 1000000;

                $('#amount').attr('min', minAmount);
                $('#amount').attr('max', maxAmount);

                $('#bank_code').empty();
                get_list(mode);
            });

            function get_list(mode){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "php/bank-list.php",
                    data:{
                        mode: mode,
                        env: '<?php echo $env ?>'
                    },
                    success: function(response) {
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
