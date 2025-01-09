<?php
require_once('../layout/header.php'); 
if(session_status() === PHP_SESSION_NONE) session_start();

if(!isset($_SESSION["email"])){
    echo "<div class =\"title user\"><h1>Hellow Guest</h1><br><h3>You will soon be redirect to the Login Page</h1></div>";
    header("Refresh:3; URL = ./loginPage.php");

$message = "This is an alert message!";
// Output JavaScript to display an alert
echo "<script>alert('$message');</script>";
   exit();
    //header("location: ../loginManager/login.php");
}
else{
    if($_SESSION['stato'] == -1){
        header('location: ./../pages/adminArea.php');
    }else{
?>
<section class="personal-area">
    <div class ="user">
        <div class="title">
            <h1 >Welcome <?=$_SESSION['nome']?> <?=$_SESSION['cognome']?> </h1>  
        </div>
    </div>
    <div class="user">
        <div class="subtitle">
            <h2>PRENOTAZIONI</h2>
        </div>
    </div>
    <div class="view">
        <?php  require ("../layout/reservations.php");?>
    </div>
</section>

<?php    
    require_once('../layout/footer.php'); 
    }   
}

?>

