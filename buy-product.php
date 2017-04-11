<?php 
	require_once ("dbconf.php");

    $id_produk = $_GET['produk'];
    $jumlah = $_GET['jumlah'];
    $id_user = $_GET['user'];

    $query = "INSERT INTO cartitem (id_user, id_produk, jumlah) VALUES ($id_user, $id_produk, $jumlah);";    
    $result = mysqli_query($db, $query);

    header("Location:katalog.php?user=" . $id_user); 
	exit;
?>
