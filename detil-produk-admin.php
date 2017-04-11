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
       $(".navigation").load("nav-admin.html");
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
                        <a onclick="toDelete('<?php echo $id_produk;?>', '<?php echo $item['nama'];?>', '<?php echo $id_user;?>)';" class="btn btn-danger mg-r-10 mg-b-20">Hapus Barang</a>
                        <a onclick="toEdit('<?php echo $id_produk;?>', '<?php echo $id_user;?>');" class="btn btn-warning mg-r-10 mg-b-20">Edit Barang</a>
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
                    ?>

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

        $(".btn-send").click(function(){
            $(".feedback").toggle();
            $(".input-feedback").val('');
        });

        function toEdit(produk, user) {
            location.href = "edit-product.php?produk=" + produk + "&user=" + user ;
        };

        function toDelete(produk, nama, user) {
            var res = confirm("Apakah Anda yakin untuk menghapus" + nama);
            if (res == true) {
                location.href = "delete-product.php?produk=" + produk + "&user=" + user;
            }
        };  

    </script>

</body>

</html>
