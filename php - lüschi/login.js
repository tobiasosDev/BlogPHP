//Wertet Passwort nach Vorgaben aus
function checkPassword(pw) {
    var pattSpecialChars = new RegExp(/(?=.*[\+\-\_\.\,\:\!\?])/);
    var pattNumber = new RegExp(/(?=.*[0-9])/);
    var pattSmalLetter = new RegExp(/(?=.*[a-z])/);
    var pattCapitalLetter = new RegExp(/(?=.*[A-Z])/);

    //checkOther = Prüfziffer für Validation
    var checkOther = 0;
    var checkSmallCapitalLetter = 0;

    //SmallLetters
    if (pattSmalLetter.test($(pw).val())) {
        checkSmallCapitalLetter++;
    } else {
        $(pw).css("border", "1px solid #F44336");
        $(pw).after('<div class="alert alert-danger alert-input" role="alert">Das Passwort hat keinen kleinen Buchstaben</div>');
    }

    //capitalLetters
    if (pattCapitalLetter.test($(pw).val())) {
        checkSmallCapitalLetter++;
    } else {
        $(pw).css("border", "1px solid #F44336");
        $(pw).after('<div class="alert alert-danger alert-input" role="alert">Das Passwort hat keinen grossen Buchstaben</div>');
    }

    //Special characters
    if (pattSpecialChars.test($(pw).val())) {
        checkOther++;
    } else {
        $(pw).css("backgroundColor", "#F44336");
        $(pw).css("border", "1px solid #F44336");
        $(pw).after('<div class="alert alert-danger alert-input" role="alert">Das Passwort hat kein Sonderzeichen(+-_,.:!?)</div>');
    }

    //Numbers
    if (pattNumber.test($(pw).val())) {
        checkOther++;
    } else {
        $(pw).css("border", "1px solid #F44336");
        $(pw).after('<div class="alert alert-danger alert-input" role="alert">Das Passwort hat keine Nummer</div>');
    }

    //checkSmallCapitalLetter >= 2 checkt ob gross und klein
    //checkSmallCapitalLetter >= 1 checkt entweder gross oder klein
    if (checkOther >= 1 && checkSmallCapitalLetter >= 1) {
        $(".alert-input").remove();
        $(pw).css("backgroundColor", "#4CAF50");
        $(pw).css("border", "1px solid #4CAF50");
    }
}

//checkRegistration wird für den späteren Gebrauch (Bitte registrieren) definiert
function checkRegistration() {
    //Auslesung & Abspeicherung von Elementen in diesen Variablen
    var user = $("input[name=name]");
    var pw = $("input[name=password]");
    var pw2 = $("input[name=passwortwiederholen]");

    //Entfernt alle Hinweise
    $(".alert-input").remove();

    //Ist bereits etwas angegeben? wenn nein, hinweis
    if ($(user).val().length === 0) {
        $(user).css("border", "1px solid #F44336");
        $(user).after('<div class="alert alert-danger alert-input" role="alert">Bitte Email Adresse eingeben</div>');
        return;
    } else {
        if ($(user).val().length < 50) {
            var patt = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i);
            //Benutzername wird überpüft
            var res = patt.test($(user).val());
            //Auswertung mit Feedback an den Benutzer falls nicht korrekt
            if (res) {
                $(user).css("backgroundColor", "#4CAF50");
                $(user).css("border", "1px solid #4CAF50");
            } else {
                $(user).css("backgroundColor", "#F44336");
                $(user).css("border", "1px solid #F44336");
                $(user).after('<p class="alert-input">Geben Sie eine valide Email Adresse ein</p>');
                return;
            }
            //Mehr als Fünfzig...
        } else {
            $(user).css("backgroundColor", "#F44336");
            $(user).css("border", "1px solid #F44336");
            $(user).after('<p class="alert-input">Email zu lang</p>');
            return;
        }
    }

    //Ist bereits ein Wert fürs Passwort eingegebn?
    if ($(pw).val().length === 0) {
        $(pw).css("border", "1px solid #F44336");
        $(pw).after('<div class="alert alert-danger alert-input" role="alert">Bitte Passwort eingeben</div>');
        return;
    } else {
        if ($(pw).val().length < 8) {
            $(pw).css("border", "1px solid #F44336");
            $(pw).after('<div class="alert alert-danger alert-input" role="alert">Passwort ist zu kurz</div>');
            return;
        } else {
            if ($(pw).val().length > 20) {
                $(pw).css("border", "1px solid #F44336");
                $(pw).after('<div class="alert alert-danger alert-input" role="alert">Passwort ist zu lang</div>');
                return;
            } else {
                //Falls beides Ok ist ...
                checkPassword(pw);
            }
        }
    }
    //Überprüft parallel ob die beiden Passwörtet übereinstimmen
    if ($(pw).val() != $(pw2).val()) {
        $(pw).css("border", "1px solid #F44336");
        $(pw2).css("border", "1px solid #F44336");
        $(pw2).after('<div class="alert alert-danger alert-input" role="alert">Das Passwort stimmt nicht überein</div>');
        return;
    } else {
        $(pw).css("backgroundColor", "#4CAF50");
        $(pw2).css("backgroundColor", "#4CAF50");
        $(pw).css("border", "1px solid #4CAF50");
        $(pw2).css("border", "1px solid #4CAF50");
    }
}

