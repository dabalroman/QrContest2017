<div class="jumbotron">
    <h1 class="text-center"><span style="color: #d60012">QR</span>CONTEST</h1>
    <h2 class="text-center">Zalogowano jako <span style="color: #d60012"><?php echo $_SESSION["username"] ?></span></h2>
    <h3 class="text-center">Punkty: <b id="points"></b></h3>
    <h4 class="text-center">Znajdź i zeskanuj kod QR aby zdobyć punkty!</h4>
    <h4 class="text-center">Możesz rownież wpisać kod ręcznie w ramce poniżej.</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($_GET['out'])){
                if($_GET['out'] == "ok_code_added"){
                    echo "<div class=\"alert alert-success\"><b>Brawo!</b> Kod dodany pomyślnie.</div>";
                }
                if($_GET['out'] == "err_code_already_added"){
                    echo "<div class=\"alert alert-danger\"><b>Ups...</b> Ten kod został już użyty, znajdź inny.</div>";
                }
                if($_GET['out'] == "err_code_not_found"){
                    echo "<div class=\"alert alert-danger\"><b>Ups...</b> Ten kod jest niepoprawny.</div>";
                }
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Wpisz kod</div>
                <div class="panel-body">
                    <p>Nie możesz zeskanować kodu? Nie ma problemu! Wpisz go tutaj:</p>
                    <form action="collectqr.php" class="form">
                        <div class="form-group">
                            <label class="control-label" for="inputCode">Kod</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputCode" placeholder="Kod" name="code">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default float-right">Ok</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Twoje kody</div>
                <div class="panel-body">
                <?php
                    require("showcodestable.php");
                ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Ranking</div>
                <div class="panel-body">
                <?php
                    require("showusersranking.php");
                ?>
                </div>
            </div>
            <a href="logout.php"><div class="btn btn-default float-right">Wyloguj</div></a>
        <div class="clearfix top-buffer"></div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <script>
        var points = document.getElementById("tpoints");
        document.getElementById("points").innerHTML = (points != null)? points.innerHTML : "0 pkt";
    </script>
</div>