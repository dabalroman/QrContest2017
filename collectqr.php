<?php
session_start();

require_once('connect.php');
require_once('sessioncontrol.php');


if(!userLogged()){
    header('Location: index.php?src=collectqr&out=err_not_logged');
    exit();
}

if(!isset($_GET["code"]) || !isset($_SESSION["userid"])){
    header('Location: index.php?src=collectqr&out=err_data');
    exit();
}

$code = htmlentities($_GET["code"]);
$code_id = null;
$user_id = $_SESSION["userid"];
$time = date("Y-m-d H:i:s");

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

//Is requested code exists in db?
$sql = "SELECT id FROM qrs WHERE data='$code'";
if($result = @$conn->query($sql)){
    if($result->num_rows) {
        //Code exists
        $row = $result->fetch_assoc();
        $code_id = $row['id'];

        //Relation qr - user exists?
        $sql = "SELECT * FROM collectedqrs WHERE id_user='$user_id' AND id_qr='$code_id'";
        if($result = @$conn->query($sql)) {
            if ($result->num_rows) {
                //Code exists
                header('Location: index.php?src=collectqr&out=err_code_already_added');
            } else {
                //Adding code - user relation
                $sql = "INSERT INTO `collectedqrs` (`id_user`, `id_qr`, `time`) VALUES ('$user_id', '$code_id', '$time')";
                if ($result = @$conn->query($sql)) {
                    //Done
                    header('Location: index.php?src=collectqr&out=ok_code_added');
                } else {
                    //Err
                    header('Location: index.php?src=collectqr&out=err_insert_db');
                }
            }
            $result->free_result();
        }
    } else {
        //Code not exists
        header('Location: index.php?src=collectqr&out=err_code_not_found');
    }
    $result->free_result();
} else {
    //Code not exists
    header('Location: index.php?src=collectqr&out=db_err');
}

$conn->close();