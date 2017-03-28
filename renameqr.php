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
$name = $_GET['name'];
$value = $_GET['value'];

$sql = "UPDATE qrs SET name = '$name', value = '$value' WHERE id = '$id'";
@$conn->query($sql);

$conn->close();
header('Location: index.php?src=qrrename&out=ok_renamed');