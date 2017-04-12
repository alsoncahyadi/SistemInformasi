<?php
require_once ("dbconf.php");

$uname = $_POST['form-username'];
$pwd = $_POST['form-password'];
$namalengkap = $_POST['form-namalengkap'];
$email = $_POST['form-email'];
$nomerhp = $_POST['form-nomerhp'];

$stmt = $db->prepare("SELECT id_user FROM users WHERE username = ?");
$stmt->bind_param('s', $uname);
$stmt->execute();
if ($stmt->fetch()) {
	session_start();
	$_SESSION['registerErrMsg'] = 'Username "' . $uname . '" sudah ada';
	header('Location:register.php');
} else {
	$stmt->close();
	$stmt = $db->prepare("INSERT INTO users (username, password, nama, nomerhp) VALUES (?,?,?,?)");
	$stmt->bind_param('ssss', $uname, $pwd, $namalengkap, $nomerhp);
	$stmt->execute();
	$stmt->close();
	header('Location:login.php');
}
exit;
?>
