<?php

session_start();
unset($_SESSION['cId']);
header('Location:login.php');