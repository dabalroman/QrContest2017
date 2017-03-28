<?php

session_start();

//Remove QR
require_once('connect.php');
require_once('sessioncontrol.php');

if(!superuser()) {
    header('Location: index.php?src=login&out=err_auth');
    exit();
}

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$id = $_GET['id'];

$sql = "DELETE FROM collectedqrs WHERE id_qr = $id";
$conn -> query($sql);
$sql = "DELETE FROM qrs WHERE id = $id";
$conn -> query($sql);
$conn -> close();
header('Location: index.php?src=login&out=ok_removed');