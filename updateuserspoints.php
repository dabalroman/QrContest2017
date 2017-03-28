<?php

session_start();
//Creates table with QRCodes
require_once('connect.php');
require_once('sessioncontrol.php');

if(!superuser()) {
    header('Location: index.php?src=login&out=err_auth');
    exit();
}

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT id FROM `users`";

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $sql2 = "SELECT SUM(qrs.value) AS points FROM qrs INNER JOIN collectedqrs ON qrs.id = collectedqrs.id_qr WHERE collectedqrs.id_user = $id";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $points = $row2['points'];
            $sql3 = "UPDATE users SET points = '$points' WHERE users.id = $id";
            $conn->query($sql3);
        }
    } else {
        echo "<div class=\"alert alert-info\">Users table is empty.</div>";
    }
    $result->free_result();
}

$conn->close();
header('Location: index.php?src=login&out=ok_update');
