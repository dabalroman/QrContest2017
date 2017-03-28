<?php

require_once('connect.php');

$QR_DATA_LENGTH = 8;
$QR_DATA_CHARS = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
$QR_URL = "qrcodes/";

$QRname = $_POST["qrname"];
$QRvalue = $_POST["qrvalue"];
$QRdata = createQRData($QR_DATA_LENGTH, $QR_DATA_CHARS);

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM qrs WHERE data='$QRdata' OR name='$QRname'";

if($result = $conn->query($sql)){
    $qrExists = $result->num_rows;
    if($qrExists){
        $_SESSION["error"] = "qr_exist";
        echo "ERR";
        header('Location: createqrcodepanel.php?src=createQRCode&out=err_qr_exists');

    } else {
        echo "EZY";
        $sql = "INSERT INTO qrs(`NAME`, `DATA`, `URL`, `VALUE`, `ACTIVE`) VALUES ('$QRname', '$QRdata', '".$QR_URL.$QRdata.".png', '$QRvalue', '1')";
        if($result = @$conn->query($sql)) {
            unset($_SESSION['error']);
            echo "EZY";
            header('Location: createqrcodepanel.php?src=createQRCode&out=ok_qr_created');
        } else {
            echo "ERR";
            $_SESSION["error"] = "qr_err";
            header('Location: createqrcodepanel.php?src=createQRCode&out=err_db');
        }
    }
    $result->free_result();
}
$conn->close();


function createQRData($QR_DATA_LENGTH, $QR_DATA_CHARS){
    $QRData = "";
    for($i = 0; $i <= $QR_DATA_LENGTH; $i++){
        $QRData .= substr($QR_DATA_CHARS, rand(0, strlen($QR_DATA_CHARS)), 1);
    }
    return $QRData;
}


