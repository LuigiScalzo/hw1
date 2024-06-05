<?php
session_start();

$error = false;
//verifico se sono già loggato
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

//verifico l'esistenza dei dati POST
if (isset($_POST["username"]) && isset($_POST["password"])) {

    //mi connettto al db
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());

    //faccio l'escape injection delle stringhe username e password per il login
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    //creo la query che mi cerca gli utenti nel db con le credenziali che mi interessano
    $query = "SELECT * FROM dati_utente where username = '" . $_POST["username"] . "' AND password = '" . $_POST["password"] . "'"; //attenzione alle virgolette
    $res = mysqli_query($conn, $query) or die("Errore: " . mysqli_error($conn));
    //verifico la corretteza delle credenziali
    if (mysqli_num_rows($res) > 0) {
        //imposto la variabile di sessione
        $_SESSION["username"] = $_POST["username"];
        //con l'header vado alla pagina che mi interessa
        header("Location: index.php");
        exit;
    } else {
        $error = true;
        echo "<h1 id='errore_php_login'>";
        echo "Credenziali non valide!";
        echo "</h1>";
    }

    mysqli_free_result($res);
    mysqli_close($conn);
}
?>




<html>

<head>
    <title>Bebo's Music World</title>

    <link href="css_for_login.css" rel="stylesheet">

    <script src="hw1_validazione_login.js" defer></script>
    <script src="hw1_validazione_signup.js" defer></script>
    <script src="hw1.js" defer></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>


<body id="body_login">

    <div id="intro_Login">
        <h1>BENVENUTO NEL MONDO DELLA MUSICA</h1>
        <p>Troverai tutto quello che ti serve<br> per conoscere
            un po' di musica<br> che ti riempia di <em>VIBES</em></p>
    </div>

    <form id="login" method="POST">
        <input id="username_login" name="username" type="text" placeholder="Username.."><br><br>
        <input id="password_login" name="password" type="password" placeholder="Password.."><br><br>

        <div id="error_login_view">
        </div>




        <input id="tasto_accedi" type="submit" name="invio" value="Accedi"><br>
        <p id=pass_dim onclick="window.location.href='forgot_password.php' ">Password dimenticata?</p>
        <div id="linea_login"></div>
        <button id="crea_account" type="button" onclick="window.location.href = 'signup.php' ">Crea nuovo account</button>
    </form>
</body>


</html>

C:\xamppBebo\htdocs\HW1_Bebo\login.php