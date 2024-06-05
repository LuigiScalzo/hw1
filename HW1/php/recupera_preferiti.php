<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Utente non loggato"]);
    exit;
}

$tipo = $_GET['tipo'];
$username = $_SESSION['username'];

$conn = mysqli_connect("localhost", "root", "", "hw1") or die("Errore: " . mysqli_connect_error());


$stmt = $conn->prepare("SELECT id_utente FROM dati_utente WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$utente_id = $user['id_utente'];
$stmt->close();

if ($tipo === 'brani') {
    $stmt = $conn->prepare("SELECT dati_canzoni.title, dati_canzoni.artist, dati_canzoni.image_url 
                            FROM dati_canzoni JOIN songs_preferiti ON songs_preferiti.song_id = dati_canzoni.id_canzone 
                              WHERE songs_preferiti.user_id = ?");
    $stmt->bind_param("i", $utente_id);
} else if ($tipo === 'artisti') {
    $stmt = $conn->prepare("SELECT dati_artisti.name, dati_artisti.image_url 
    FROM artists_preferiti JOIN dati_artisti ON artists_preferiti.id_artista = dati_artisti.id_artista
    WHERE artists_preferiti.user_id = ?");
    $stmt->bind_param("i", $utente_id);
} else if ($tipo === 'album') {
    $stmt = $conn->prepare("");
    $stmt->bind_param("i", $utente_id);
} else if ($tipo === 'playlist') {
    $stmt = $conn->prepare("");
    $stmt->bind_param("i", $utente_id);
} else {
    echo json_encode(["error" => "Tipo non valido"]);
    exit;
}



$stmt->execute();
$result = $stmt->get_result();
$favorites = [];
while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
}
$stmt->close();
$conn->close();


echo json_encode($favorites);
