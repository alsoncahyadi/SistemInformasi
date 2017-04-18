<?php 
	require_once ("dbconf.php");

	session_start();
    if (isset($_SESSION['cId'])) {
        $id_user = $_SESSION['cId'];
    } else {
        header('Location:login.php');
    }

    $id_produk = $_GET['produk'];
    $comment = $_GET['comment'];

    $query = "INSERT INTO feedback (id_produk, feedback) VALUES ($id_produk, '$comment');";    
    $result = mysqli_query($db, $query);

    $loc = "Location:detil-produk.php?produk=" . $id_produk . "&user=" . $id_user;

    header($loc);
	exit;
?>
