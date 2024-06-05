<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "Utente non loggato";
}

$payload = file_get_contents('php://input');
if ($payload) {
    $data = json_decode($payload);
    $name_artist = $data->$name_artist;
    $image_url = $data->image_url;
    $username = $_SESSION['username'];

    $conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());


    // Ottengo l'utente_id dall'username
    $stmt = $conn->prepare("SELECT id_utente FROM dati_utente WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $utente_id = $user['id_utente'];
    $stmt->close();


    // Controllo se l'artista è già presente nei artists_preferiti
    $stmt = $conn->prepare("SELECT artists_preferiti.artist_id FROM artists_preferiti JOIN dati_artisti ON artists_preferiti.artist_id = dati_artisti.id_artista
     WHERE dati_artisti.name = ? AND dati_artisti.image_url = ? AND artists_preferiti.user_id = ?");
    $stmt->bind_param("ssi",  $name_artist, $image_url, $utente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Trovato";
    } else {
        echo "ErroreNelCheckPreferiti";
        exit;
    }

    

    $stmt->close();
    $conn->close();
}
