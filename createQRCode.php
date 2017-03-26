<?php

require_once('rawQrGenerator.php');
require_once "connect.php";

define("QR_DATA_LENGTH", 10);
define("QR_DATA_CHARS", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789");
define("QR_DIR", "QRCodes/");

$QRname = $_POST["qrname"];
$QRvalue = $_POST["qrvalue"];
$QRdata = createQRData();

$QR = createRawQRCode($QRdata, $QRname, QR_DIR);

echo $QR;

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM qrs WHERE data='$QRdata' OR name='$QRname'";

if($result = $conn->query($sql)){
    $qrExists = $result->num_rows;
    if($qrExists){
        $_SESSION["error"] = "qr_exist";
        echo "ERR";
        header('Location: createQRCodePanel.php?src=createQRCode');

    } else {
        echo "EZY";
        $sql = "INSERT INTO qrs(`NAME`, `DATA`, `VALUE`, `ACTIVE`) VALUES ('$QRname', '$QRdata', '$QRvalue', '1')";
        if($result = @$conn->query($sql)) {
            unset($_SESSION['error']);
            echo "EZY";
            header('Location: createQRCodePanel.php?src=createQRCode');
        } else {
            echo "ERR";
            $_SESSION["error"] = "qr_err";
            header('Location: createQRCodePanel.php?src=createQRCode');
        }
    }
    $result->free_result();
}



$conn->close();


function createQRData(){
    $QRData = "";
    for($i = 0; $i <= QR_DATA_LENGTH; $i++){
        $QRData .= QR_DATA_CHARS[rand(0, strlen(QR_DATA_CHARS))];
    }
    return $QRData;
}


