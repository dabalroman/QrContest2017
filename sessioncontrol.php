<?php

function userLogged() {
    if (isset($_SESSION['logged']) && !isset($_SESSION['error']))
        if($_SESSION['logged'] == true)
            return 1;
    return 0;
}

function userLogout() {
    session_destroy();
    //unset($_SESSION['logged']);
    //unset($_SESSION['error']);
    return 1;
}

function superuser() {
    if(isset($_SESSION['superuser']))
        if($_SESSION['superuser'] == 1)
            return 1;
    return 0;
}