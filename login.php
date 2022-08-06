<!DOCTYPE html>
<html lang="en">

<html>
  <head>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="apple-mobile-web-app-capable"content="yes">
  </head>
</html>

<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){     
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: index.php");
                        } else{
                            $login_err = "Ogiltigt användarnamn eller lösenord.";
                        }
                    }
                } else{
                    $login_err = "Ogiltigt användarnamn eller lösenord.";
                }
            } else{
                echo "Fail army serverside.";
            }

            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>
 
<!DOCTYPE html>

<body>
    <div class="wrapper">
        <h2>Logga in</h2>
        <p>Nu är det dags att börja ringa!</p>

        <script>
            function deleteAds() {
                setTimeout(() => {
                document.getElementById("ads").remove();
                document.getElementById("ads_bottom_static").remove();
                document.getElementsByClassName("adsbygoogle adsbygoogle-noablate")[0].remove();
                }, 1000);
            }
            deleteAds();
        </script>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Användarnamn</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"autocomplete="off">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Lösenord</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"autocomplete="off">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <p>Har du inte ett konto? <a href="signup.php">Registrera dig nu!</a>.</p>
            <div class="form-group">
                <input type="submit" class="button" value="Logga in">
            </div>
            
        </form>
    </div>
</body>
</html>