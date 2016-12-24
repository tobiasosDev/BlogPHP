$(document).ready(function() {

	/**
	 * Diese Funktion validiert den bestimmten String mit der gegebenen Äusserung
     */
	function validate(expression, string) {
		var exp = new RegExp(expression);
		return exp.test(string);
	}

    /**
     * Diese Funktion kopiert die Anzahl Fehler zum bestimmten Element.
     */
    function displayError(errors, outputElement) {
        var output = "<strong>Es sind Fehler bei der Validierung aufgetreten:</strong><br>";
        for(var i = 0; i < errors.length; i++) {
            output += errors[i] + "<br>";
        }
        outputElement.html(output);
    }

    /**
     * Regex validierung für das PW
     */
	var pwRegex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.,-_'?'+"*])(?=\S+$).{8,}$/i;

    /**
     * Regex validierung für E-Mail
     */
	var emailRegex = /^[a-zA-Z0-9-_\.]{2,}@[a-zA-Z0-9-_\.]{2,}\.[a-z]{2,}$/i;

    /**
     * Fehlermeldungen
     */
    var error = {
        username: "Der Benutzername muss eine valide E-Mail Adresse sein.",
        password: "Das Passwort entspricht nicht den Vorschriften.",
        comparePassword: "Die Passwörter stimmen nicht überein.",
        language: "Mindestens eine Sprache muss ausgewählt sein."
    };

    /**
     * Login Formular
     */
    $('#loginForm').submit(function() {

		/**
		 *  Schaut ob Formular in login oder Registrier "Modus" ist
		 */
		var isLoggedIn = $("#formChange").is(":checked");
		
		/**
		 * Fehler 
		 */
        var errors = [];  

        /**
         * Schaut ob der username eine valide E-Mail ist
         */
        if(!validate(emailRegex, document.getElementById("username").value)) {
            errors.push(error.username);
        }

        /**
         * Schaut ob das eigegebene PW gültig ist.
         */
        if(!validate(pwRegex, $('#password').val())) {
            errors.push(error.password);
        }

         /**
         * Schaut ob das Bestätigungs PW das selbe ist wie das Erstangegebene. Dies wird nur im Registriermodus benötigt.
         */
        if(!isLoggedIn) {
        	if(document.getElementById("password").value != document.getElementById("password_confirmation").value) {
           		errors.push(error.comparePassword);
        	}
        }
        
        /**
         * Falls Fehler vorhanden, werden diese angezeigt oder es wird der input des Users angezeigt
         */
        $("#alertError").html("");
        $("#alertInput").html("");
        var stringOutput = "";
        if(errors.length > 0){
            displayError(errors, $("#alertError"));
        } else {
            stringOutput += "<strong>Ihre Eingaben:</strong><br>";
            stringOutput += "Benutzername: " + $("#username").val() + "<br>";
            stringOutput += "Passwort: ***************" + "<br>";
           
            $("#alertInput").html(stringOutput);
        }

        return false;
    });

    /**
     * Bestätigung bevor Felder zurückgesetzt werden
     */
    $(".btnReset").click(function() {
       return confirm("Es werden alle Felder zurückgesetzt! Sind Sie sicher?");
    });
      
    /**
     * Login/Registrier-modus 
     */
    $("#formChange").change(function() {
    	if($(this).is(":checked")) {
            $(".input--register").hide();
            $("#btnSubmit").text("Anmelden");
    	} else {
            $(".input--register").show();
            $("#btnSubmit").text("Registrieren");
        }
    });
});
