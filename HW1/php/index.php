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
    <script src="hw1.js" defer></script>
    <link href="css_for_home.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Genos:ital,wght@0,100..900;1,100..900&family=Gochi+Hand&family=Roboto+Slab:wght@100..900&family=Sedgwick+Ave+Display&family=Twinkle+Star&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preonnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Almendra+SC&family=Bungee&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

</head>

<body>

    <header>

        <nav>
            <div id="links">
                <a>News</a>
                <a>About</a>
                <a>Contact</a>
                <form method="post" action="logout.php"><button id="tastoLogout" type="submit">Logout</button></form>

            </div>

            <div id="listaMenu">
                <button>Menù</button>
            </div>

            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        <div id="tendina">
            <h2 class="tendElement"> > Crea la tua playlist</h2><br>
            <h2 class="tendElement"> > Eventi</h2><br>
            <h2 class="tendElement"> > Concerti Live</h2><br>
        </div>


        <div id="fotoprofilo"> <img src='https://massmailer.io/wp-content/uploads/2014/10/download.png'> </div>


    </header>

    <section>
        <div id="main">
            <h1>IL MONDO DELLE VIBES</h1>
            <h2>
                Vuoi sapere chi è il vero <em>GOAT?</em>
            </h2>

            <div id="frase">
                <p1>Clicca per scoprire la lista di alcune sue canzoni</p1>

                <button>INCONTRA LE VIBES</button>
            </div>

        </div>

        <div id="listapreferite">

            <div id="boxtesti">

                <div id="listatesti" class="hidden">
                    <p>1. GUAI</p>
                    <p>2. BACKUP</p>
                    <p>3. ANGELI</p>
                </div>
            </div>

            <div class="preferito">
                <img class="image" src="https://i.ytimg.com/vi/0rVpq5Ly2Nc/maxresdefault.jpg" />
                <a href="https://www.youtube.com/watch?v=0rVpq5Ly2Nc&ab_channel=TonyBoy" target="_blank" Title="Clicca per aprire il video della canzone"> 1. GUAI</a>
            </div>

            <div class="preferito">
                <img class="image" src="https://i.discogs.com/Knn11y2aQ8Tugs0K_WcLQrCVuEI6nLvnoTEATIMVbuc/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTI5OTc5/OTA0LTE3MDk0MDAy/ODctNzIwMS5qcGVn.jpeg" />
                <a href="https://www.youtube.com/watch?v=hbuWNjdXieA&ab_channel=TonyBoy" target="_blank" Title="Clicca per aprire il video della canzone">2. BACKUP</a>
            </div>
            <div class="preferito">
                <img class="image" src="https://i.ytimg.com/vi/SHhj38LNBaQ/maxresdefault.jpg" />
                <a href="https://www.youtube.com/watch?v=hbuWNjdXieA&ab_channel=TonyBoy" target="_blank" Title="Clicca per aprire il video della canzone">3. ANGELI</a>
            </div>

        </div>


        <div id="barra_scelte">
            <div id ="div_bottoni">
            <form method="post" action="search_on_spotify.php"><button id="tastoSpotify" type="submit">Musica</button></form>
            <form method="post" action="search_on_youtube.php"><button id="tastoYoutube" type="submit">Video</button></form>
            <form method="post" action="preferiti.php"><button id="tastoPreferiti" type="submit">I miei preferiti</button></form>
            <form method="post" action="testiMusicali.php"><button id="tastoTestiMusicali" type="submit">Testi Musicali</button></form>
            </div>
        </div>


    </section>




    <section id="modal-view" class="hidden"></section>

    <footer>
        <h2>ENJOY IT</h2>
        <p>Powered by Bebo</p>
    </footer>
</body>

</html>