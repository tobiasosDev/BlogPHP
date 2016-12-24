<!DOCTYPE html>
<html lang="de">
 <head>
  <meta charset="utf-8">
  <title>DB-Init</title>
 </head>
 <body>
<?php
/* ------------------------------------------------------------------------------------------------------------------------------- */

//                    host         user       passwort       datenbankname
$mysqli = new mysqli("localhost", "logbuch", "gibbiX12345", "logbuch");

web_prompt("PHP-Skript zur Initialisierung der Datenbank startet");

// Abbrechen wenn MySQL-Verbindung nicht klappt
if ($mysqli->connect_errno) {
    echo "Connect failed: %s\n" . $mysqli->connect_error;
    exit();
}
else {
	web_prompt("MySQL-Verbindung offen");
}

// Erstelle Tabelle "user", falls noch keine besteht
$result = $mysqli->query("SHOW TABLES LIKE 'user';" );

if ($result->num_rows == 0 ) {
    web_prompt("Noch keine Tabelle 'user' vorhanden");
    
    if ($mysqli->query("CREATE TABLE user ( id MEDIUMINT NOT NULL AUTO_INCREMENT, name varchar(30), admin tinyint, pw_blowfish varchar(60), PRIMARY KEY (id) );" )) {
        web_prompt("Tabelle 'user' erstellt");
    }

    // Mache einen Eintrag in die Tabelle
    $mysqli->query('INSERT INTO user (name, admin, pw_blowfish) VALUES ( "dagr@gibb.ch", 1, "$2y$10$FNuYcHEQ9o9gjSSkI21CZe9yrrb/tVzCygv0WHHSzgqekQ7Kvri9." );' );   // Vikinger-Gott des Tages
    $mysqli->query('INSERT INTO user (name, admin, pw_blowfish) VALUES ( "nott@gibb.ch", 0, "$2y$10$JBFLxGVFTe6skyQVZDz2vuW.DSgYiAzGI8TXocNKOxffxqLtjyVaa" );' );     // Vikinger-Göttin der Nacht
    web_prompt("Einträge in Tabelle 'user' vorgenommen");
}
else {
    web_prompt("Tabelle 'user' existiert bereits, erstelle keine Neue");
}
// Erstelle Tabelle "post", falls noch keine besteht
$result = $mysqli->query("SHOW TABLES LIKE 'post';" );

if ($result->num_rows == 0 ) {
    web_prompt("Noch keine Tabelle 'post' vorhanden");
    
    if ($mysqli->query("CREATE TABLE post ( id MEDIUMINT NOT NULL AUTO_INCREMENT, nachricht varchar(255), zeitpunkt DATETIME, autor MEDIUMINT, PRIMARY KEY (id), FOREIGN KEY (autor) REFERENCES user(id) );" )) {
        web_prompt("Tabelle 'post' erstellt");
    }

    // Mache einen Eintrag in die Tabelle
    $mysqli->query("INSERT INTO post (nachricht, zeitpunkt, autor) VALUES ( 'Hallo Welt!', '" . date("Y-m-d H:i:s") . "', 1 );" );
    $mysqli->query('INSERT INTO post (nachricht, zeitpunkt, autor) VALUES ( "Ja, Grüsse alle Zusammen auch von mir :-)\n<3 <3 <3", "' . date("Y-m-d H:i:s") . '", 2 );' );
    web_prompt("Einträge in Tabelle 'post' vorgenommen");
}
else {
	web_prompt("Tabelle 'post' existiert bereits, erstelle keine Neue");
}



// Zeige Inhalt der Tabellen an (max. 10 Reihen)

web_prompt("Liste DB-Einträge in Tabelle 'user' auf:");

if ($result = $mysqli->query("SELECT id, name, admin, pw_blowfish FROM user LIMIT 10")) {

    echo "  <table border=1>\n";
    echo "   <tr><th>id</th><th>name</th><th>admin</th><th>pw_blowfish</th></tr>";
    while ($row = mysqli_fetch_array($result)) 
    {
        echo "   <tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['admin'] . "</td><td>" . $row['pw_blowfish'] . "</td></tr>\n";
    }
    echo "  </table>\n";

    /* free result set */
    $result->close();
}

web_prompt("Liste DB-Einträge in Tabelle 'post' auf:");

if ($result = $mysqli->query("SELECT id, nachricht, zeitpunkt, autor FROM post LIMIT 10")) {

    echo "  <table border=1>\n";
    echo "   <tr><th>id</th><th>autor</th><th>zeitpunkt</th><th>nachricht</th></tr>";
    while ($row = mysqli_fetch_array($result))
    {
        echo "   <tr><td>" . $row['id'] . "</td><td>" . $row['autor'] . "</td><td>" . $row['zeitpunkt'] . "</td><td>" . nl2br($row['nachricht']) . "</td></tr>\n";
    }
    echo "  </table>\n";

    /* free result set */
    $result->close();
}


// Gibt einen Text als HTML-Absatz aus
function web_prompt ($msg) {
	echo "  <p>$msg</p>\n";
}

/* ------------------------------------------------------------------------------------------------------------------------------- */
?>
 </body>
</html>
<!-- Autor: Boris Däppen, September 2016, ict Modul 133 -->