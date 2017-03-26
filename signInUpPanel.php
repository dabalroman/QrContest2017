<div class="jumbotron">
    <h1 class="text-center">QRCONTEST</h1>
    <h3 class="text-center">Zaloguj się poniżej aby wziąć udział w konkursie!</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($_SESSION['logged']) && isset($_SESSION['error'])){
                if($_SESSION['logged'] == false && $_SESSION['error'] == "login_err"){

                    echo "<div class=\"alert alert-danger\">Błąd logowania! Nieprawidłowy login lub hasło</div>";
                    unset($_SESSION['error']);
                }
            }
            if(isset($_GET['src'])){
                if($_GET['src'] == "logout"){
                    echo "<div class=\"alert alert-info\">Wylogowano pomyślnie.</div>";
                    unset($_GET['src']);
                }
            }
            ?>
            <form class="form" action="signIn.php" method="post">
                <div class="form-group">
                    <label class="control-label" for="inputLogin">Login</label>
                    <input type="text" class="form-control" id="inputLogin" placeholder="Login" name="login">
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputPassword">Hasło</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Hasło" name="pass">
                </div>
                <button type="submit" class="btn btn-default">Zaloguj</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            if(isset($_GET['src'])){
                if($_GET['src'] == "register"){
                    echo "<div class=\"alert alert-info\">Użytkownik z podanym loginem już istnieje.</div>";
                    unset($_GET['src']);
                }
            }
            ?>
            <form class="form" action="signUp.php" method="post">
                <div class="form-group">
                    <label class="control-label" for="inputLogin">Login</label>
                    <input type="text" class="form-control" id="inputLogin" placeholder="Login" name="login">
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputPassword">Hasło</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Hasło" name="pass">
                </div>
                <button type="submit" class="btn btn-default">Zarejestruj</button>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>