<?php 
	require_once ("dbconf.php");

	session_start();
    if (isset($_SESSION['cId'])) {
        $id_user = $_SESSION['cId'];
    } else {
        header('Location:login.php');
    }

    $id_produk = $_GET['produk'];
    $jumlah = $_GET['jumlah'];

    $query = "INSERT INTO cartitem (id_user, id_produk, jumlah) VALUES ($id_user, $id_produk, $jumlah);";    
    $result = mysqli_query($db, $query);

    header("Location:katalog.php"); 
	exit;
?>
