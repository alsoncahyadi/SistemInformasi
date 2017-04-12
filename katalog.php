<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>E-KKP</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/shop-homepage.css" rel="stylesheet">
	<link href="css/shop-item.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">

</head>

<?php
    require_once ("dbconf.php");
    $sql =  "SELECT * FROM produk;";
    $produks = $db->query($sql);
?>

<body>
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand mg-0 lead" href="#"><strong>E-KKP</strong></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="#" class="menu mg-t-3">Beranda</a>
					</li>
				</ul>

				<ul class="nav navbar-nav pull-right">
					<li>
						<a href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
					</li>
					<li>
						<a href="#" class="user"><span class="glyphicon glyphicon-user bg-circle pd-l-3 pd-t-3"></span></a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>

	<!-- Page Content -->
	<div class="container">
            <div class="row">
            <?php if ($produks->num_rows > 0) {
            		foreach($produks as $produk) { 
            			foreach($produk as $key => $value) {
            			//echo $key . " => " . $value . "<br>";
            			}    
            			$sql =  "SELECT * FROM feedback WHERE id_produk = " . $produk['id_produk'] . ";";
						$feedbacks = $db->query($sql);

                        if (isset($_GET['user'])) {
                            $red = "detil-produk.php?produk=" . $produk['id_produk'] . "&user=" . $_GET['user'];
                        } else {
                            $red = "detil-produk.php?produk=" . $produk['id_produk'];
                        }
            		?>
            	<div class="col-sm-4 col-lg-4 col-md-4 product-review">
            		<img src="<?php echo $produk['foto']?>" alt="" width="100" height="150" class="pull-center center-block img-auto">
            		<div class="thumbnail-group">
            			<div class="caption">
            				<h4 class="pull-right"><?php echo $produk['harga']?></h4>
            				<h4><a href="<?php echo $red?>"><?php echo $produk['nama']?></a>
            				</h4>
            				<p><?php echo $produk['deskripsi']?></p>
            			</div>
            			<div class="ratings">
            				<p class="pull-right"><?php echo $feedbacks->num_rows?> feedbacks</p>
            			</div>
            		</div>
            	</div>
            <?php }
            } ?>

            </div>

        </div>


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

</body>

</html>
