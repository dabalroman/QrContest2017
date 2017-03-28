<?php

//Creates table with QRCodes
require_once('connect.php');

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);
$points = 0;

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT qrs.name, qrs.value FROM qrs INNER JOIN collectedqrs ON qrs.id = collectedqrs.id_qr WHERE collectedqrs.id_user = ".$_SESSION['userid'];

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        createQRTableHead();

        $i = 1;
        while ($row = $result->fetch_assoc()){
            createQRTableRow($i, $row['name'],  $row['value']);
            $i++;
            $points += $row['value'];
        }

        createQRTableFooter($points);
    } else {
        echo "<div class=\"alert alert-info\">Brak kodów do wyświetlenia. <b>Znajdź jakieś!</b></div>";
    }

    $result->free_result();
}

//Update user points and lastOnline
$sql = "UPDATE users SET points = '$points', lastonlinetime = NOW() WHERE users.id = '".$_SESSION['userid']."'";
@$conn->query($sql);

$conn->close();

function createQRTableHead(){
    echo "<table class='table table-striped'><thead><tr><th>#</th><th>Nazwa</th><th>Wartość</th></tr></thead><tbody>";
}

function createQRTableRow($id, $name, $value){
    echo "<tr><td>$id</td><td>$name</td><td>$value pkt</td></tr>";
}

function createQRTableFooter($points){
    echo "<tr><th colspan='2'>Razem</th><th id='tpoints'>$points pkt</th></tr>";
    echo "</tbody></table>";
}