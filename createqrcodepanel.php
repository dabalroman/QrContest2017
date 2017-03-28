<?php

session_start();

require_once('domelements.php');
require_once('sessioncontrol.php');

if(!userLogged())
    header('Location: index.php?src=createqrcodepanel&out=err_usr_not_logged');

createHead();

?>
<div class="top-buffer"></div>
<div class="container">

    <?php
    if(isset($_GET['out'])){
        echo "<div class=\"alert alert-info\">".$_GET['out']."</div>";
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">Actions</div>
        <div class="panel-body">
            <a href="index.php"><div class="btn btn-default">Main Page</div></a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Add Code</div>
        <div class="panel-body">
            <form action="createqrcode.php" class="form" method="post">
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
    <div class="panel panel-default">
        <div class="panel-heading">Codes</div>
        <div class="panel-body">
        <?php
            require("showcodestablesu.php");
        ?>
        </div>
    </div>
</div>

<?php
//if($QRcreated)
//    echo "<img src='".createRawQRCode("smieszkowo.pl", $QRname)."'>";
createFooter();