//checkLogin Überprüft das Login
function checkLogin() {
    //Ist Registration Feld aktiviert?
    if ($("#check").is(":checked")) {
        checkRegistration();
    } else {
        var user = $("input[name=name]");
        var pw = $("input[name=password]");
        $(".alert-input").remove();

        if ($(user).val().length === 0) {
            $(user).css("border", "1px solid #F44336");
            $(user).after('<div class="alert alert-danger alert-input" role="alert">Bitte Email Adresse eintragen</div>');
            return;
        } else {
            if ($(user).val().length < 50) {
                var patt = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i);
                //Benutzername wird überpüft
                var result = patt.test($(user).val());
                //Auswertung mit Feedback an den Benutzer falls nicht korrekt
                if (result) {
                    $(user).css("backgroundColor", "#4CAF50");
                    $(user).css("border", "1px solid #4CAF50");
                } else {
                    $(user).css("backgroundColor", "#F44336");
                    $(user).css("border", "1px solid #F44336");
                    $(user).after('<p class="alert-input">Geben Sie eine valide Email Adresse ein</p>');
                    return;
                }
            } else {
                $(user).css("backgroundColor", "#F44336");
                $(user).css("border", "1px solid #F44336");
                $(user).after('<p class="alert-input">Email zu lang</p>');
                return;
            }
        }
        if ($(pw).val().length === 0) {
            $(pw).css("border", "1px solid #F44336");
            $(pw).after('<div class="alert alert-danger alert-input" role="alert">Bitte Passwort eingeben</div>');
            return;
        } else {
            if ($(pw).val().length < 8) {
                $(pw).css("border", "1px solid #F44336");
                $(pw).after('<div class="alert alert-danger alert-input" role="alert">Passwort ist zu kurz</div>');
                return;
            } else {
                if ($(pw).val().length > 20) {
                    $(pw).css("border", "1px solid #F44336");
                    $(pw).after('<div class="alert alert-danger alert-input" role="alert">Passwort ist zu lang</div>');
                    return;
                } else {
                    checkPassword(pw);
                }
            }
        }
    }

}

//Optische Veränderung wenn Angehackt wird
function checkbox() {
    if ($("#check").is(":checked")) {
        $("#titel").text("Bitte Registrieren");
        $("button[name=submitLogin]").text("Registrieren");
        $("button[name=submitLogin]").attr("name", "submitRegister");
        $("input[name=password]").after('<input type="password" name="passwortwiederholen" class="input" placeholder="Passwort wiederholen" onkeyup="checkRegistration()">');
    } else {
        $("input[name=passwortwiederholen]").remove();
        $("#titel").text("Bitte Einloggen");
        $("button[name=submitRegister]").attr("name", "submitLogin");
        $("button[name=submitLogin]").text("Anmelden");
    }

}