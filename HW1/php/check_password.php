<?php
// Connessione al database
if (isset($_POST["password"])) {
    
    //mi connettto al db
    $conn = mysqli_connect("localhost","root","","hw1") or die("Errore: ".mysqli_connect_error());
 
    //faccio l'escape injection della stringa per il login
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
     //creo la query che mi cerca gli utenti nel db con le credenziali che mi interessano
     $query = "SELECT * FROM dati_utente where password = '$password'";
         $res = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
         //verifico se l'username è già in uso
     if(mysqli_num_rows($res)>0){
       //se è vera la condizione vuol dire che c'è una password 
       echo "taken";
       
     }else{
      
        echo "Password non valida";
     }
 
     mysqli_free_result($res);
     mysqli_close($conn);
 }

?>