<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "Utente non loggato";
}

$payload = file_get_contents('php://input');
if ($payload) {
    $data = json_decode($payload);
    $title = $data->title;
    $artist = $data->artist;
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


    // Controllo se la canzone è già presente nei preferiti
    $stmt = $conn->prepare("SELECT songs_preferiti.song_id FROM songs_preferiti JOIN dati_canzoni ON songs_preferiti.song_id = dati_canzoni.id_canzone 
     WHERE dati_canzoni.title = ? AND dati_canzoni.artist = ? AND songs_preferiti.user_id = ?");
    $stmt->bind_param("ssi", $title, $artist, $utente_id);
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
?>


