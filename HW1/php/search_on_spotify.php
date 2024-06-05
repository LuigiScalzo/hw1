<?php
session_start();


//verifica se l'utente è loggato
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

?>

<html>

<head>

    <link href="css_for_spotify.css" rel="stylesheet">

    <script src="hw1_spotify.js" defer></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preonnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
<header>

<nav>
<form method="post" action="index.php"><button id="tastoHome" type="submit">Home</button></form>
</nav>

<div id="testo">
<h1>Sei in cerca di musica?</h1>
<h2>Esplora i tuoi gusti musicali!</h2>
</div>
</header>


<section>

<div id="ricerca">
            <form name='search_content' id='search'>
                <h1>FAI LA TUA RICERCA</h1>
                <input type='text' id='cerca' placeholder="Inserisci..">
                <select name='tipo' id='tipo'>
                    <option value='album'>Album</option>
                    <option value='artist'>Artista</option>
                    <option value='track'>Brano</option>
                    <option value='playlist'>Playlist</option>
                </select>
                <input type='submit' id='submit' value='Cerca'>
            </form>
        </div>

       
    </section>

    <div id="ricerche">

        <div id="view_search">
        </div>

    
    </div>
</section>

</body>








</html>