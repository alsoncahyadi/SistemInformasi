<?php
    session_start();
    if (isset($_SESSION['cId'])) {
        $id_user = $_SESSION['cId'];
    } else {
        header('Location:login.php');
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



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script> 
    $(document).ready(function(){
       $(".navigation").load("nav-active.html");
    });
    </script> 

</head>

<body>
    <style>
        table, th, td {
            border: 1px solid black;
        }

        th, td {
             padding: 10px;
        }

        table {
            width: 100%;   
        }

        th {
            background: #dddddd;  
            text-align: center;
        }



        #cart-page{
            padding: 0 50px;
        }

        .align-right {
            text-align: right;
        }

        .align-center {
            text-align: center;
        }

        h3 {
            margin-left: 15px;
        }

        .total-price p {
            margin-top: 30px;
            font-size: 20px;
        }

        .total-price p span {
            background-color: #ffc58e;
            padding: 10px 30px;
        }

        .btn {
            background-color: #74f280;
            padding: 7px 70px;
        }

        .btn-red {
            background-color: #fc9f9f;
            padding: 7px 20px;
            margin-right: 10px;
        }


    </style>

    <div class="navigation"></div>


    <!-- Page Content -->
    <div class="container">
        <div class="row" id="cart-page">
            <h3>Keranjang Belanja</h3>
            <div class="col-sm-8">
                <table>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>

                    <?php
                        require_once ("dbconf.php"); 

                        //$id_user = $_GET['user'];

                        $sql = "SELECT DISTINCT nama, harga, cartitem.jumlah FROM cartitem INNER JOIN produk ON cartitem.id_produk=produk.id_produk WHERE id_user=$id_user";
                        

                        $result = $db->query($sql);

                        $total_harga = 0;
                        if ($result->num_rows > 0) {
                            // output data of each row
                            $n = $result->num_rows;
                            for($i = 0; $i < $n; $i++) {
                                $row = $result->fetch_assoc();
                                echo "<tr>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . $row["jumlah"] . "</td>";
                                echo "<td>" . $row["harga"]*$row["jumlah"] . "</td>";
                                $total_harga += $row["harga"]*$row["jumlah"]; 
                            }
                            
                        } // else {
                        //     echo "0 results";
                        // }
                        $db->close();
                    ?>
                </table>
                <div class="total-price align-right">
                    <p>Total Harga : <span><?php echo $total_harga; ?></span></p>
                </div>
            </div>
            <div class="col-sm-4" style="padding: 0 50px;">
                <p>Keterangan :</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <p><input type="checkbox"> Saya setuju</p>
                <button type="submit" class="btn btn-red" onClick="document.location.href='katalog.php'">Batal</button>
                <button type="submit" class="btn" onClick="document.location.href='shopping-cart-func.php'">Beli</button> 
            </div>
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
        $(".user").click(function(){
            $(".user-menu").toggle();
        });

        $(".btn-feedback").click(function(){
            $(".feedback").toggle();
            $(".input-feedback").val('');
        });

        $(".btn-send").click(function(){
            $(".feedback").toggle();
            $(".input-feedback").val('');
        });
    </script>

</body>

</html>
