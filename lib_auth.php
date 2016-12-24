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
        echo '
    <form id="loginForm" method="POST" action="">
		<div class="form-group">
			<label class="whiteFont" for="username">Benutzername</label>
			<!-- Check E-Mail -->
			<input class="form-control" type="email" placeholder="name@example.com" id="username" name="username" required>
		</div>
		<div class="form-group">
			<label class="whiteFont" for="password">Passwort</label>
			<input class="form-control" type="password" id="password" name="password" required>
		</div>
		<div class="form-group input--register">
			<label class="whiteFont" for="password_confirmation">Passwort wiederholen</label>
			<input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" id="btnSubmit" name="btnSubmit" type="submit">Registrieren</button>
			<button class="btnReset btn btn-danger" id="btnReset" type="reset">Reset</button>
		</div>
	</form>
    ';
    }
?>