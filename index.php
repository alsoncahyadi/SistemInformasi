<?php
session_start();
if (isset($_SESSION['cId'])) {
	header('Location:katalog.php');
} else {
	header('Location:login.php');
}