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

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="ico/favicon.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

</head>
<?php
	session_start();
	$errMsg = '';
	if (isset($_SESSION["loginErrMsg"])) {
		$errMsg = $_SESSION['loginErrMsg'];
		unset($_SESSION['loginErrMsg']);
	}
?>


<body id="login">

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
								<h3>Masuk ke website kami!</h3>
								<p>Masukkan username dan password untuk masuk:</p>
								<p style = "color:red"><?php echo $errMsg; ?></p>
							</div>
							<div class="form-top-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" action="login-action.php" method="post" class="login-form">
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
								</div>
								<button type="submit" class="btn">Masuk</button>
								<p style="text-align:right">Atau <a href="register.php">daftarkan dirimu</a>, bila belum punya akun</p>
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
	<!--<script src="js/jquery.backstretch.min.js"></script>-->
	<script src="js/scripts.js"></script>


</body>

</html>