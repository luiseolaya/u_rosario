<?php
session_start();
session_destroy();
header("Location: inicio_seccion.php");
exit;
?>
