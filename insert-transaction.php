<?php 
	require_once ("dbconf.php");

    $id_transaksi = $_GET['transaksi'];
    $id_user = $_GET['user'];
    $method = $_GET['metode'];
    $total = $_GET['total'];
    $alamat = $_GET['alamat'];

    $query = "INSERT INTO transaksi (id_transaksi, id_user, metodepembayaran, total_harga, alamat_tujuan) VALUES ($id_transaksi, $id_user, $method, $total, '$alamat');";    
    $result = mysqli_query($db, $query);

    $loc = "Location:katalog.php?user=" . $id_user;

    header($loc);
	exit;
?>