<?php

session_start();






?>





<html>
<head>

<link href="css_for_preferiti.css" rel="stylesheet">
<script src = "op_preferiti.js" defer ></script>

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

<div id="testoPreferiti">
<h1>I miei preferiti</h1>
</div>
</header>


<section id="prefer">
<div class="favorite-section" data-list="brani">Brani</div>
    <div class="favorite-section" data-list="artisti">Artisti</div>
    <div class="favorite-section" data-list="album">Album</div>
    <div class="favorite-section" data-list="playlist">Playlist</div>
</section>

<div id="overlay"  >
    <div id="list-container">
        <button id="close-btn">X</button>
        <ul id="favorite-list"></ul>
    </div>
</div>

</body>





</html>