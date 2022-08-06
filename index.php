<!DOCTYPE html>
<html lang="en">
<?php
if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
   $_SERVER['HTTPS'] == 1) ||  
   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
?>

<?php header('Cache-Control: no-cache');
      header("x-frame-options: SAMEORIGIN"); ?>
<html>
  
  <head>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="apple-mobile-web-app-capable"content="yes">
      
  </head>
  <body onload="deleteAds()">
     
    <div class=topbox>
      <h1>ring.</h1>
      <button type="button" class="collapsible" onclick="collapse()">
        <div id="avatar"></div>
        <div id="username"><?php session_start(); echo $_SESSION["username"] ?></div>     
      </button> 

      <div class="meny">
        <button type="button" class="menygrej" value="Mitt konto"></button>
        <button type="button" class="menygrej" value="Inställningar"></button>
        <form action="signout.php">
          <input type="submit" value="Logga ut!" class="menygrej" />
        </form>
      </div>

      <!--<a href="javascript:void(0);" class="icon" onclick="collapse()">
        <i class="fa fa-bars"></i>
      </a>-->
    </div>
    
    
      <div id="meddelande">
        <div id="bottombox">
          <?php include "meddelande.php" ?>
        </div>
      </div>

      <div id="result"></div>
      <?php
      
      if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
          echo "Du är inte inloggad.";
          header("location: login.php");
          exit;
      }
      ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>

          
      </script>
        
        <script>
          
      </script>
    </body>
    <script src="scripts.js" ></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</html>