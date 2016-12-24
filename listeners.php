<?php
if(isset($_POST["btnSubmit"])){
    if(isset($_POST["password_confirmation"])) {
        $_SESSION["user"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        $passwordwiderholen = $_POST["password_confirmation"];
        createUser($mysqli, $_SESSION["user"], false, $_SESSION["password"]);
        echo '<script>location.reload();</script>';
    }else {
        $_SESSION["user"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        $auth = is_auth($mysqli, $_SESSION["user"], $_SESSION["password"]);
        echo '<script>location.reload();</script>';
    }
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