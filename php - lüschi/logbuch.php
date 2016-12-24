<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$mysqli = new mysqli("localhost", "logbuch", "gibbiX12345", "logbuch");
include 'lib_dbfunctions.php';
include 'lib_auth.php';
include 'lib_insert.php';
include 'lib_select.php';
$isConnectionOk = connection_ok($mysqli);
$isAuthOk = false;
include 'listeners.php';


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script type="text/javascript" src="jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbuch</title>
</head>
<body>
<!-- Header Sektion -->
<section class="header">
    <h1>Logbuch</h1>
</section>


<!-- Main Sektion -->
<?php
if (isset($_SESSION["user"])) {
    showLogout();
    displayEintraege();

} else {
    showLogin();
}
?>
</body>
</html>
