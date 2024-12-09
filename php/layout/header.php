<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEVEL Gym</title>
    <link rel="icon" type="image/x-icon" href="./../../img/logoLEVEL.png">
    <link rel="stylesheet" href="./../../css/style.css">
</head> 


<body>
    <header class = "header" id = "header">
        <div class = "head-top">
            <div class ="site-name">
                <span id="home-btn">
                    <a class ="no-underline" href="./../../index.php">
                        <img class = "home" src="./../../img/home.png" alt="home">
                    </a>
                </span>
            </div>
            
            <div class = "head-title">
                <span><img class = "logo" src="./../../img/logoLEVEL.png" alt="logo"> </span>
            </div>
            
            
            <div class = "site-nav">
            </div>    
            <span id = "nav-btn">
                <img class = "menu" src="./../../img/menu.png" alt="menu">
            </span>
                
        </div>
    </header>
           
    <div class = "sidenav" id = "sidenav">
        <span class = "cancel-btn" id = "cancel-btn">
            <b class = "fas fa-times">x</b>
        </span>
        <ul class = "navbar">
            <li><a class ="no-underline" href="./../../index.php">Home</a></li>
            <li><a class ="no-underline" href="../layout/reservations.php">Prenota Corso</a></li>
            <li><a class ="no-underline" href="../pages/loginPage.php">Area Personale</a></li>
            <li><a class ="no-underline" href="#info">Contatti</a></li>
        </ul>
        <a class ="no-underline" href="../pages/signupPage.php"><button class = "btn sign-up">REGISTRATI</button></a>
        <?php
            if(session_status() === PHP_SESSION_NONE) session_start();
            require_once "../loginManager/sessionUtil.php";
            if(!isLogged()){
                echo "<a class =\"no-underline\" href=\"../pages/loginPage.php\"><button class = \"btn log-in \">ACCEDI</button></a>";
            }else{
                echo "<a class =\"no-underline\" href=\"../loginManager/logout.php\"><button class = \"btn log-in \">ESCI</button></a>";
            }
        ?>
    </div>


    <div class = "nav">
        <ul>
            <li><a class ="no-underline" href="./../../index.php">Home</a></li>
            <li><a class ="no-underline" href="../layout/reservations.php">Prenota Corso</a></li>
            <li><a class ="no-underline" href="../pages/loginPage.php">Area Personale</a></li>
            <li><a class ="no-underline" href="#info">Contatti</a></li>
        </ul>
    </div>
    
    <div id = "modal"></div>
<script src="../../js/navBar.js"></script>    