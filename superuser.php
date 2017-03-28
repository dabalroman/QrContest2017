<div class="top-buffer"></div>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><div><a data-toggle="collapse" href="#collapseSU">Superuser</a></div></div>
        <div id="collapseSU" class="panel-body collapse in">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="createqrcodepanel.php"><div class="btn btn-default">Create QR Code</div></a>
                    <a href="qrgenerator.php"><div class="btn btn-default">Generate QR Codes</div></a>
                    <a href="updateuserspoints.php"><div class="btn btn-default">Force update points</div></a>
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

            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    <?php
                    require("showuserssu.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

