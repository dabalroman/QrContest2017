<?php

@session_start();

require_once('connect.php');
require_once('sessioncontrol.php');
require_once('domelements.php');

createHead();

//Creates table with QRCodes

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT qrs.name, users.login, collectedqrs.time, qrs.value FROM collectedqrs INNER JOIN qrs ON id_qr = qrs.id INNER JOIN users ON id_user = users.id ORDER BY collectedqrs.time";

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        createQRTableHeadSu();

        $i = 0;
        while ($row = $result->fetch_assoc()){
            createQRTableRowSu($i, $row['name'], $row['login'], $row['time'], $row['value']);
            $i++;
        }

        createQRTableFooterSu();
    } else {
        echo "<div class=\"alert alert-info\">QR table is empty</div>";
    }

    $result->free_result();
}

$conn->close();

function createQRTableHeadSu(){
    echo "<div class=\"table-responsive\"><table class='table table-striped'><thead><tr><th>#</th><th>Time</th><th>QR Name</th><th>User</th><th>Value</th></tr></thead><tbody>";
}

function createQRTableRowSu($id, $name, $user, $time, $value){
    echo "<tr><td>$id</td><td>$time</td><td>$name</td><td>$user</td><td>$value pts</td></tr>";
}

function createQRTableFooterSu(){
    echo "</tbody></table></div>";
}

createFooter();