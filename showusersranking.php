<?php

//Creates table with QRCodes
require_once('connect.php');

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT `login`, `class`, `points` FROM `users` ORDER BY `users`.`points` DESC";

if($result = $conn->query($sql)) {
    if ($result->num_rows) {
        createUserTableHead();

        $i = 1;
        while ($row = $result->fetch_assoc()){
            createUserTableRow($i, $row['login'], $row['class'], $row['points']);
            $i++;
        }

        createUserTableFooter();
    } else {
        echo "<div class=\"alert alert-info\">Brak kodów do wyświetlenia. <b>Znajdź jakieś!</b></div>";
    }

    $result->free_result();
}

$conn->close();

function createUserTableHead(){
    echo "<table class='table table-striped'><thead><tr><th>#</th><th>Nick</th><th>Klasa</th><th>Ilość punktów</th></tr></thead><tbody>";
}

function createUserTableRow($id, $login, $class, $points){
    echo "<tr><td>$id</td><td>$login</td><td>$class</td><td>$points pkt</td></tr>";
}

function createUserTableFooter(){
    echo "</tbody></table>";
}