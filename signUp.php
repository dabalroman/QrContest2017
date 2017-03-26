<?php

session_start();

require_once "connect.php";

$login = htmlentities($_POST["login"], ENT_QUOTES, "UTF-8");
$salt = "$2y$10$410ehabvJ2J5AWrtO2wWCu0pW8lHaM7GQPgT63J.ITRbyirKgZ.mS";
$password = crypt(htmlentities($_POST["pass"], ENT_QUOTES, "UTF-8"), $salt);
$time = date("Y-m-d H:i:s");

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM users WHERE name='$login'";

if($result = @$conn->query($sql)){
    $userExists = $result->num_rows;
    if($userExists){
        $_SESSION["logged"] = false;
        $_SESSION["error"] = "user_exist";
        header('Location: index.php?src=register');

    } else {
        $sql = "INSERT INTO users(`LOGIN`, `PASS`, `SIGNUPTIME`, `LASTONLINE`, `SUPERUSER`) VALUES ('$name','$password','$time','$time',0)";
        if($result = @$conn->query($sql)) {
            $_SESSION["username"] = $login;
            $_SESSION["logged"] = true;
            unset($_SESSION['error']);
            header('Location: index.php?src=register');
        } else {
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "reg_err";
            header('Location: index.php?src=register');
        }
    }
    $result->free_result();
}

$conn->close();