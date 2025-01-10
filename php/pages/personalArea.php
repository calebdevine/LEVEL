<?php

require_once('../layout/header.php'); 
require_once "./../dbUtility/queryManager.php";
require_once ("./../dbUtility/dbConfig.php");
require_once ("./../dbUtility/databaseManager.php"); 



if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION["email"])){
    echo "<div class =\"title user\"><h1>Hellow Guest</h1><br><h3>You will soon be redirect to the Login Page</h1></div>";
    header("Refresh:3; URL = ./loginPage.php");
    exit();
}else{
    if($_SESSION['stato'] == -1){
        header('location: ./../pages/adminArea.php');
    }else{
        $email = $_SESSION["email"];
        $user = getUserInfo($email);
        if($user == -1){
            echo "<div class =\"title user\"><h1>Sorry, you are not a registered user</h1><br><h3>Redirecting to the registration page</h1></
            div>";
            header("Refresh:3; URL = ./../pages/registration.php");
        }
    ?>
    <link rel="stylesheet" href="./../../css/personalArea.css">
        <section class="personal-area">
            <div class="title">
                <h1>Area Personale</h1>
                
            </div>
            <div class="greatings">
                    <h3 >Ciao <?php echo $user[0]['name']." ".$user['surname'] ?> ! </h3>
    </div>
            <div class ="news">
                
            </div>
            <div class="user">
                
            </div>
            <div class="view">
                
                <section>
                    <div class="subtitle">
                        <h4>CORSI FITNESS</h4>
                    </div>
                            
                    <?php  require ("../layout/fitnessCalendar.php");?>
                </section>

                <section>
                    <div class="subtitle">
                        <h4>SALA PESI</h4>
                    </div>
                </section>
                
            </div>
        </section>

<?php    
    require_once('../layout/footer.php'); 
    }   
}

?>

