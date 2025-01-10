<?php 
    require_once('../layout/header.php');
    require_once ("./../dbUtility/dbConfig.php");
    require_once ("./../dbUtility/queryManager.php");
    require_once ("./../dbUtility/databaseManager.php"); 
    require_once "./../loginManager/sessionUtil.php";
        
        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
        }
           
    require_once('../layout/fitnessCalendar.php');  
    require_once('../layout/footer.php'); 
?>
