<?php
require_once ("dbconf.php"); 

session_start();
if (isset($_SESSION['cId'])) {
    $id_user = $_SESSION['cId'];
} else {
    header('Location:login.php');
}

if (!isset($_GET['transaksi'])) {
    //Randomize transaction number
    for ($i = 0; $i<5; $i++) {
        $a .= mt_rand(0,9);
    }
    $id_transaksi = $a;
    header("Location:pembayaran-produk.php?&transaksi=" . $id_transaksi); 
} else {
    $id_transaksi = $_GET['transaksi'];
    $sql = "SELECT id_produk, jumlah FROM cartitem WHERE id_user=$id_user";    
    $result = $db->query($sql);
    $total_harga = 0;
    $row_produk = "";
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM cartitem WHERE id_user=$id_user";    
        $db->query($sql);
        while($row = $result->fetch_assoc()) {

            $id_produk = $row["id_produk"];
            $jumlah = $row["jumlah"];
            $sql =  "INSERT INTO produkdalamtransaksi(id_transaksi, id_produk, jumlah) VALUES ($id_transaksi, $id_produk, $jumlah);";

            if ($db->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }        
        }
    }  else {
        echo "0 results";
    }
    $db->close();    
    header("Location:katalog.php"); 
}

exit;



?>
