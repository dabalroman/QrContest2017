<?php
/**
 * Created by PhpStorm.
 * User: R3
 * Date: 2017-03-26
 * Time: 15:47
 */
error_reporting(0);
require_once "phpqrcode/qrlib.php";
require_once "phpqrcode/qrconfig.php";

function createRawQRCode($data, $name, $dir){
    QRcode::png($data, $dir.$name.'.png', QR_ECLEVEL_L, 8);
    return $dir.$name.'.png';
}
