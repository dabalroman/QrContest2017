<?php

session_start();

require_once "connect.php";

$login = htmlentities($_POST["login"], ENT_QUOTES, "UTF-8");
$salt = "$2y$10$410ehabvJ2J5AWrtO2wWCu0pW8lHaM7GQPgT63J.ITRbyirKgZ.mS";
$password = crypt(htmlentities($_POST["password"], ENT_QUOTES, "UTF-8"), $salt);
$time = date("Y-m-d H:i:s");

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM users WHERE login='$login' AND password='$password'";

if($result = @$conn->query($sql)){
    $userExists = $result->num_rows;
    if($userExists){
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["login"];
        $_SESSION["userid"] = $row["id"];
        $_SESSION["superuser"] = $row["superuser"];

        $sql = "UPDATE users SET lastonlinetime = '$time' WHERE users.id = '".$row["ID"]."'";
        @$conn->query($sql);

        $_SESSION["logged"] = true;
        unset($_SESSION['error']);

        //Handle code from session
        if(isset($_SESSION["code"])) {
            header('Location: collectqr.php?code='.$_SESSION["code"]);
            unset($_SESSION['code']);
        } else {
            header('Location: index.php?src=login&out=ok_user_logged');
        }

    } else {
        $_SESSION["logged"] = false;
        $_SESSION["error"] = "login_err";
        header('Location: index.php?src=login&out=err_db');
    }
    $result->free_result();
}

$conn->close();