<?php 
session_start();
if(isset($_SESSION["email"])){
  header("location:index.php");
}
include("navbar.php");

 ?>


    <section class="container-fluid sign-in-form-section">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 sign-up" style="text-align: center;">
                    <h3 style="font-weight: bold;"></h3><hr>
                    
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='login.php'" style="width:200px;">utilisateur</button>
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='owner-login.php'" style="width:200px;">publieur</button>
                </div>
                
            </div>
        </div>
    </section>