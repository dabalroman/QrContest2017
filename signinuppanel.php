<div class="jumbotron">
    <h1 class="text-center"><span style="color: #d60012">QR</span>CONTEST</h1>
    <h3 class="text-center">Zaloguj się aby wziąć udział w konkursie!</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($_SESSION['logged']) && isset($_SESSION['error'])){
                if($_SESSION['logged'] == false && $_SESSION['error'] == "login_err"){

                    echo "<div class=\"alert alert-danger\"><b>Błąd logowania!</b> Nieprawidłowy login lub hasło</div>";
                    unset($_SESSION['error']);
                }
            }
            if(isset($_GET['src'])){
                if($_GET['src'] == "logout"){
                    echo "<div class=\"alert alert-success\"><b>Wylogowano pomyślnie.</b></div>";
                }
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Logowanie</div>
                <div class="panel-body">
                    <form class="form" action="signin.php" method="post">
                        <div class="form-group">
                            <label class="control-label" for="inputLogin">Nick</label>
                            <input type="text" class="form-control" id="inputLogin" placeholder="Nick" name="login">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inputPassword">Hasło</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Hasło" name="password">
                        </div>
                        <button type="submit" class="btn btn-default float-right">Zaloguj</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($_GET['out'])){
                if($_GET['out'] == "err_user_exist"){
                    echo "<div class=\"alert alert-danger\"><b>Ups... </b>Użytkownik z tym loginem już istnieje.</div>";
                }
                if($_GET['out'] == "err_blank"){
                    echo "<div class=\"alert alert-info\"><b>Nie tak prędko! </b>Pozostawiono puste pole</div>";
                }
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading"><a data-toggle="collapse" href="#collapse1"><div>Rejestracja nowego użytkownika</div></a></div>
                <div id="collapse1" class="panel-body collapse">
                    <form class="form" action="signup.php" method="post">
                        <div class="form-group">
                            <label class="control-label" for="inputLogin">Nick</label>
                            <input type="text" class="form-control" id="inputLogin" placeholder="Nick" name="login">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inputName">Imię</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Imię" name="name">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inputClass">Klasa</label>
                            <input type="text" class="form-control" id="inputClass" placeholder="Klasa" name="class">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inputPassword">Hasło</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Hasło" name="password">
                        </div>
                        <button type="submit" class="btn btn-default float-right">Zarejestruj</button>
                        <div class="clearfix"></div>
                    </form>
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
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>