<?php


if(isset($_GET['titolo'] ) && isset($_GET['tipo'])){

    
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit;
    }

    //Dopo aver impostato id e secret faccio richiesta alle API di Spotify

    $titolo = $_GET['titolo'];
    $tipo = $_GET['tipo'];
    $curl=curl_init();

    $client_id = "5914079d25f14f5d976e8728f87fc59a";
    $client_secret = "12df6ecb0748451bb0bb6c060a1fa1ae"; 

    
    //Richiedo token

    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token"); 
    curl_setopt($curl, CURLOPT_POST, 1); //richiede http post 
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); //dati che si inseriscono nella richiesta
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  //evita la stampa dell output
    $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret)); 
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); //passa lista di header al server nella richiesta http

    $res=curl_exec($curl);
    $json_output = json_decode($res, true);
    $token = $json_output["access_token"];


    curl_close($curl);

    $curl2=curl_init();

    //Uso il token e invio risultati

    $data = http_build_query(array("q" => "$titolo", "type" => "$tipo","limit" =>"50")); //per le tracce di spotify
    curl_setopt($curl2, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);  //evita la stampa dell output
    $headers = array("Authorization: Bearer ".$token); 
    curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);

    $res=curl_exec($curl2);
    echo ($res);
    curl_close($curl2);

}

?>