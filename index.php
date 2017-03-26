<?php
session_start();

require_once('DOMElements.php');
require_once('sessionControl.php');

createHead();

if(userLogged()) {
    if (superuser())
        require_once('superuser.php');
    require_once('userPanel.php');
}
else
    require_once('signInUpPanel.php');

createFooter();
/**
 * Created by PhpStorm.
 * User: R3
 * Date: 2017-03-26
 * Time: 15:47
 */
include "rawQrGenerator.php";
//error_reporting(0);

//echo "<img src='".createRawQRCode('www.it-day.pl', 001)."'>";