<?php require_once('../layout/header.php'); ?> 
<?php

	require_once ("../dbUtility/dbConfig.php");
    require_once ("../dbUtility/queryManager.php");
    require_once ("./../dbUtility/databaseManager.php");
    require_once('../layout/header.php'); 


    $email = $_POST['email'];
    $corso = $_POST['corso'];
    $userId = findUserByEmail($email);

    echo("Email : ". $email."<br>");
    echo("Corso : ". $corso."<br>");
    echo("User Id  : ".$userId."<br>");
    

	if ($userId == -1) {
	 	echo("Spiacenti , l'email non è associata ad un utente registrato.");
	}else{
        $num = getNumReservationForCourse($corso);
        $max = maxReservation($corso);
        echo("Posti occupati: ".$num."<br>");
        echo("Posti disponibili: ".$max."<br>");
        if ($num < $max) {
            $res = insertNewReservation($userId, $corso);
            if (!$res) {
                echo ("Errore durante il tentativo di prenotazione");
            } else {
               echo ("Prenotazione avvenuta con successo <br>");
            }
        }else{
            echo("Errore durante il tentativo di prenotazione: Posti esauriti!");
        }
    }
    
?> 
<?php require_once('../layout/footer.php'); ?>