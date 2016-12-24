<?php
    function createUser($mysqli, $name, $admin, $password){
        $mysqli->query("INSERT INTO user(name, admin, pw_blowfish) VALUES ('$name','$admin','$password');");
    }

    function showLogout(){
        echo '
    <p>Eingelogt als: ' . $_SESSION["user"] . '</p>
    <br>
    <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
        <button name="abmelden">abmelden</button>
    </form>
    <br>
    <h1>Eintrag erfassen</h1>
    <br>
    <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
        <textarea name="eintragText" placeholder="Hier Eintrag eingeben"></textarea>
        <button name="eintragErfassen">Erfassen</button>
    </form>
    <br>
    <h1>Einträge Lesen</h1>
    <br>';
    }

    function showLogin(){
        echo '<section class="main">
    <h2 id="titel">Bitte Einloggen</h2>
    <form action="" method="post">
        <!-- Input Name -->
        <input id="name" type="text" name="name" class="input" placeholder="Benutzername" onkeyup="checkLogin()"><br>
        <br>

        <!-- Input Passwort -->
        <input id="password" type="password" name="password" class="input" placeholder="Passwort" onkeyup="checkLogin()"><br>
        <!-- Input Passwort wiederholen -->
        <input id="check" type="checkbox" onchange="checkbox()">Ich möchte mich neu registrieren
        <br>
        <button name="submitLogin" >Anmelden</button>
    </form>
    <br>
    <div id="error">

    </div>
    </section>';
    }
?>