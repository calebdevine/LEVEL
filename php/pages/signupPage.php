<?php require('../layout/header.php'); ?>
<link rel="stylesheet" href="./../../css/signup.css">

<section class="reg">
    <div class="register ">
        <div class="title">
            <h1>Registration Page</h1>
        </div>
        <div class="reg-form">
            <form id="signUp" action="./../loginManager/signup.php" method="POST">
                <div class="form-item">    
                    <label>Nome</label>
                    <input type="text" name="nome" required placeholder="Mario" pattern="^[A-Za-z ,.'-]+$" onblur="checkVal(this)">
                </div>    
                <div class="form-item">
                    <label>Cognome</label>
                    <input type="text" name="cognome" required placeholder="Rossi" pattern="^[A-Za-z ,.'-]+$" onblur="checkVal(this)">
                </div>  
                <div class="form-item">
                    <label>Codice Fiscale</label>
                    <input type="text" name="codiceFiscale" required placeholder="MRORSS65A19G842R" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$"onblur="checkVal(this)">
                </div>  
                <div class="form-item">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="mario_rossi@example.com" onblur="checkVal(this)">
                </div>  
                <div class="form-item">
                    <label>Numero di telefono</label>
                    <input type="text" name="telefono" required placeholder="3289423583" pattern="[0-9]+" onblur="checkVal(this)">
                </div>  
                <div class="form-item">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="password" minlength="8" onblur="checkVal(this)">
                </div>  
                <div class="form-item">
                    <label>Conferma la password</label>
                    <input type="password" name="checkPassword" required placeholder="password" minlength="8" onblur="checkVal(this)">
                </div> 
                <div class="form-item">
                    
                    <input class="click" type="button" onclick="checkFormSignUp()" value="Registrati!">
                </div> 
                    
            </form>
            <script src="./../../js/signUpForm.js"></script>
        </div>
    </div>
</section>
<?php require('../layout/footer.php'); ?>
    