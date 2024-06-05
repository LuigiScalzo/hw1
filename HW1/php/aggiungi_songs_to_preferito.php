<?php
session_start();

$error = false;

$payload = file_get_contents('php://input');

if (!isset($_SESSION['username'])) {
    echo "Utente non loggato";
    exit;
}

//require 'db_config.php';  // Includi il file di configurazione del database

if ($payload) {

    $data = json_decode($payload);
    // $id_canzone  = $data->id;
    $title = $data->title;
    $artist = $data->artist;
    $image_url = $data->image_url;

    $username = $_SESSION['username'];


    $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());


    // Ottengo l'utente_id dall'username
    $stmt = $conn->prepare("SELECT id_utente FROM dati_utente WHERE username = (?)");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $utente_id = $user['id_utente'];
    $stmt->close();

    

    //Aggiungo il brano nella tabella delle canzoni
    $stmt = $conn->prepare("INSERT IGNORE INTO dati_canzoni (title, artist, image_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $artist, $image_url);

    if ($stmt->execute()) {
        echo "Inserito";
    } else {
        $error = true;
        echo "Errore nel caricamento del brano";
        exit;
    }

    $stmt->close();
    
    //id della canzone generato nella query sopra
    $id_generato = mysqli_insert_id($conn);

    // Aggiungo il preferito alla tabella songs_preferiti
    $stmt = $conn->prepare("INSERT INTO songs_preferiti (user_id,song_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $utente_id, $id_generato);

    if ($stmt->execute()) {
        echo "&Aggiuntoaipreferiti";
    } else {
        echo "Errore nell'aggiungere ai preferiti";
        $error = true;
        exit;
    }

    $stmt->close();

    $conn->close();
}
