<?php


if (isset($_GET['titolo'])) {


    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $titolo = $_GET['titolo'];



    $curl2 = curl_init();


    $data = http_build_query(array("part"=>"snippet","maxResults"=>"50","q" => "$titolo", "type" => "video" ,"videoType"=> "any","key"=>"AIzaSyACDP_5fDRu-jx4Cp-iwrPytNJ_SozYkuc")); //per le tracce di spotify
    curl_setopt($curl2, CURLOPT_URL, "https://youtube.googleapis.com/youtube/v3/search?" . $data);
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);  //evita la stampa dell output
    //$headers = array("Authorization: Bearer " . $token);
    //curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);

    $res = curl_exec($curl2);
    echo ($res);
    curl_close($curl2);
}
