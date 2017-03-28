<?php

session_start();

require_once "connect.php";

//Get data from Form
$name = htmlentities($_POST["name"], ENT_QUOTES, "UTF-8");
$login = htmlentities($_POST["login"], ENT_QUOTES, "UTF-8");
$class = htmlentities($_POST["class"], ENT_QUOTES, "UTF-8");
$salt = "$2y$10$410ehabvJ2J5AWrtO2wWCu0pW8lHaM7GQPgT63J.ITRbyirKgZ.mS";
$password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");
$time = date("Y-m-d H:i:s");

if($name == "" || $login == "" || $class == "" || $password == ""){
    $_SESSION["logged"] = false;
    $_SESSION["error"] = "reg_blank";
    header('Location: index.php?src=register&out=err_blank');
    exit();
}

$password = crypt($password, $salt);

//Connect to db
$conn = @new mysqli($host, $db_user, $db_pass, $db_name);

if($conn -> connect_errno != 0)
    die("Can't connect with db! <br>". $conn->connect_errno . "<br>". $conn->connect_error);

$sql = "SELECT * FROM users WHERE login='$login'";

if($result = @$conn->query($sql)){
    $userExists = $result->num_rows;
    if($userExists){
        //User exists?
        $_SESSION["logged"] = false;
        $_SESSION["error"] = "user_exist";
        header('Location: index.php?src=register&out=err_user_exist');

    } else {
        //Create account and get ID
        $sql = "INSERT INTO users(`login`, `name`, `class`, `password`, `signuptime`, `lastonlinetime`, `superuser`, `points`) VALUES ('$login', '$name', '$class', '$password','$time','$time', 0, 0)";
        @$conn->query($sql);
        $sql = "SELECT login, id, superuser FROM users WHERE login = '$login'";
        if($result2 = @$conn->query($sql)) {
            //Account created
            $row = $result2->fetch_assoc();
            $_SESSION["username"] = $row["login"];
            $_SESSION["userid"] = $row["id"];
            $_SESSION["superuser"] = $row["superuser"];
            $_SESSION["logged"] = true;
            unset($_SESSION['error']);

            //Handle code from session
            if(isset($_SESSION["code"])){
                header('Location: collectqr.php?code='.$_SESSION["code"]);
                unset($_SESSION['code']);
            } else {
                header('Location: index.php?src=register&out=ok_user_created');
            }
            $result2->free_result();
        } else {
            //Error
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "reg_err";
            header('Location: index.php?src=register&out=err_db');
        }
    }
    $result->free_result();
}

$conn->close();