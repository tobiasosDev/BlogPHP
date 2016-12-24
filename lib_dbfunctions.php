<?php

/***************************************************************************
* VERSION: 2  (jede neue Verteilung wegen Änderungen zählt Version 1 hoch) *
***************************************************************************/

// Überprüfen ob DB-Verbindung i.O. ist
function connection_ok($mysqli) {
    if ($mysqli->connect_errno) {
        return false;
    }
    else {
        return true;
    }
}

// Überprüft das Passwort eines Benutzers in der Datenbank
function is_auth($mysqli, $user, $pass) {

    if($result = $mysqli->query("SELECT user.pw_blowfish FROM user WHERE user.name = '$user' LIMIT 1;")) {
        $row = mysqli_fetch_array($result);
        if (password_verify($pass, $row['pw_blowfish'])) {
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;;
    }
    return false;
}

// Trägt eine Nachricht in die Datenbank ein.
// Der übergebene Autor muss dem Namen eines Users in der DB entsprechen.
function insert_entry($mysqli, $autor, $eintrag, $zeitpunkt) {
    $eintrag = $mysqli->real_escape_string($eintrag);
    $mysqli->query("INSERT INTO post (autor, nachricht, zeitpunkt) VALUES ((SELECT user.id FROM user WHERE user.name = '$autor'), '$eintrag', '$zeitpunkt' );");
}

// Gibt ein Array der neuesten Einträge zurück.
function select_entries($mysqli, $max) {

    if ($result = $mysqli->query("SELECT post.nachricht, post.zeitpunkt, user.name FROM post join user ON post.autor = user.id ORDER BY post.zeitpunkt DESC, post.id DESC LIMIT $max")) {

        $entries = array();
        while ($entry = mysqli_fetch_array($result)) {
            array_push($entries, $entry);
        }
        $result->close();
        return $entries;
    }
    else {
        return NULL;
    }
}

/***************************************************************************
* Autor: Boris Däppen, 2016, ict Modul 133                                 *
***************************************************************************/
?>
