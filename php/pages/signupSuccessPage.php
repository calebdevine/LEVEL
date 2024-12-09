<!DOCTYPE html>
<?php
    if(session_status() === PHP_SESSION_NONE) session_start();
    if(isset($_SESSION['email'])){
        header('location: ./personalArea.php');
    }
    header("Refresh:4;URL=./personalArea.php");
?>
<html lang="it">
    <head>
        <title>Registrazione avvenuta con successo!</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div id="containerText">
            <section class="successSignup">
            La registrazione è avvenuta con successo! 
            Entro 5 secondi, sarai reindirizzato all'area personale, dove potrai effettuare il login. 
            Se ciò non avviene, si prema <a href="./personalArea.php">qui</a>.
            </section>
        </div>
    </body>
</html>
