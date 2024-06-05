<?php
session_start();

$error = false;


//verifico l'esistenza dei dati POST
if(isset($_POST["username"])){

    //mi connetto al database
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());

    //faccio l'escape injection delle stringhe username e password per il login
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    //creo la query che mi cerca gli utenti nel db con le credenziali che mi interessano
    $query = "SELECT * FROM dati_utente WHERE username = '" . $_POST["username"] . "'";
    $res = mysqli_query($conn, $query) or die("Errore: " . mysqli_error($conn));
    //verifico la corretteza delle credenziali
    if (mysqli_num_rows($res) > 0) {
        //con l'header vado alla pagina che mi interessa
       $_SESSION["pw_up"] = $_POST["username"];
        header("Location: update_password.php");
        exit;
    } else {
        $error = true;
        echo "<h1 id='errore_php_fp'>";
        echo "Username non valido!";
        echo "</h1>";
    }

    mysqli_free_result($res);
    mysqli_close($conn);

}







?>





<html>

<head>

<link href="css_for_forgot_password.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>




<body id="body_forgot_password">

    <div id="intro_fp">
        <h1>RECUPERA LA TUA PASSWORD</h1>
        
    </div>

    <form id="forgot_password" method="POST">
        <input id="username_fp" name="username" type="text" placeholder="Username..">
        <p id=username_dim onclick="window.location.href='forgot_username.php' ">Username dimenticato?</p>

        <div id="linea_fp"></div>

        <button id="login_fp" type="button" onclick="window.location.href = 'login.php' ">LOGIN</button>

    </form>
</body>



</html>