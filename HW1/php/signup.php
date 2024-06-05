<?php
session_start();

//verifico se sono già loggato
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());


if (
    isset($_POST['username']) &&
    isset($_POST['cognome']) &&
    isset($_POST['cognome']) &&
    isset($_POST['nascita']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['sesso']) &&
    isset($_POST['indirizzo']) &&
    isset($_POST['codice_postale']) &&
    isset($_POST['nazione']) &&
    isset($_POST['citta']) &&
    isset($_POST['provincia'])
) {



    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
    $nascita = mysqli_real_escape_string($conn, $_POST["nascita"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $sesso = mysqli_real_escape_string($conn, $_POST["sesso"]);
    $indirizzo = mysqli_real_escape_string($conn, $_POST["indirizzo"]);
    $codice_postale = mysqli_real_escape_string($conn, $_POST["codice_postale"]);
    $nazione = mysqli_real_escape_string($conn, $_POST["nazione"]);
    $citta = mysqli_real_escape_string($conn, $_POST["citta"]);
    $provincia = mysqli_real_escape_string($conn, $_POST["provincia"]);

    
    // Espressione regolare per la validazione della password
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
    // Espressione regolare per la validazione dell'email
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";

    if (strlen($username) < 5) {
        echo "L'username deve contenere almeno 5 caratteri.";
    } else if (!preg_match($emailRegex, $email)) {
        echo "Inserisci una mail valida";
    } else if (!preg_match($passwordRegex, $password)) {
        echo "La password deve contenere almeno 8 caratteri, una lettera maiuscola, un numero e un simbolo.";
    } else {

        //verifico se l'username è già in uso
        $query = "SELECT * FROM dati_utente where username = '" . $_POST["username"] . "'";
        $res = mysqli_query($conn, $query) or die("Errore: " . mysqli_error($conn));


        if (mysqli_num_rows($res) > 0) {
            echo "taken";
        } else {
            $query_insert = "INSERT INTO dati_utente (username,nome,cognome,data_di_nascita,email,password,sesso,indirizzo,codice_postale,nazione,citta,provincia) 
        values ('$username','$nome','$cognome','$nascita','$email','$password','$sesso','$indirizzo','$codice_postale','$nazione','$citta','$provincia')";
            $res_insert = mysqli_query($conn, $query_insert) or die("Errore: " . mysqli_error($conn));
            if ($res_insert === TRUE) {
                echo "<h1 id='signup_valido'>";
                echo "Registrazione effettuata con successo!";
                echo "</h1>";
            } else {
                echo "Errore durante la registrazione: " . $conn->error;
            }
        }
        mysqli_free_result($res);
        mysqli_close($conn);
    }
}


?>


<html>

<head>
    <title>Bebo's Music World</title>

    <link href="css_for_signup.css" rel="stylesheet">

    <script src="hw1_validazione_login.js" defer></script>
    <script src="hw1_validazione_signup.js" defer></script>
    <script src="check_dati.js" defer></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preonnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>


<body id="body_signup">
    <h1>EFFETTUA LA REGISTRAZIONE</h1>

    <form id="signup" method="POST" onsubmit="validateFormSignup(event)">

        <div class="form-container">

            <div class="form-field">
                <input id="username_signup" name="username" type="text" placeholder="Username.." required>
            </div>
            <div class="form-field">
                <input id="nome_signup" name="nome" type="text" placeholder="Nome.." required>
            </div>
            <div class="form-field">
                <input id="cognome_signup" name="cognome" type="text" placeholder="Cognome.." required>
            </div>
            <div class="form-field">
                <input id="data_di_nascita_signup" name="nascita" type="text" placeholder="Data di nascita..(aaaa-mm-gg)" required>
            </div>
            <div class="form-field">
                <input id="email_signup" name="email" type="text" placeholder="Email.." required>
            </div>
            <div class="form-field">
                <input id="password_signup" name="password" type="password" placeholder="Password.." required>
            </div>
            <div class="form-field">
                <input id="sesso_signup" name="sesso" type="text" placeholder="Sesso.." required>
            </div>
            <div class="form-field">
                <input id="indirizzo_signup" name="indirizzo" type="text" placeholder="Indirizzo.." required>
            </div>
            <div class="form-field">
                <input id="codice_postale_signup" name="codice_postale" type="text" placeholder="Codice postale.." required>
            </div>
            <div class="form-field">
                <input id="nazione_signup" name="nazione" type="text" placeholder="Nazione.." required>
            </div>
            <div class="form-field">
                <input id="citta_signup" name="citta" type="text" placeholder="Città.." required>
            </div>
            <div class="form-field">
                <input id="provincia_signup" name="provincia" type="text" placeholder="Provincia.." required>
            </div>

        </div>

        <div id="bottoni">
            <button id="bottone_registrati" type="submit">Registrati</button>
            <div id="linea_signup"></div>
            <button id="bottone_login" type="button" onclick="window.location.href='login.php';">Torna al login</button>
        </div>

        <div id="error_signup_view">
        </div>

        <div id="error_signup_check"></div>

    </form>



</body>


</html>