<?php
if(isset($_POST["submitLogin"])){
    $_SESSION["user"] = $_POST["name"];
    $_SESSION["password"] = $_POST["password"];
    $isAuthOk = is_auth($mysqli, $_SESSION["user"], $_SESSION["password"]);
    echo'<script>location.reload();</script>';
}

if(isset($_POST["submitRegister"])){
    $_SESSION["user"] = $_POST["name"];
    $_SESSION["password"] = $_POST["password"];
    $passwordwiderholen = $_POST["passwortwiederholen"];
    createUser($mysqli, $_SESSION["user"], false, $_SESSION["password"]);
    echo'<script>location.reload();</script>';
}

if(isset($_POST["abmelden"])){
    $_SESSION["user"] = null;
    echo'<script>location.reload();</script>';
}

if(isset($_POST["eintragErfassen"])){
    $date = new DateTime();
    insertEintrag($mysqli, $_SESSION["user"], $_POST["eintragText"], date('Y-m-d h:i:s'));
    echo'<script>location.reload();</script>';
}