<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pengesahan Pembayaran | Gerbang Pembayaran Negeri Perlis</title>
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
                    <div class="col-lg-12">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Pengesahan Pembayaran</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <?php
                                    require ('php/conn.php');

                                    $service = $_POST['service'];
                                    $agency = $_POST['agency'];

                                    $stmt_agency = $pdo->prepare("SELECT name FROM agencies WHERE code = :agency");
                                    $stmt_agency->execute(['agency' => $agency]); 
                                    $row_agency = $stmt_agency->fetch();

                                    $stmt_service = $pdo->prepare("SELECT name FROM services WHERE id = :service");
                                    $stmt_service->execute(['service' => $service]); 
                                    $row_service = $stmt_service->fetch();

                                    $data = $_POST;

                                    echo "<form id='confirm' action='action.php?id=process-payment' method='post'>";
                                    if (is_array($data) || is_object($data))
                                    {
                                        foreach ($data as $key => $val) {
                                            echo "<input type='hidden' name='".$key."' value='".htmlspecialchars($val)."'>";
                                        }
                                    }
                                    echo "<input type='hidden' name='nama_agensi' value='".$row_agency['name']."'>";
                                    echo "<input type='hidden' name='jenis_pembayaran' value='".$row_service['name']."'>";
                                    echo "</form>";
                                    ?>
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr>
                                                <th>Sila semak maklumat pembayaran berikut:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li>Agensi: <?php echo $row_agency['name'] ?? '' ?></li>
                                                        <li>Jenis Pembayaran: <?php echo $row_service['name'] ?? '' ?></li>
                                                        <li>Jumlah: RM <?php echo number_format($_POST['amount'],2) ?? '' ?></li>
                                                        <li>Nama: <?php echo $_POST['nama'] ?? '' ?></li>
                                                        <li>No. Kad Pengenalan: <?php echo $_POST['nric'] ?? '' ?></li>
                                                        <li>E-mail: <?php echo $_POST['email'] ?? '' ?></li>
                                                        <li>Telefon: <?php echo $_POST['telefon'] ?? '' ?></li>
                                                        <li>Catatan: <?php echo $_POST['catatan'] ?? '' ?></li>
                                                        <?php isset($_POST['alamat']) ? '<li>Alamat Rumah (Harumanis):'.$_POST['alamat'].'</li>' : '' ?>
                                                        <?php isset($_POST['cukai']) ? '<li>No. Cukai Taksiran / No. Akaun:'.$_POST['cukai'].'</li>' : '' ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                                <td>
                                                    <a href="#" onclick="submitForm()" class="btn btn-primary"><i class="fa fa-print"></i> Bayar</a>
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
        <script type='text/javascript'>
            function submitForm() {
                document.getElementById('confirm').submit();
            }
        </script>
    </body>
</html>