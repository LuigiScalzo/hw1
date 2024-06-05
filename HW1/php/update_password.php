<?php
session_start();

$error = false;

$payload = file_get_contents('php://input');



//verifico l'esistenza dei dati POST
if (/*isset($_POST["username"])&& isset($_POST["password"]) && isset($_POST["confirmpassword"*/$payload) {

    $data = json_decode($payload);
    $new_password  = $data->password;
    $confirmpassword = $data->confirmpassword;
    //mi connetto al database
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());


    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";

    //faccio l'escape injection delle stringhe username e password per il login
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $confirmpassword = mysqli_real_escape_string($conn, $confirmpassword);

    if (!preg_match($passwordRegex, $new_password)) {
        echo "Error.";
        exit;
    } else if($new_password !== $confirmpassword) {
        echo "Error.";
        exit;
    }
    else{
        //credo la query che serve per modificare la password di quell'utente
        $query = "UPDATE dati_utente SET password = '$new_password' WHERE username = '" . $_SESSION["pw_up"] . "'";
        $res = mysqli_query($conn, $query) or die("Errore: " . mysqli_error($conn));
        //verifico la corretteza delle credenziali
        if ($res) {
            echo "Valido.";
            unset($_SESSION["pw_up"]);
            exit;
            // header("Location: login.php");
        } else {
            $error = true;
            echo "Error database.";
            exit;
        }
    }
}


?>


<html>

<head>

    <link href="css_for_update_password.css" rel="stylesheet">
    <script src="check_dati.js" defer></script>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>




<body id="body_update_password">

    <div id="intro_up">
        <h1>AGGIORNA LA TUA PASSWORD</h1>

    </div>

    <form id="update_password" method="POST" onsubmit="ChangePassword(event)">
        <input id="new_password_up" name="password" type="password" placeholder="Nuova password.." required>
        <input id="confirm_new_password_up" name="confirmpassword" type="password" placeholder="Ripeti password.." required>


        <button id="confirm_verify_password" type="submit">VERIFICA</button>
        <div id="linea_up"></div>
        <button id="login_up" type="button" onclick="window.location.href = 'login.php' ">TORNA AL LOGIN</button>
        <div id="error_verify_password_view"></div>
       
    </form>
    <div id="success_verify_password_view"></div>
</body>




</html>