<?php
    require_once ("dbconf.php");
    //$user = $_GET['user'];
    $id_produk = $_GET['produk'];
    $id_user = $_GET['user'];

    $query = "SELECT * FROM produk WHERE id_produk = $id_produk;";    
    $result = mysqli_query($db, $query);
    $item = $result->fetch_assoc();

    $query = "SELECT * FROM feedback WHERE id_produk = $id_produk";
    $result = mysqli_query($db, $query);
    $feedarray = array();     
    while ($row = mysqli_fetch_assoc($result)) {         
        $feedarray[] = $row;     
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
       $(".navigation").load("nav-active.html");
    });
    </script> 

</head>

<body>

    <div class="navigation"></div>

    <!-- Page Content -->
    <div class="container">
        <div class="col-md-2">
            <img class="img-responsive" src="<?php echo $item['foto'] ?>" alt="image">
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="thumbnail">
                    <div class="caption-full">
                        <h4 class="pull-right mg-r-10">Rp<?php echo $item['harga'] ?></h4>
                        <h3 class="mg-l-10"><strong><?php echo $item['nama'] ?></strong></h3>
                        <p class="mg-l-10"><?php echo $item['deskripsi'] ?></p> <br>
                        <div class="col-sm-3">
                            <p><strong>Berat</strong><span class="pull-right"><?php echo $item['berat'] ?> kg</span></p>
                            <p><strong>Jumlah stok</strong><span class="pull-right"><?php echo $item['jumlah'] ?> item</span></p>
                        </div>
                    </div>

                    <br><br>

                    <div class="text-right">
                        <button class="btn btn-info mg-r-10 mg-b-20" id="buy">Beli Barang</button>
                    </div>

                    <div class="input-group none  col-sm-2" id="pembelian">
                        <input id="jumlah" type="number" class="form-control mg-b-20" name="msg" placeholder="Jumlah...">
                        <button onclick="toBuy('<?php echo $id_produk;?>', '<?php echo $id_user;?>');" class="btn btn-info mg-r-10 mg-b-20" id="buy">Beli Barang</button>
                    </div>
                    

                </div>

                <div class="well">     

                    <?php 
                        $i = 0;
                        while (isset($feedarray[$i])) {
                            echo "<div class=\"row\">
                                <div class=\"col-md-12\">
                                Anonymous
                                <p>". $feedarray[$i]['feedback'] . "</p>
                                </div>
                                </div>

                                <hr>";

                            $i = $i + 1;
                        }
                        if ($i==0) {
                            echo "<p> Belum ada komentar untuk " . $item['nama'] . "</p>
                                <hr>";
                        }
                    ?>

                    <div class="text-right">
                        <button class="btn btn-success btn-feedback">Beri Masukan</button>
                    </div>

                    <div class="form-group feedback none">
                        <div class="form-horizontal forminput">
                            <label for="comment">Komentar</label>
                            <textarea class="form-control input-feedback" rows="5" id="comment" placeholder="Masukkan komentar Anda"></textarea> 
                            <div class="text-right mg-t-10">
                                <button class="btn btn-info btn-send" id="send" onclick="toComment('<?php echo $id_produk;?>', '<?php echo $id_user;?>');">Kirim</button>    
                            </div>
                        </div>
                    </div>

                </div> <!-- end of well  -->
            </div>
        </div>

    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright &copy; K1-05 2017</p>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(".btn-feedback").click(function(){
            $(".feedback").toggle();
            $(".input-feedback").val('');
        });

        $("#buy").click(function(){
            $("#pembelian").toggle();
            $("#buy").toggle();
        });

        function toBuy(produk, user) {
            var jumlah = document.getElementById('jumlah');
            location.href = "buy-product.php?produk=" + produk + "&user=" + user + "&jumlah=" + jumlah.value;
        }; 
        
        function toComment(produk, user) {
            var jumlah = document.getElementById('comment');
            location.href = "insert-feedback.php?produk=" + id + "&comment=" + comment.value + "&user=" + user;
        }; 

    </script>

</body>

</html>