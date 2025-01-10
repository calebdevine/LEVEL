<?php 
    require('../layout/header.php'); 
    if(session_status() === PHP_SESSION_NONE) session_start();
?>
<link rel="stylesheet" href="./../../css/login.css">
<section class="log">
    <div class="login">
        <div class="subtitle">
            <h2>Login</h2>
        </div>
        <div class="preform">
            <div class="login-form">
                <form action="./../loginManager/login.php" method="POST" id="login">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="mario_rossi@example.com">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="password">
                        <input class="click" type="submit" value="Accedi">
                </form>
            </div>
            <div class="logErr">
                    <?php
                        if(isset($_SESSION["email"])){
                            header("location: ./personalArea.php");
                        }
                        if(isset($_SESSION['loginError'])){
                            echo "<div id=\"errorLogin\"><p>Non è stato possibile effettuare il login. <br>La email inserita o la password potrebbero essere errati. <br>Si prega di riprovare.</p></div>";
                            unset($_SESSION['loginError']);
                        }
                    ?>
            </div>
            <h3>Se non sei ancora registrato registrati <a href="signupPage.php">qui</a> </h3>
        </div>
    </div>

</section>

    
    

<?php require('../layout/footer.php'); ?>