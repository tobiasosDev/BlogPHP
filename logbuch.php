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
$Connected = connection_ok($mysqli);
$auth = false;
include 'listeners.php';


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Projekt Tim Kühni</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Javascript -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</head>
<body>
<h1 class="text-center whiteFont">Anmeldung / Login</h1>
<br>

<div id="alertError" class="alert alert--error"></div>
<div id="alertInput" class="alert alert--success"></div>

<div class="form-group">
    <label class="inline whiteFont" for="formChange">Login Modus</label><input type="checkbox" name="formChange" id="formChange">
</div>


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
