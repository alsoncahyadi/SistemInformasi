<?php
    require_once ("dbconf.php");

    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    //Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $id_user = $_GET['user'];
    $id_produk = $_GET['id_produk'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $rincian = $_POST['rincian'];
    if (basename($_FILES["fileToUpload"]["name"])=="") {
        $sql = "SELECT foto FROM produk WHERE id_produk=$id_produk";    
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }   

        $path = $row["foto"];
        $path = "img". "\\\\". substr($path, 3); 
    } else{
        $path = "img". "\\\\". basename($_FILES["fileToUpload"]["name"]);
    }

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 

    $sql =  "UPDATE produk SET nama='$nama', harga=$harga, deskripsi='$rincian', foto='$path'
        WHERE id_produk=$id_produk";

    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    header("Location:katalog.php?user=" . $id_user); 

    exit;



?>
