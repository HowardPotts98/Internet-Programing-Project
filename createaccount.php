<?php
// Include Config File
require_once "config.php";
 
// Define Variables And Start With Empty Values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing Data When Submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  try{
	$pdo = new PDO('mysql:host='. DB_SERVER.';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD);
  }catch(PDOException $e){
	  echo "connection failed";
  }
     //Check Username
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter Your Username.";
    } else{
        // Prepare A Select Statement
        $sql = "SELECT username FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Set Var For Parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set Parameters
            $param_username = trim($_POST["username"]);
            
            // Try To Execute Prepared Statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already in use.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error Please Try Again";
            }

            // Close Statement
            unset($stmt);
        }
    }
	
    // Check password
    if(empty(trim($_POST["password"]))){
        $password_err = "Password Is Required.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password Must Have At Least 5 Characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check With Confirm Password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Verify Your Password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password Was Not A Match.";
        }
    }
    
    // Check Errors Before Updating Database (insert)
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare An Insert Statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         echo $param_username;
		 
		 echo "hello";
        if($stmt = $pdo->prepare($sql)){
            // Set Var For Parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set Parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates Password Hash
            
            // Try To Execute Prepared Statement
            if($stmt->execute()){
                // Send To Login Page
                header("location: loginPage.php");
            } else{
                echo "Error Please Try Again.";
            }

            // Close Statement
            unset($stmt);
        }
    }
    
    // Close Connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Create Account</h2>
        <p>Fill Out This Account Form To Start Messaging!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="loginPage.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>