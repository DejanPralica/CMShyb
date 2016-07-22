<?php
session_start();
session_unset();
session_destroy();
$_SESSION['bajo_ulogovan'] = false;  //OVERKILL
header("Location:login.php")
?>