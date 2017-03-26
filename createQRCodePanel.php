<?php

require_once('DOMElements.php');
require_once('sessionControl.php');

createHead();

?>
<div class="top-buffer"></div>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Add QR Code</div>
        <div class="panel-body">
            <form action="createQRCode.php" class="form" method="post">
                <div class="form-group">
                    <label for="qrname" class="control-label">QR code name:</label>
                    <input type="text" class="form-control" placeholder="Name" name="qrname">
                </div>
                <div class="form-group">
                    <label for="qrvalue" class="control-label">QR code value:</label>
                    <input type="text" class="form-control" placeholder="Value" name="qrvalue">
                </div>
                <button type="submit" class="btn btn-default">Create</button>
            </form>
        </div>
    </div>
</div>

<?php
//if($QRcreated)
//    echo "<img src='".createRawQRCode("smieszkowo.pl", $QRname)."'>";
createFooter();