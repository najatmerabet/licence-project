<?php
  include("config/config.php");
            //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
            
            if(isset($_POST['valider'])){
                $mail=$_POST['mail'];
                echo' <form method="post"><input type="text" name="password" placeholder="Votre nouveau mot de passe" required>
                <input type="submit" name="hh" value="changer"></form>';
            }
            if(isset($_POST['hh'])){
                if(isset($_POST['password'])){
                 $pass=$_POST['password'];
                 $sql=$db->query("UPDATE users SET password='$pass' WHERE email='$mail'");
                 if($sql){
                    echo"ok";
                 }
                }

            } else{//quand le membre sera connecté, on définira cette variable afin de cacher le formulaire
                ?>
                <br>
                <p>Remplissez le formulaire ci-dessous pour recevoir un nouveau mot de passe:</p>
                <form method="post" action="oublier.php">
                    <input type="text" name="mail" placeholder="Votre mail..." required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
                    <input type="submit" name="valider" value="Recevoir un nouveau mot de passe">
                </form>
                <?php
            }
            
        
        ?>
    </body>
</html>