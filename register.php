<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form Template</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/form-elements.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="shortcut icon" href="ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

</head>
<?php
    session_start();
    $errMsg = '';
    if (isset($_SESSION['registerErrMsg'])) {
        $errMsg = $_SESSION['registerErrMsg'];
        unset($_SESSION['registerErrMsg']);
    }
?>
<body id="register">

    <!-- Top content -->
    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Waserda <strong>KKP-ITB</strong></h1>
                        <div class="description">
                            <p>
                                Pesan barang secara online!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Daftarkan dirimu!</h3>
                                <p>Masukkan semua informasi yang dibutuhkan</p>
                                <p style='color:red'><?php echo $errMsg ?></p>
                            </div>
                        </div>
                        <div class="form-bottom">
                        <form role="form" action="register-action.php" method="post" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Username</label>
                                    <input type="text" name="form-username" placeholder="Username" class="form-username form-control" id="form-username" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-namalengkap">Nama lengkap</label>
                                    <input type="text" name="form-namalengkap" placeholder="Nama lengkap" class="form-password form-control" id="form-namalengkap" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">E-mail</label>
                                    <input type="email" name="form-email" placeholder="E-mail" class="form-password form-control" id="form-email" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-nomerhp">Nomer HP</label>
                                    <input type="number" name="form-nomerhp" placeholder="Nomer HP" class="form-password form-control" id="form-nomerhp" required>
                                </div>
                                <button type="submit" class="btn">Daftar</button>
                                <p style="text-align:right">Sudah punya akun? <a href="login.php">klik disini</a> untuk masuk!</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Javascript -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>