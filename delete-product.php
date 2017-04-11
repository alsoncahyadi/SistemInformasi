<?php 
	require_once ("dbconf.php");

    $id_produk = $_GET['produk'];
    $id_user = $_GET['user'];

    $query = "UPDATE produk SET hidden = 1 WHERE id_produk = $id_produk";    
    $result = mysqli_query($db, $query);

    header("Location:katalog.php?user=" . $id_user); 
	exit;
?>
