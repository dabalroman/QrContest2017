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

$sql = "SELECT * FROM `users`";

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        createUserSUTableHead();

        $i = 1;
        while ($row = $result->fetch_assoc()){
            createUserSUTableRow($i, $row['login'],  $row['name'], $row['class'], $row['points'], $row['signuptime'], $row['lastonlinetime'], $row['superuser']);
            $i++;
        }

        createUserSUTableFooter();
    } else {
        echo "<div class=\"alert alert-info\">Users table is empty.</div>";
    }

    $result->free_result();
}

$conn->close();

function createUserSUTableHead(){
    echo "<div class=\"table-responsive\"><table class='table table-striped'><thead><tr><th>#</th><th>Login</th><th>Name</th><th>Class</th><th>Points</th><th>SignUpTime</th><th>LastOnlineTime</th><th>SU</th></tr></thead><tbody>";
}

function createUserSUTableRow($id, $login, $name, $class, $points, $signUp, $lastOnline, $su){
    echo "<tr><td>$id</td><td>$login</td><td>$name</td><td>$class</td><td>$points</td><td>$signUp</td><td>$lastOnline</td><td>$su</td></tr>";
}

function createUserSUTableFooter(){
    echo "</tbody></table></div>";
}