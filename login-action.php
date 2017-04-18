<?php
require_once ("dbconf.php");

$uname = $_POST['form-username'];
$pwd = $_POST['form-password'];

$stmt = $db->prepare("SELECT id_user FROM users WHERE username = ? AND password = ?");
$stmt->bind_param('ss', $uname, $pwd);
$stmt->execute();
$stmt->bind_result($id_user);
$valid = $stmt->fetch();
session_start();
if ($valid) {
    $_SESSION['cId'] = $id_user;
    header("Location:katalog.php");
} else {
    $_SESSION['loginErrMsg'] = "Login gagal: Username atau password salah";
    header("Location:login.php");
}
$stmt->close();
exit;
?>
