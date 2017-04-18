<?php 
require_once ("dbconf.php");

session_start();
if (isset($_SESSION['cId'])) {
    $id_user = $_SESSION['cId'];
} else {
    header('Location:login.php');
}

$id_transaksi = $_GET['transaksi'];
$method = $_GET['metode'];
$total = $_GET['total'];
$alamat = $_GET['alamat'];

$query = "INSERT INTO transaksi (id_transaksi, id_user, tanggal, metodepembayaran, total_harga, alamat_tujuan) VALUES ($id_transaksi, $id_user, CURRENT_TIMESTAMP, $method, $total, '$alamat');";    
if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    $loc = "Location:shopping-cart-func.php?transaksi=" . $id_transaksi;

    header($loc);
} else {
    echo "Error: " . $query . "<br>" . $db->error;
    header("Location:katalog.php");
}

exit;
?>