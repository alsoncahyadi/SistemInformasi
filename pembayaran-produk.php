<?php 
    require_once ("dbconf.php");

    session_start();
    if (isset($_SESSION['cId'])) {
        $id_user = $_SESSION['cId'];
    } else {
        header('Location:login.php');
    }

    $id_transaksi = $_GET['transaksi'];

    $query = "SELECT * FROM cartitem WHERE id_user=$id_user;";
    $result = mysqli_query($db, $query);
    $products_transaction = array();    
    while ($row = mysqli_fetch_assoc($result)) {         
        $products_transaction[] = $row;     
    }

    $query = "SELECT * FROM produk;";
    $result = mysqli_query($db, $query);
    $products = array();     
    while ($row = mysqli_fetch_assoc($result)) {         
        $products[] = $row;     
    }

    $i = 0;  
    $total_pembelian_products = array();
    $total_pembelian = 0;
    while (isset($products_transaction[$i])) {
        $idx = $products_transaction[$i]['id_produk'];
        $total_pembelian_products[$i] = ($products_transaction[$i]['jumlah'] * $products[$idx]['harga']);
        $total_pembelian = $total_pembelian + $total_pembelian_products[$i];
        $i = $i + 1;
    }
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-KKP</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">


    <script> 
    $(document).ready(function(){
       $('.navigation').load("nav-active.html");
       $('#1').prop('checked', true)
    });
    </script> 

</head>

<body>

    <div class="navigation"></div>

    <!-- Page Content -->
    <div class="container">

        <div class="col-md-9 payment-option">
            <p class="total"><strong>ID pembelian: </strong><?php echo $id_transaksi; ?></p><br>
            <p class="total"><strong>Total pembelian: </strong> Rp<?php echo $total_pembelian; ?></p> <br>

            <div class="shopping-list">
                <p class="total"><strong>Daftar belanja:</strong></p>
                <ul>

                    <?php 
                        $i = 0;
                        while (isset($products_transaction[$i])) {
                            $idx = $products_transaction[$i]['id_produk'];
                            echo "<li>
                                    <p><strong>Nama barang: </strong> " . $products[$idx]['nama'] . "</p>
                                    <p><strong>Jumlah: </strong> " . $products_transaction[$i]['jumlah'] . "</p>
                                    <p><strong>Harga satuan: </strong>Rp" . $products[$idx]['harga'] . "</p>
                                    <p><strong>Harga total: </strong>Rp" . $total_pembelian_products[$i] . "</p>
                                </li>";
                            $i = $i + 1;    
                        }
                    ?>

                </ul>
                <br>
            </div>

            <hr>

            <p><strong>Pilih metode pembayaran yang Anda inginkan</strong></p>
            <div class="option">
                <div class="radio">
                    <label><input type="radio" id="1" name="pay-option" value="1">Tunai</label>
                </div>
                <div class="radio">
                    <label><input type="radio" id="2" name="pay-option" value="2">Kredit</label>
                </div>
            </div>
            <div class="col-sm-12 payment-length none">
                <p><strong>Pilih jumlah pembayaran yang sesuai untuk Anda</strong></p>
                <div class="length">
                    <div class="radio">
                        <label><input type="radio" id="3" name="pay-length" value="3">2 kali pembayaran</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" id="4" name="pay-length" value="4">4 kali pembayaran</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" id="5" name="pay-length" value="5">6 kali pembayaran</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" id="6" name="pay-length" value="6">12 kali pembayaran</label>
                    </div>
                </div>
                <p style="color: grey"><small>Pembayaran dengan menggunakan kredit akan dikenakan biaya tambahan sebesar 5%</small></p>
                <p style="font-size: 20px;" id="total-credit"></p>
                <br><br>
                <!-- <p><strong>Yang harus Anda bayarkan pada setiap pembayaran </strong><span id="total-credit">2234567</span></p><br> -->
            </div>
            
            <br><br>
            <div class="form-group">
                <label for="address">Masukkan alamat pengiriman:</label>
                <input type="text" class="form-control" id="address">
            </div>
            <br><br>

            <p><strong>Pembayaran bisa dilakukan langsung saat dilakukan barang diantarkan</strong> oleh staf Waserda. Untuk memastikan keamanan saat melakukan pembayran, tunjukkan ID Anda pada staf yang bersangkutan. Terima kasih atas kepercayaan Anda dengan berbelanja di Waserda KKP-ITB.</p>

            <button class="btn btn-info pull-right mg-t-20" onclick="toTransaksi()">Kirim</button>
        </div>
    </div>
    <!-- /.container -->

    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; K1-05 2017</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $('.option input').on('change', function() {
            if ($('input[name=pay-option]:checked', '.option').val() == 2 && $(".payment-length").is(':hidden'))
                $(".payment-length").toggle();
            else if ($('input[name=pay-option]:checked', '.option').val() == 1 && $(".payment-length").is(':visible'))
                $(".payment-length").toggle();
        });

        $('.length input').on('change', function() {
            var total = <?php echo $total_pembelian; ?>; //nanti ganti pake dapetin dari perhitungan beneran
            var total2 = Math.round((total * 1.05)/2);
            var total4 = Math.round((total * 1.05)/4);
            var total6 = Math.round((total * 1.05)/6);
            var total12 = Math.round((total * 1.05)/12);
            if ($('input[name=pay-length]:checked', '.length').val() == 3) {
                var temp = parseFloat(total2, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
                $('#total-credit').text("Total yang harus Anda bayarkan pada setiap pembayaran adalah Rp" + temp);
            } else if ($('input[name=pay-length]:checked', '.length').val() == 4) {
                var temp = parseFloat(total4, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
                $('#total-credit').text("Total yang harus Anda bayarkan pada setiap pembayaran adalah Rp" + temp);
            } else if ($('input[name=pay-length]:checked', '.length').val() == 5) {
                var temp = parseFloat(total6, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
                $('#total-credit').text("Total yang harus Anda bayarkan pada setiap pembayaran adalah Rp" + temp);
            } else if ($('input[name=pay-length]:checked', '.length').val() == 6) {
                var temp = parseFloat(total12, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
                $('#total-credit').text("Total yang harus Anda bayarkan pada setiap pembayaran adalah Rp" + temp);
            }
        });

        function toTransaksi() {
            var alamat = document.getElementById('address');
            var total =  <?php echo $total_pembelian; ?>;
            var user = <?php echo $id_user; ?>;
            var transaksi = <?php echo $id_transaksi; ?>;
            var radios1 = document.getElementsByName("pay-option");
            var radios2 = document.getElementsByName("pay-length");
            var method1 = null;
            var method2 = null;
            var method = null;

            for (var i = 0, length = radios1.length; i < length; i++) {
                if (radios1[i].checked) {
                    method1 = radios1[i].value;
                    break;
                }
            }

            if (method1 == 1) {
                method = method1;
            } else {
                for (var i = 0, length = radios2.length; i < length; i++) {
                    if (radios2[i].checked) {
                        method2 = radios2[i].value
                        break;
                    }
                }

                method = method2;
            }

            location.href = "insert-transaction.php?&total=" + total + "&alamat=" + alamat.value + "&metode=" + method + "&transaksi=" + transaksi;
        };
    </script>

</body>

</html>
