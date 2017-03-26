<?php
/**
 * Created by PhpStorm.
 * User: R3
 * Date: 2017-03-26
 * Time: 17:57
 */

$lh = true;
$host = ($lh)?'localhost':'mysql.hostinger.pl';
$db_user = ($lh)?'root':'u402006295_r300';
$db_name = ($lh)?'qrcontest':'u402006295_rd';
$db_pass = ($lh)?'':'z9A23y8k6CIP';

//$conn = new mysqli($host, $db_user, $db_pass, $db_name);
//$conn->set_charset("utf8");

//if($conn->connect_error)
//{
//    die("<div class='alert alert-danger' style='margin: 0'><strong>Brak połączenia z DBMS!</strong><br> $conn->connect_error</div>");
//}
//
//$conn->select_db($db_name);
//$qchar = $_GET['char'];
//$sql = ($lh)? "SELECT * FROM cisco_dictionary WHERE `FirstChar` = '$qchar'" : "SELECT * FROM cisco_dictionary WHERE `FirstChar` = '$qchar'";
//$result = $conn->query($sql);
//if($result == false)
//    die("Error $conn->error");
//
//$resultArray = array();
//while($row = $result->fetch_row()) {
//    $resultArray[] = $row;
//}
//
//echo json_encode($resultArray);
//$conn -> close();
?>
