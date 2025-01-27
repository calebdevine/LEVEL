<!DOCTYPE html>
<?php
        if(session_status() === PHP_SESSION_NONE) session_start();
        if(isset($_SESSION['email'])){
            header('location: ./homePage.php');
        }
        header("Refresh:4;URL=./signupPage.php");
?>
<html lang="it">
    <head>
        <title>Registrazione fallita!</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div id="containerText">
            <section class="failSignup">
            Non è stato possibile proseguire con la registrazione. Si controlli di non aver inserito un indirizzo email già utilizzato. Entro 5 secondi, sarai reindirizzato alla pagina per la registraizione, dove potrai effettuare nuovamente l'inserimento dei dati. Se ciò non avviene, si prema <a href="./signupPage.php">qui</a>
            </section>
        </div>
    </body>
</html>
