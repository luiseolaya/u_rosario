<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$_SESSION['color_aleatorio'] = $data['color_aleatorio'];
$_SESSION['mensaje_aleatorio'] = $data['mensaje_aleatorio'];
?>
