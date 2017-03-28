<?php
error_reporting(0);
session_start();

require_once('domelements.php');
require_once('sessioncontrol.php');

//Create DOM
createHead();

if(userLogged()) {
    //Code in GET?
    if(isset($_GET["code"])){
        header('Location: collectqr.php?code='.$_GET["code"]);
        exit();
    }

    if (superuser())
        require_once('superuser.php');
    //Create user panel
    require_once('userpanel.php');
} else {
    //Code in GET?
    if(isset($_GET["code"])){
        $_SESSION["code"] = $_GET["code"];
    }

    //Create login panel
    require_once('signinuppanel.php');
}
createFooter();
/**
 * Created by PhpStorm.
 * User: R3
 * Date: 2017-03-26
 * Time: 15:47
 */
//include "qrgenerator.php";
//error_reporting(0);

//echo "<img src='".createRawQRCode('www.it-day.pl', 001)."'>";