<?php

@session_start();

require_once('connect.php');
require_once('sessioncontrol.php');

if(!superuser()) {
    header('Location: index.php?src=login&out=err_auth');
    exit();
}

//Creates table with QRCodes

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM qrs";

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        createQRTableHeadSu();

        while ($row = $result->fetch_assoc()){
            createQRTableRowSu($row['id'], $row['name'], $row['data'], $row['url'], $row['value']);
        }

        createQRTableFooterSu();
    } else {
        echo "<div class=\"alert alert-info\">QR table is empty</div>";
    }

    $result->free_result();
}

$conn->close();

function createQRTableHeadSu(){
    echo "<div class=\"table-responsive\"><table class='table table-striped'><thead><tr><th>#</th><th>Name</th><th>Data</th><th>URL</th><th>Value</th><th>Remove</th></tr></thead><tbody>";
}

function createQRTableRowSu($id, $name, $data, $url, $value){
    echo "<tr><form action='renameqr.php'><th>$id</th><td class='min-width-md'><input type='hidden' value='$id' name='id'><div class=\"input-group\"><input class='form-control input-width-md' type='text' name='name' value='$name'><span class=\"input-group-btn\"><button type='submit' class='btn btn-default'>Ok</button></span></div></td><td>$data</td><td>$url</td><td class='min-width-sm'><div class=\"input-group\"><input class='form-control' type='text' name='value' value='$value'><span class=\"input-group-btn\"><button type='submit' class='btn btn-default'>Ok</button></span></div></td><td><a class=\"btn btn-default\" href=\"removeqr.php?id=$id\">Remove</a></td></form></tr>";
}

function createQRTableFooterSu(){
    echo "</tbody></table></div>";
}