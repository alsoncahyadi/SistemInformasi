<?php 
	require_once ("dbconf.php");

	session_start();
    if (isset($_SESSION['cId'])) {
        $id_user = $_SESSION['cId'];
    } else {
        header('Location:login.php');
    }

    $id_produk = $_GET['produk'];

    $query = "UPDATE produk SET hidden = 1 WHERE id_produk = $id_produk";    
    $result = mysqli_query($db, $query);

    header("Location:katalog.php"); 
	exit;
?>
